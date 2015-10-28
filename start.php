<?php

require_once __DIR__ . '/lib/hooks.php';
require_once __DIR__ . '/lib/events.php';
require_once __DIR__ . '/lib/functions.php';


// prevent deprecation notices from getting logged
// note this has to be in the global scope so it can pick up on 'init' deprecations
elgg_register_plugin_hook_handler('debug', 'log', 'au_landing_deprecation_log');

//elgg_register_event_handler('pagesetup', 'system', 'au_landing_pagesetup');
elgg_register_event_handler('init', 'system', 'au_landing_init');

function au_landing_init() {
	elgg_extend_view('css/elgg', 'css/au_landing');
	elgg_extend_view('page/elements/footer', 'au_landing/messages_count');
	elgg_extend_view('groups/edit', 'au_landing/gcl');


	// fix title link in event_calendar widget
	elgg_register_plugin_hook_handler('widget_url', 'widget_manager', 'au_landing_widget_manager_titles');

	// add group acls back as access options
	// also make some logical fixes for invisible groups
	elgg_register_plugin_hook_handler('access:collections:write', 'all', 'au_landing_group_acls', 1000);

	// prevent users from seeing online users
	elgg_register_plugin_hook_handler('members:config', 'tabs', 'au_landing_remove_online_tab', 1000);
	elgg_register_plugin_hook_handler('route', 'members', 'au_landing_remove_online_users', 1000);


	// change the page menu
	elgg_register_plugin_hook_handler('register', 'menu:page', 'au_landing_pagemenu', 1000);



	// add in missing group forum topics widget
	elgg_register_widget_type("index_groups", elgg_echo("widget_manager:widgets:index_groups:name"), elgg_echo("widget_manager:widgets:index_groups:description"), array("index"), true);


	// new notification handlers to append subscription modification info
	elgg_register_plugin_hook_handler('email', 'system', 'au_landing_email_append', 0);
	
	// modify some routing
	elgg_register_plugin_hook_handler('route', 'all', 'au_landing_router');


	//get rid of ugly embed code on side bars from gallielggembed
	elgg_unextend_view('page/elements/sidebar', 'galliElggEmbed/share');


	//handle staff-only options
	elgg_register_event_handler('pagesetup', 'system', 'au_staff_options');

	// only allow AU staff to make groups staff-only
	$user = elgg_get_logged_in_user_entity();
	if (is_au_staff_member($user)) {
		add_group_tool_option("staff_only", elgg_echo("AU staff-only group"), false);
	} else {
		elgg_register_plugin_hook_handler('action', 'groups/join', 'au_landing_prevent_group_join', 9999);
	}
	
	// move the mail members button to the top
	elgg_register_plugin_hook_handler('register', 'menu:title', 'au_landing_title_menu');
	
	// set group widgets to display by default (if group is closed)
	elgg_register_event_handler('create', 'group', 'au_landing_group_create');

	// send notification when someone other than the owner edits a page
	elgg_register_event_handler('update', 'object', 'au_landing_page_update');


	// make sure users have email addresses
	elgg_register_event_handler('login', 'user', 'au_landing_user_login');

}
