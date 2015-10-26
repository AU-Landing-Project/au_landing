<?php

$title = elgg_echo('group_custom_layout:edit:title');

$group = elgg_extract("entity", $vars);

if (!elgg_instanceof($group, 'group')) {
	return;
}

elgg_load_css("thickbox_css");
elgg_load_css("farbtastic_css");
	
elgg_require_js('group_custom_layout');

$layout = group_custom_layout_get_layout($group);

$body = elgg_view_form("group_custom_layout/save", array(
		"id" => "editForm",
		"enctype" => "multipart/form-data"
	),
	array(
		"entity" => $group,
		"group_custom_layout" => $layout
	)
);

echo elgg_view_module('info', $tile, $body);
