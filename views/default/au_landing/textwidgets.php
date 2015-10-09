<?php

$widget = $vars['widget'];

$notify = array('tabtext', 'free_html');

if (!in_array($widget->handler, $notify)) {
  return true;
}

echo elgg_view('output/longtext', array(
	'value' => elgg_echo('au_landing:textwidget:helptext') . '<br>',
	'class' => 'elgg-subtext',
	'style' => 'max-width: 300px'
));