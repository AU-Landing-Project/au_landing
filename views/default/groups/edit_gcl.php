<?php

if (elgg_is_active_plugin('group_tools')
		&& elgg_is_active_plugin('group_custom_layout')
		&& !empty($vars['entity'])) {
  elgg_load_css('thickbox_css');
	elgg_load_css('farbtastic_css');

	elgg_load_js('thickbox_js');
	elgg_load_js('farbtastic_js');
	elgg_load_js('edit_js');
  
  $title = elgg_echo('group_custom_layout:edit:title');
  
  $group = elgg_get_page_owner_entity();
  $layout = $group->getEntitiesFromRelationship(GROUP_CUSTOM_LAYOUT_RELATION);
	$layout = $layout[0];
  
  $form = elgg_view_form('group_custom_layout/save', 
								array('id' => 'editForm', 'enctype' => 'multipart/form-data'), 
								array('entity' => $group, 'group_custom_layout' => $layout)
							);
  
  echo "<div>";
  echo elgg_view_module('info', $title, $form);
  echo "</div>";
}