<?php

function au_landing_email_notify($from, $to, $subject, $message, $params) {
  $message .= elgg_echo('au_landing:notification:append', array(elgg_get_site_url() . 'settings/user/' . $to->username));
  
  email_notify_handler($from, $to, $subject, $message, $params);
}

function au_landing_site_notify($from, $to, $subject, $message, $params) {
  $message .= elgg_echo('au_landing:notification:append', array(elgg_get_site_url() . 'settings/user/' . $to->username));
  
  messages_site_notify_handler($from, $to, $subject, $message, $params);
}