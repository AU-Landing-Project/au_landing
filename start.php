<?php

//include our functions
// note that functions are in different files separated by function
// to make them easier to remove if necessary
include 'lib/custom_video_handlers.php';
include 'lib/group_acls_for_access_options.php';
include 'lib/deprecation_log.php';
include 'lib/remove_online_users_tab.php';
include 'lib/notification_subscription_settings_info.php';
include 'lib/functions.php';

function au_landing_init(){
  elgg_extend_view('css/elgg', 'au_landing/css');
  // elgg_extend_view('groups/edit', 'groups/edit_gcl'); // removed as it denies control to group owners
  elgg_extend_view('forms/widgets/save', 'au_landing/textwidgets', 0);
  elgg_extend_view('page/elements/head', 'au_landing/messages_count');
    
  // add the wire widget to the index - removed: now provided by widget manager/thewire tools
 // elgg_unregister_widget_type('thewire');
 // elgg_register_widget_type('thewire', elgg_echo('thewire'), elgg_echo("thewire:widget:desc"), 'index,profile,dashboard');
  	
  
  // provide custom video handling for au.teacherstv, slideshare.net
  elgg_register_plugin_hook_handler('embed_extender', 'custom_patterns', 'au_landing_embed_patterns');
  elgg_register_plugin_hook_handler('embed_extender', 'custom_embed', 'au_landing_embed');
  
  // fix title link in event_calendar widget
  elgg_register_plugin_hook_handler('widget_url', 'widget_manager', 'au_landing_widget_manager_titles');
  
  // add group acls back as access options
  // also make some logical fixes for invisible groups
  elgg_register_plugin_hook_handler('access:collections:write', 'all', 'au_landing_group_acls', 1000);
  
  // prevent users from seeing online users
  elgg_register_plugin_hook_handler('route', 'members', 'au_landing_remove_online_users', 1000);
  
  // remove the restriction of 50 friends when sending messages
  elgg_register_plugin_hook_handler('route', 'messages', 'au_landing_messages_router');
  
  // change the page menu
  elgg_register_plugin_hook_handler('register', 'menu:page', 'au_landing_pagemenu', 1000);
  
  //remind group owners to add widgets
  elgg_register_plugin_hook_handler('view','groups/profile/widgets','widget_reminder',1000);
  
  
  
  // add in missing group forum topics widget
 // elgg_register_widget_type("group_forum_topics", elgg_echo("widgets:group_forum_topics:title"), elgg_echo("widgets:group_forum_topics:description"), "groups");
  elgg_register_widget_type("index_groups", elgg_echo("widget_manager:widgets:index_groups:name"), elgg_echo("widget_manager:widgets:index_groups:description"), "index", true);
  
  // remove the "house" icon for multi-dashboard - removed by jon - fixed in widget manager 2.7
 // elgg_unregister_menu_item('extras', 'multi_dashboard');
  
  // load tinymce js on every page
  elgg_load_js('tinymce');
  elgg_load_js('elgg.tinymce');
  
  // new notification handlers to append subscription modification info
  register_notification_handler('email', 'au_landing_email_notify');
  register_notification_handler('site', 'au_landing_site_notify');
    
  // remove group side links that don't work due to poor group_gatekeeper implementation
  elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'au_landing_ownerblock_links', 9999);
  
  // modify some routing
 elgg_register_plugin_hook_handler('route', 'all', 'au_landing_router');
  
  
  // replace old tinymce with newer version 3.5.6
  elgg_register_js('tinymce', 'mod/au_landing/vendor/tinymce/jscripts/tiny_mce/tiny_mce.js');
  
  // swap the order of the settings due to bug: http://trac.elgg.org/ticket/4840 //fixed 2013
  // elgg_unextend_view('forms/account/settings', 'core/settings/account/language');
  // elgg_unextend_view('forms/account/settings', 'core/settings/account/default_access');
  // elgg_extend_view('forms/account/settings', 'core/settings/account/default_access', 100);
  // elgg_extend_view('forms/account/settings', 'core/settings/account/language', 1000);
  
  //get rid of ugly embed code on side bars from gallielggembed
  elgg_unextend_view('page/elements/sidebar', 'galliElggEmbed/share');
  
  // prevent the deletion of logs REMOVED BY JON - not needed, now Elgg does it natively
 // $delete = elgg_get_plugin_setting('delete', 'logrotate');
 // elgg_unregister_plugin_hook_handler('cron', $delete, 'logrotate_delete_cron');
  
  
  //handle staff-only options
  
  elgg_register_event_handler('pagesetup','system','au_staff_options');

  // only allow AU staff to make groups staff-only
  $user=elgg_get_logged_in_user_entity();
  if (is_au_staff_member($user)){  		
	  add_group_tool_option("staff_only",elgg_echo("AU staff-only group"),false);
  } else{
	  
	  elgg_register_plugin_hook_handler('action','groups/join','au_landing_prevent_group_join',9999);
  }
  
  // this is needed because some group pages have no owner so we need to set one
 // elgg_register_plugin_hook_handler('route', 'discussion','au_landing_set_owner',1000);
  // elgg_register_plugin_hook_handler('route', 'groups','au_landing_set_owner',1000);
  //to be added when it works
  //au_staff_options(elgg_get_page_owner_entity());
}

// prevent deprecation notices from getting logged
// note this has to be in the global scope so it can pick up on 'init' deprecations
elgg_register_plugin_hook_handler('debug', 'log', 'au_landing_deprecation_log');

// move the mail members button to the top
elgg_register_plugin_hook_handler('register','menu:title','au_landing_title_menu');

//elgg_register_event_handler('pagesetup', 'system', 'au_landing_pagesetup');
elgg_register_event_handler('init', 'system', 'au_landing_init');

// set group widgets to display by default (if group is closed)
elgg_register_event_handler('create', 'group', 'au_landing_group_create');

// send notification when someone other than the owner edits a page
elgg_register_event_handler('update', 'object', 'au_landing_page_update');

// change wire posts to logged in access
//removed to avoid clash with wire_tools
//elgg_register_event_handler('create', 'object', 'au_landing_thewire_access');

// make sure users have email addresses
elgg_register_event_handler('login', 'user', 'au_landing_user_login');