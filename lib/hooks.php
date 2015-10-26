<?php

//
// 
/**
 * logic for setting access for groups
 * also adds group acls to personal access
 * 
 * @param type $hook
 * @param type $type
 * @param type $returnvalue
 * @param type $params
 * @return string
 */
function au_landing_group_acls($hook, $type, $returnvalue, $params) {

	$user = get_user($params['user_id']);

	// get groups and add their acls to the options
	// only for personal content, eg. don't list all groups inside a group context
	if ($user && $type == 'user') {
		
		// scalability?
		$groups = $user->getGroups(array('limit' => false));

		if ($groups) {
			foreach ($groups as $group) {

				// only show top level groups if we're using subgroups
				if (elgg_is_active_plugin('au_subgroups')) {
					$parent = \AU\SubGroups\get_parent_group($group);
					if ($parent) {
						continue;
					}

					$returnvalue[$group->group_acl] = elgg_echo('groups:group') . ": " . $group->name;
					$returnvalue = au_landing_subgroups_access($group, $user, 5, $returnvalue);
				} else {
					$returnvalue[$group->group_acl] = elgg_echo('groups:group') . ": " . $group->name;
				}
			}
		}
	}

	return $returnvalue;
}

function au_landing_deprecation_log($hook, $type, $returnvalue, $params) {
	static $log;

	if (!$log) {
		$log = elgg_get_plugin_setting('logdeprecation', 'au_landing');
		if ($log != 'no') {
			$log = 'yes';
		}
	}

	if ($log == 'no') {
		// look to see if it's a deprecation notice, if so return false
		if ($params['level'] == 'WARNING' && !$params['to_screen'] && substr($params['msg'], 0, 13) == 'Deprecated in') {
			return false;
		}
	}

	return true;
}

function au_landing_remove_online_users($hook, $type, $returnvalue, $params) {
	if ($returnvalue['segments'][0] == 'online') {
		forward('members');
	}
}

// handle some rerouting
// blog/new/username
// blog/new/group:<guid>
function au_landing_router($hook, $type, $return, $params) {
	if ($type == 'blog' && $return['segments'][0] == 'new') {
		$user = get_user_by_username($return['segments'][1]);
		if ($user) {
			system_message(elgg_echo('changebookmark'));
			forward(elgg_get_site_url() . 'blog/add/' . $user->guid);
			exit;
		}

		// must be a group
		$guid = str_replace('group:', '', $return['segments'][1]);
		$group = get_entity($guid);
		if (elgg_instanceof($group, 'group', '', 'ElggGroup')) {
			system_message(elgg_echo('changebookmark'));
			forward(elgg_get_site_url() . 'blog/add/' . $group->guid);
		}

		return FALSE;
	}

	// forward old groups urls to new group urls
	if ($type == 'groups' && is_numeric($return['segments'][0])) {
		$group = get_entity($return['segments'][0]);

		if ($group instanceof \ElggGroup) {
			system_message(elgg_echo('changebookmark'));
			forward($group->getURL());
		}
	}
}

function au_landing_widget_manager_titles($hook, $type, $return, $params) {
	$widget = $params['entity'];

	if ($widget->handler == 'event_calendar') {
		return elgg_get_site_url() . 'event_calendar/list';
	}
}

// moves the 'mail members' button to a top title button - more logical
function au_landing_title_menu($hook, $type, $return, $params) {
	if ($type != 'menu:title') {
		return $return;
	}

	if (elgg_get_context() != 'group_profile') {
		return $return;
	}

	$group = elgg_get_page_owner_entity();
	if ($group->canEdit() && elgg_is_active_plugin('group_tools')) {
		$item = new ElggMenuItem('mail', elgg_echo('group_tools:menu:mail'), 'groups/mail/' . $group->getGUID());
		$item->setLinkClass('elgg-button elgg-button-action');
		$return[] = $item;
	}

	return $return;
}

// this removes the 'edit group appearance' button from the side bar (it is available in group edit page)
function au_landing_pagemenu($hook, $type, $return, $params) {
	if (!$return) {
		return $return;
	}
	
	if (!is_array($return)) {
		return $return;
	}
	
	if (!in_array(elgg_get_context(), array('group_profile', 'groups'))) {
		return $return;
	}
	
	foreach ($return as $key => $item) {
		if (in_array($item->getName(), array('mail', 'group_layout'))) {
			unset($return[$key]);
		}
	}
	
	return $return;
	
}

//plugin hooks
//this is supposed to remove all buttons from a staff-only group
//should only be called if not an AU staff member
function au_landing_remove_group_join_button($hook, $type, $return, $params) {
	return array();
}

//hook to kill group joining - fallback in case anything has added a join group link

function au_landing_prevent_group_join($hook, $type, $return, $params) {
	//bit of an irritating hack thanks to Elgg not sending this stuff in params
	$groupid = get_input('group_guid');
	$group = get_entity($groupid);
	$user = elgg_get_logged_in_user_entity();
	if (elgg_instanceof($group, 'group')) {
		$invited = check_entity_relationship($group->getGUID(), "invited", $user->getGUID()); //allow invited users in
		if ($group->staff_only_enable == 'yes' && !is_au_staff_member($user) && !$group->canEdit() && !$invited) {
			register_error(elgg_echo("groups:cantjoin") . " - this is a staff-only group. Contact the Landing if you <em>are</em> a staff member!");
			return false;
		}
	}
	return true;
}

// this is to provide a reminder to group owners
// to add widgets if there are none there
function widget_reminder($hook, $type, $return, $params) {
	$group = elgg_get_page_owner_entity();
	if (elgg_instanceof($group, 'group')) {
		$groupid = $group->getGUID();
		$context = elgg_get_context();
		if (elgg_can_edit_widget_layout($context)) {
			if ($context == 'group_profile' && elgg_is_active_plugin('widget_manager') && elgg_get_plugin_setting("group_enable", "widget_manager") == "yes" && $group->widget_manager_enable == "yes") {
				$options = array(
					'type' => 'object',
					'subtype' => 'widget',
					'container_guid' => $groupid,
				);
				$widgets = elgg_get_entities($options);
				if (count($widgets) == 0) {
					//elgg_extend_view('groups/profile/widgets','au_landing/widget_reminder');
					return $return . elgg_echo('au_landing:widget_reminder');
				}
			}
		}
	}
}


// remove the online tab from members filter
function au_landing_remove_online_tab($hook, $type, $return, $params) {
	if (isset($return['online'])) {
		unset($return['online']);
	}
	
	return $return;
}