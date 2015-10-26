<?php

// only do message count if we're logged in
if (!elgg_is_logged_in()) {
  return true;
}

$num_messages = messages_count_unread();

if (!$num_messages) {
  return true;
}

$text = "<span class=\"au-messages-new\" data-count=\"{$num_messages}\" class=\"hidden\">$num_messages</span>";
elgg_require_js('au_landing/messages_count');
