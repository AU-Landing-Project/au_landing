<?php

// note that the event triggers twice, so using config to only do this once
function au_landing_page_update($event, $type, $object) {

	if (!elgg_instanceof($object, 'page') && elgg_instanceof($object, 'page_top')) {
		return true;
	}

	// only process this event once
	if (elgg_get_config('page_update_notify_sent_' . $object->guid)) {
		return true;
	}

	elgg_set_config('page_update_notify_sent_' . $object->guid, true);

	// get revision history for the page
	$revisions = $object->getAnnotations('page', 0);

	// create an array of unique users to notify, excluding the current user
	// and the object owner (as core notifies them)
	$users = array();
	foreach ($revisions as $revision) {
		if ($revision->owner_guid != $object->owner_guid && $revision->owner_guid != elgg_get_logged_in_user_guid()) {
			$users[] = $revision->owner_guid;
		}
	}

	$users = array_unique($users);

	// notify the users
	if (count($users)) {
		notify_user(
				$users, elgg_get_logged_in_user_guid(), elgg_echo('au_landing:page:update:subject', array($object->title)), elgg_echo('au_landing:page:update:message', array($object->title, elgg_get_logged_in_user_entity()->name, $object->getURL()))
		);
	}
}

// remove group side links if not part of the group
function au_landing_ownerblock_links($hook, $type, $return, $params) {

	if (!elgg_group_gatekeeper(false)) {
		return array();
	}
	return $return;
}

// allow profile widgets on new groups
function au_landing_group_create($event, $object_type, $object) {
	$object->profile_widgets = "yes";
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
	if ($type == 'menu:title') {

		if (elgg_get_context() == 'group_profile') {
			$group = elgg_get_page_owner_entity();
			if ($group->canEdit() && elgg_is_active_plugin('group_tools')) {
				$item = new ElggMenuItem('mail', elgg_echo('group_tools:menu:mail'), 'groups/mail/' . $group->getGUID());
				$item->setLinkClass('elgg-button elgg-button-action');
				$return[] = $item;
			}
		}
	}

	return $return;
}

function au_landing_user_login($event, $type, $object) {
	if (elgg_instanceof($object, 'user')) {
		if (!is_email_address($object->email)) {
			system_message(elgg_echo('au_landing:invalidemail'));
		}
	}
}

// this removes the 'edit group appearance' button from the side bar (it is available in group edit page)
function au_landing_pagemenu($hook, $type, $return, $params) {
	if (in_array(elgg_get_context(), array('group_profile', 'groups')) && is_array($return) && count($return)) {
		foreach ($return as $key => $item) {
			if (in_array($item->getName(), array('mail', 'Edit Group Appearance'))) {
				unset($return[$key]);
			}
		}
		return $return;
	}
}

/* * ************* STAFF ONLY OPTIONS *********** */

// check whether a person is a member of staff
// right now this just checks whether the email address ends in @athabascau.ca
// OR has an admin-editable-only profile field of au_staff set using profile manager (to catch exceptions).
// later it might be a good idea to get this info from LDAP via au_cas_login
// and set a field in the profile
// might also set a range of allowed patterns in settings for more flexibility

function is_au_staff_member($user) {
	if (substr($user->email, -13) == "athabascau.ca" || $user->au_staff == 'yes') {
		return true;
	} else {
		return false;
	}
}

/* provide options for AU staff

 * if group owner, allow to set group as staff only

 * if not staff member, prevent joining protected group

 */

function au_staff_options($pageowner) {
	$user = elgg_get_logged_in_user_entity();
	$group = elgg_get_page_owner_entity();
	if (elgg_instanceof($group, 'group')) {
		//check group attributes - ignore if au staff

		if ($group->staff_only_enable == 'yes') {
			elgg_extend_view('group/default', 'groups/sidebar/staff_only', 502);
			//do stuff if this is a staff-only group
			//system_message("AU staff-only group: only AU staff members can join this group");
			if (elgg_is_logged_in()) {
				$invited = check_entity_relationship($group->getGUID(), "invited", $user->getGUID()); //allow invited users in
				if (is_au_staff_member($user) || elgg_is_admin_logged_in() || $group->canEdit() || $invited) {
					//do other stuff - welcome here
				} else {
					//remove buttons for non staff members who are not members of the group and not invited

					if (!$group->isMember($user)) {
						elgg_register_plugin_hook_handler('register', 'menu:title', 'au_landing_remove_group_join_button', 9999);
						//remove the link we added in groups_ux to allow joining from discussion forum
						elgg_unextend_view('discussion/replies', 'discussion/replies/join');
					}
				}
			}
		} else {
			//this is a normal group
		}
	} else {
		//not a group, do nothing
	}
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
	return $true;
}

/* * ** end staff only options */

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

// adds subgroups at each level recursively, for 5 levels
function au_landing_subgroups_access($group, $user, $limit, $returnvalue = array(), $depth = 0) {

	if (!elgg_instanceof($group, 'group')) {
		return $returnvalue;
	}

	if (!elgg_instanceof($user, 'user')) {
		return $returnvalue;
	}

	$depth++;

	$children = au_subgroups_get_subgroups($group, 0, true);

	if (is_array($children) && count($children)) {
		foreach ($children as $child) {
			if ($child->isMember($user)) {
				// it's a valid subgroup that we're a member of, add it to the access list
				$label = '';
				for ($i = 0; $i < min($depth, $limit); $i++) {
					$label .= '--';
				}
				$label .= $child->name;
				unset($returnvalue[$child->group_acl]); //necessary because it may already be set in the wrong tree
				$returnvalue[$child->group_acl] = $label;
				$returnvalue = au_landing_subgroups_access($child, $user, $limit, $returnvalue, $depth);
			}
		}
	}

	return $returnvalue;
}

function au_landing_email_notify($from, $to, $subject, $message, $params) {
	$message .= elgg_echo('au_landing:notification:append', array(elgg_get_site_url() . 'settings/user/' . $to->username));

	email_notify_handler($from, $to, $subject, $message, $params);
}

function au_landing_site_notify($from, $to, $subject, $message, $params) {
	$message .= elgg_echo('au_landing:notification:append', array(elgg_get_site_url() . 'settings/user/' . $to->username));

	messages_site_notify_handler($from, $to, $subject, $message, $params);
}
