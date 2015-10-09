<?php

echo "Write Deprecation Notices to the log?<br>";
$options = array(
    'name' => 'params[logdeprecation]',
    'value' => $vars['entity']->logdeprecation ? $vars['entity']->logdeprecation : 'yes',
    'options_values' => array(
        'yes' => 'Yes',
        'no' => 'No'
    )
);

echo elgg_view('input/dropdown', $options) . '<br><br>';