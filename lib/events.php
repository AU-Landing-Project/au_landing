<?php

// allow profile widgets on new groups
function au_landing_group_create($event, $object_type, $object) {
	$object->profile_widgets = "yes";
}

function au_landing_user_login($event, $type, $object) {
	if (elgg_instanceof($object, 'user')) {
		if (!is_email_address($object->email)) {
			system_message(elgg_echo('au_landing:invalidemail'));
		}
	}
}

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
