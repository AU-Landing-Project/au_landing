<?php

function au_landing_deprecation_log($hook, $type, $returnvalue, $params){
  $log = elgg_get_plugin_setting('logdeprecation', 'au_landing');
  
  if($log == 'no'){
    // look to see if it's a deprecation notice, if so return false
    if($params['level'] == 'WARNING' && !$params['to_screen'] && substr($params['msg'], 0, 13) == 'Deprecated in'){
      return FALSE;
    }
  }
}