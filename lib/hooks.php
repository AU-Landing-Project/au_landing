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
		$groups = $user->getGroups('', 0, 0);

		if ($groups) {
			foreach ($groups as $group) {

				// only show top level groups if we're using subgroups
				if (elgg_is_active_plugin('au_subgroups')) {
					$parent = au_subgroups_get_parent_group($group);
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
