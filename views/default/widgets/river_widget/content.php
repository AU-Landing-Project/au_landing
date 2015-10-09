<?php
/**
 * Activity widget content view
 */

$num = (int) $vars['entity']->num_display;

$options = array(
	'limit' => $num,
	'pagination' => false,
);

if (elgg_in_context('dashboard')) {
	if ($vars['entity']->content_type == 'friends') {
		$options['relationship_guid'] = elgg_get_page_owner_guid();
		$options['relationship'] = 'friend';
	}
	
	if ($vars['entity']->content_type == 'mine') {
		$options['subject_guid'] = elgg_get_page_owner_guid();
	}
} else {
	$options['subject_guid'] = elgg_get_page_owner_guid();
}

$content = elgg_list_river($options);
if (!$content) {
	$content = elgg_echo('river:none');
}

echo $content;
