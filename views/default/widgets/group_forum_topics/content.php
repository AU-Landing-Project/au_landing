<?php
	$widget = $vars["entity"];
	$group = $widget->getOwnerEntity();
	
	if($group->forum_enable != "no"){
		
		$topic_count = (int) $widget->topic_count;
		if($topic_count < 1){
			$topic_count = 4;
		}
		
		$forum_options = array(
			'types' => 'object', 
			'subtypes' => 'groupforumtopic', 
			'container_guid' => $group->getGUID(), 
			'limit' => $topic_count,
      'full_view' => false
		);
		
	    if($forum = elgg_list_entities($forum_options)){
        
        echo $forum;
        
	    } else {
	    	echo "<div class='contentWrapper'>";
			echo elgg_echo("grouptopic:notcreated");
			echo "</div>";
	    }
		
		echo "<div class='clearfloat'></div>";
	
	} 
