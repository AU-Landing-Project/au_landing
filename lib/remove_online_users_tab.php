<?php

function au_landing_remove_online_users($hook, $type, $returnvalue, $params){
  if($returnvalue['segments'][0] == 'online'){
    forward('members');
  }
}