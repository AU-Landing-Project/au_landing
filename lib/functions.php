<?php


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


// adds subgroups at each level recursively, for 5 levels
function au_landing_subgroups_access($group, $user, $limit, $returnvalue = array(), $depth = 0) {

	if (!elgg_instanceof($group, 'group')) {
		return $returnvalue;
	}

	if (!elgg_instanceof($user, 'user')) {
		return $returnvalue;
	}

	$depth++;

	$children = \AU\SubGroups\get_subgroups($group, 0, true);

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


function au_landing_site_notify($from, $to, $subject, $message, $params) {
	$message .= elgg_echo('au_landing:notification:append', array(elgg_get_site_url() . 'settings/user/' . $to->username));

	messages_site_notify_handler($from, $to, $subject, $message, $params);
}
