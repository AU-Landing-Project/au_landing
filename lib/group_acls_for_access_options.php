<?php
//
// logic for setting access for groups
// also adds group acls to personal access
function au_landing_group_acls($hook, $type, $returnvalue, $params){

  $user = get_user($params['user_id']);
  
  // get groups and add their acls to the options
  // only for personal content, eg. don't list all groups inside a group context
  if($user && $type == 'user'){
    $groups = $user->getGroups('', 0, 0);
    
    if($groups){
      foreach($groups as $group){
        
        // only show top level groups if we're using subgroups
        if (elgg_is_active_plugin('au_subgroups')) {
          $parent = au_subgroups_get_parent_group($group);
          if ($parent) {
            continue;
          }
          
          $returnvalue[$group->group_acl] = elgg_echo('groups:group') . ": " . $group->name;
          $returnvalue = au_landing_subgroups_access($group, $user, 5, $returnvalue);
        }
        else {
          $returnvalue[$group->group_acl] = elgg_echo('groups:group') . ": " . $group->name;
        }
      }
    }
  }
  
  return $returnvalue;
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
  
  $children = au_subgroups_get_subgroups($group, 0, true);
  
  if (is_array($children) && count($children)) {
    foreach ($children as $child) {
      if ($child->isMember($user)) {
        // it's a valid subgroup that we're a member of, add it to the access list
        $label = '';
        for ($i=0; $i<min($depth, $limit); $i++) {
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