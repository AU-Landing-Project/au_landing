<?php

// only do message count if we're logged in
if (!elgg_is_logged_in()) {
  return true;
}

$num_messages = messages_count_unread();

if (!$num_messages) {
  return true;
}

$text = "<span class=\"messages-new\">$num_messages</span>";
?>

<script type="text/javascript">
  $(document).ready(function() {
	var notification = '<?php echo $text; ?>';

	$(notification).insertAfter('.au-messages');
  });
</script>

<style>
  .messages-new {
	position: relative;
	left: -10px;
	top: -8px;
  }
</style>