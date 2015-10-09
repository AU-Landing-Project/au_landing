<?php

function au_landing_embed_patterns($hook, $type, $returnvalue, $params){
  $returnvalue[] = '/(http:\/\/)(au\.teacherstv\.ca\/)(.*)/';
  $returnvalue[] = '/(http:\/\/)(www\.slideshare\.net\/)(.*)/';
  
  return $returnvalue;
}

function au_landing_get_localhost_embed_regex() {
  // localhost embeds
  $url = elgg_get_site_url() . 'file/view/';
  $parts = parse_url($url);
  $regex = '/(' . str_replace('/', '\/', $parts['scheme']) . ':\/\/)';
  $regex .= '(www\.)?';
  $regex .= '(' . str_replace('/', '\/', str_replace('.', '\.', $parts['host']));
  $regex .= str_replace('/', '\/', str_replace('.', '\.', $parts['path'])) . ')';
  $regex .= '(.*)/';
  
  return $regex;
}

function au_landing_embed($hook, $type, $returnvalue, $params){
  $url = $params['url'];
  $guid = $params['guid'];
  $videowidth = $params['videowidth'];
  

  $domain = au_landing_parse_teacherstv_url($url);
  if($domain){
    videoembed_calc_size($videowidth, $videoheight, 425/320, 24);

    $embed_object = videoembed_add_css($guid, $videowidth, $videoheight);

    $embed_object .= "<div id=\"{$guid}\">";
    $embed_object .= "<object width=\"$videowidth\" height=\"$videoheight\"><param name=\"movie\" value=\"{$domain}\"></param><param name=\"allowFullScreen\" value=\"true\"></param><embed src=\"{$domain}\" type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" width=\"$videowidth\" height=\"$videoheight\"></embed></object>";
    $embed_object .= "</div>";
                      
    return $embed_object;
  }
  
  // not teacherstv, try slideshare
  if(strpos($url, 'slideshare.net')){
    videoembed_calc_size($videowidth, $videoheight, 425/320, 24);

    $embed_object = videoembed_add_css($guid, $videowidth, $videoheight);
	
    // get embed code
    // see http://www.slideshare.net/developers/oembed
    $jsonurl = "http://www.slideshare.net/api/oembed/2?url={$url}&format=json&maxwidth={$videowidth}&maxheight={$videoheight}";
    $json = file_get_contents($jsonurl);
    $json_output = json_decode($json);
    
    if(!empty($json_output->html)){
	  $embed_object .= "<div id=\"{$guid}\">";
      $embed_object .= $json_output->html;
      $embed_object .= "</div>";
      
      return $embed_object;
    }
    
    // if we can't get embed data just output a link, as slideshare has weird urls
    // that don't distinguish well
    return "<a href=\"$url\">$url</a>";
  }
  
  return $returnvalue;
}


function au_landing_parse_teacherstv_url($url){

	// This provides some security against inserting bad content.
	// Divides url into http://, www or localization, domain name, path.
  
  if (strpos($url, 'video/watch')) {
    if (!preg_match('/(http:\/\/)(au\.teacherstv\.ca\/)(video\/watch\/)(.*)/', $url, $matches)) {
      return FALSE;
    }

    $domain = $matches[1].$matches[2] . 'v/' . $matches[4];

    return $domain;
  }
  else {
  
    if (!preg_match('/(http:\/\/)(au\.teacherstv\.ca\/)(.*)/', $url, $matches)) {
      return FALSE;
    }

    $domain = $matches[1].$matches[2] . $matches[3];

    return $domain;
  }
}