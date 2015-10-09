<?php

$english = array (
	'PRIVATE' => "Private (only you)",
    'au_landing:notification:append' => '
      
--- --- ---
You have received this notification via Athabasca Landing.
You can enable/disable notifications through your personal settings at %s
      ',
    'au_landing:page:update:subject' => "The page '%s' was edited",
    'au_landing:page:update:message' => "The page '%s' was edited by %s.  Check out the new version here: %s",

	// custom_index_widgets
    'custom_index_widgets:latest_wire_index' => 'Latest wire posts',

    // embed
    'embed:title' => 'Embed a File / Upload a File',

    // embed and welcomer
    'media:insert' => 'Embed a File / Upload a File',

    // event_calendar
    'item:object:event_calendar' => 'Event Calendar',
    'event_calendar:show_friends' => "Calendars of people you follow",
	'event_calendar:listing_title:friends' => "Calendars of people you follow",
      
    // core
    'dashboard' => 'Your Dashboard',
    'mysettings' => 'Your Account',
    'dashboard:configure' => "Customize this page!",
	'dashboard:nowidgets' => "Your dashboard is your gateway into the site. Click 'Customize this page!' to add widgets to keep track of content and your life within the system.",
    'thewire' => 'The Wire',
	'option:notset' => '--Not Set--',
	'groups:leave' => 'Withdraw from group',
	'usersettings:user:opt:linktext' => "Change your main settings",
	'usersettings:plugins' => "Other settings",
	'usersettings:plugins:opt:description' => "Configure settings (if any) for your active tools.",
	'usersettings:plugins:opt:linktext' => "Configure other settings",

	'usersettings:plugins:description' => "This panel allows you to control and configure the personal settings for various features of the Landing.",
	
	//polls
	'poll:voted' => "Your vote has been cast for this poll. Thank you for voting on this poll",

    // core
    'myprofile' => 'Your Profile',
	'mine' => "Yours",
	'user:name:label' => "Your display name <br /><span style='font-size:small;font-weight:normal;'><em>Your name as it will appear to others. Note that this is visible to the world.</em></span> ",
//PAGES
	/**
	 * Menu items and titles
	 */

	'pages' => "Wikis",
	'pages:owner' => "%s's wikis",
	'pages:friends' => "Wikis of people you follow",
	'pages:all' => "All site wikis",
	'pages:add' => "Add wiki page",

	'pages:group' => "Group wikis",
	'groups:enablepages' => 'Enable group wikis',

	'pages:edit' => "Edit this wiki",
	'pages:delete' => "Delete this wiki page",
	'pages:history' => "History",
	'pages:view' => "View wiki",
	'pages:revision' => "Revision",

	'pages:navigation' => "Navigation",
	'pages:via' => "via pages",
	'item:object:page_top' => 'Wikis',
	'item:object:page' => 'Wiki',
	'pages:nogroup' => 'This group does not have any wikis yet',
	'pages:more' => 'More wikis',
	'pages:none' => 'No wikis created yet',
	'pages:yours' => "Your wikis",
	'pages:user' => "Wiki home",
	'pages:new' => "New wiki page",
	'pages:groupprofile' => "Group wikis (formerly Pages)",
	'pages:welcome' => "Edit welcome message",
	'pages:welcomemessage' => "Welcome to the wiki tool of %s. This tool allows you to create wikis on any topic and select who can view them and edit them. ",
	'pages:welcomeerror' => "There was a problem saving your welcome message",
	'pages:welcomeposted' => "Your welcome message has been posted",
	'pages:via' => "via wiki",
	'item:object:pages_welcome' => 'Wiki welcome blocks',

			

	/**
	* River
	**/

	'river:create:object:page' => '%s created a wiki page %s',
	'river:create:object:page_top' => '%s created a wiki page %s',
	'river:update:object:page' => '%s updated a wiki page %s',
	'river:update:object:page_top' => '%s updated a wiki page %s',
	'river:comment:object:page' => '%s commented on a wiki page titled %s',
	'river:comment:object:page_top' => '%s commented on a wiki page titled %s',
  'river:widgets:mine' => 'Yours',
  'river:widgets:friends' => 'Those you are following',

	/**
	 * Form fields
	 */

	'pages:title' => 'Page title',
	'pages:description' => 'Page text',
	'pages:tags' => 'Tags (comma separated)',
	'pages:access_id' => 'Read access',
	'pages:write_access_id' => 'Write access',

	/**
	 * Status and error messages
	 */
	 
	'pages:noaccess' => 'No access to page',
	'pages:cantedit' => 'You cannot edit this page',
	'pages:saved' => 'Page saved',
	'pages:notsaved' => 'Page could not be saved',
	'pages:error:no_title' => 'You must specify a title for this page.',
	'pages:delete:success' => 'The page was successfully deleted.',
	'pages:delete:failure' => 'The page could not be deleted.',

	/**
	 * Page
	 */
	'pages:strapline' => 'Last updated %s by %s',

	/**
	 * History
	 */
	'pages:revision:subtitle' => 'Revision created %s by %s',

	/**
	 * Widget
	 **/

	'pages:num' => 'Number of wiki pages to display',
	'pages:widget:description' => "This is a list of your wiki pages.",

	/**
	 * Submenu items
	 */
	'pages:label:view' => "View wiki page",
	'pages:label:edit' => "Edit wiki page",
	'pages:label:history' => "Page history",

	/**
	 * Sidebar items
	 */
	'pages:sidebar:this' => "This wiki page",
	'pages:sidebar:children' => "Sub-pages",
	'pages:sidebar:parent' => "Parent",

	'pages:newchild' => "Create a sub-page",
	'pages:backtoparent' => "Back to '%s'",	

	
//AUfollowing

   'friends' => "Following",
    'friends:yours' => "You are following",
    'friends:owned' => "People %s is following",
    'friend:add' => "Follow this person",
    'friend:remove' => "Stop Following",
    'friends:add:successful' => "You are now following %s.",
    'friends:add:failure' => "Error. You could not follow %s.",
    'friends:remove:successful' => "You are no longer following %s.",
    'friends:remove:failure' => "Error. You cannot stop following %s.",
    'friends:none' => "This user isn't following anyone yet.",
    'friends:none:you' => "You aren't following anyone yet. Search for your interests to find people to follow.",
    'friends:none:found' => "No followers were found.",
    'friends:of:none' => "Nobody is following you yet.",
    'friends:of:none:you' => "Nobody is following you yet. Start adding content and fill in your profile to let people find you!",
	'friends:icon_size' => "Icon size",
	'friends:tiny' => "tiny",
	'friends:small' => "small",
    'friends:of' => "Followers",
    'friends:of:owned' => "People who are following %s",
    'friends:num_display' => "Number of people you are following to display",
    'friends:collections' => "Circles",
    'friends:collections:add' => "New circle",
    'friends:addfriends' => "Add to circle",
    'friends:collectionname' => "Circle name",
    'friends:collectionfriends' => "Members in circle",
	'friends:collectionedit' => "Edit this circle",
	'friends:nocollections' => "You do not yet have any circles.",
	'friends:collectiondeleted' => "Your circle has been deleted.",
	'friends:collectiondeletefailed' => "We were unable to delete the circle. Either you don't have permission, or some other problem has occurred.",
	'friends:collectionadded' => "Your circle was successfuly created",
	'friends:nocollectionname' => "You need to give your circle a name before it can be created.",
	'friends:collections:members' => "Circle members",
	'friends:collections:edit' => "Edit circle",
    'friends:river:created' => "%s added the following widget.",
    'friends:river:updated' => "%s updated their following widget.",
    'friends:river:delete' => "%s removed their following widget.",
    'friends:river:add' => "%s is following",
	'river:friend:user:default' => "%s is now following %s",
 
    'river:widget:title:friends' => "Following Activity",
    'river:relationship:friend' => "is now following",
		'river:widget:type' => "Which river would you like to display? One that shows your activity or one that shows the activity of those you are following?",
		'river:widgets:friends' => "Following",
		'river:widget:description:friends' => "Show the activity of those you follow",
	'userpicker:only_friends' => 'Only those you are following',
			'friendspicker:chararray' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
    'thewire:friendsdesc' => 'This widget will show the latest from those you following on the wire',
    'thewire:friends' => 'Activity of those you are following on the wire',

		'activity:friends' => 'Activity of people you follow',
		'activity:person:friends' => 'Activity of those %s is following ',

    'blog:user:friends' => "Blog of those %s follows",
    'blog:title:friends' => 'Blogs of people you follow',
    'blog:friends' => "Blogs of people you follow",
    'blog:yourfriends' => "Latest blogs of people you follow",

    'bookmarks:friends' => "Bookmarks of people you follow",
    'bookmarks:bookmarklet:description' =>
        "The bookmarks bookmarklet allows you to share any resource you find on the web with others, or just bookmark it for yourself. To use it, simply drag the following button to your browser's links bar:",

    'groups:invite' => "Invite someone",
    'groups:inviteto' => "Invite someone to '%s'",
		'groups:nofriends' => "You have no one left whom you are following that has not been invited to this group.",

    'feeds:friends' => "Following feeds",
    'feeds:friendsfeeds' => 'Following feeds',
    'feeds:friendswelcome' => "This page lets you view all of the feeds of those you are following who have made them available to their network. If any are available, you will see a list over on the righthand side. Click on a link to read the contents",

    'file:yours:friends' => "Files of people you follow",
    'file:friends' => "Files of people you are following",
    'file:friends:type:video' => "Videos of people you follow",
    'file:friends:type:document' => "Documents of people you follow",
    'file:friends:type:audio' => "Audio of people you follow",
    'file:friends:type:image' => "Pictures belonging to people you follow",
    'file:friends:type:general' => "General files of people you follow",

    'friends:all' => 'Everyone you are following',
    'notifications:subscriptions:collections:title' => 'Circle Notifications',
	'notifications:subscriptions:collections:description' => 'To toggle settings for members of your circles, click the icons below.',
	'notifications:subscriptions:collections:edit' => 'To edit your circles, click here.',
	'notifications:subscriptions:description' => 'To receive notifications when new content is created by the people you are following, find them below and select the notification method you would like to use.',
	'notifications:subscriptions:friends:title' => 'People you follow',
	'notifications:subscriptions:friends:description' => 'Select how (or if) you would like to receive notifications when people in the following circles post new content.',
    'access:friends:label' => 'People you are following',

    'friend:newfriend:subject' => "%s is now following you!",
    'friend:newfriend:body' => "%s is now following your status!

To view their profile, click here:

%s

Please do not reply to this email.",

    'friends:invite' => "Invite someone",
    'invitefriends:introduction' => "To invite people to join you on this network, enter their email addresses below (one per line):",
		'invitefriends:success' => "Invitation success.",
		'invitefriends:failure' => "Invitation failure.",
		'invitefriends:email' => "You have been invited to join %s by %s. They included the following message:

%s

To join, click the following link:

	%s

You will automatically follow them when you create your account.",
    'eligo:owners:friends' => "People I'm following",

/* polls */			
			'poll:friends' => "Polls of people you follow",
			'poll:yourfriends' => "Latest Polls of people you are following",	
			'polls:user:friends' => "Polls of people that %s follows",
			'polls:friends' => "Polls of people that you follow",
			'polls:not_me_friends' => "Polls of people that %s follows",
			'polls:yourfriends' => "Latest polls from people you follow",
			'group:polls:empty' => 'This group has no polls yet', 		

/* tidypics */

			'album:yours:friends' => "Photo albums of people you follow",
			'album:friends' => "Photo albums of people %s follows",


// people you may know
	'suggested_friends' => 'People you may know',
	'suggested_friends:new:people' => 'People you may know',
	'suggested_friends:people:you:may:know' => 'People you may know',
	'suggested_friends:friends:only' => 'People followed by those you are following',
	'suggested_friends:is:friend:of' => 'Followed by %s',
	'suggested_friends:mutual:friends' => '%s followers: %s',


//members
	'members:members' => "People on the Landing",
    'members' => "People on the Landing",
	
//extendafriend
		'extendafriend:form:instructions' => "<strong>Circles</strong> are <em>optional</em> ways to group the people you follow. You can use them to limit access to content you create, and to filter things you see and notifications you receive. No one else will be able to see your circles: they are completely private to you.<br /><p><strong>To create or edit circles</strong>, enter names for them separated by commas (e.g. <em>friends, colleagues, students, tutors</em>). If you have any existing circles, they will appear with checkboxes beside them: checking or unchecking a box will add or remove this person from that circle. When you have finished editing your circles, press Return or click the Submit button. </p><br /><p> To simply follow this person without adding them to any circles, just click the submit button. If you don't want to follow this person, <em>close this popup</em></p>",
		'extendafriend:updated' => "Your circles have been updated",
		'extendafriend:rtags' => "Circles",		
		'extendafriend:edit:friend'	=> 'Circles',	
    
// group custom layout
    'group_custom_layout:edit' => "Edit Group Appearance",
		'group_custom_layout:edit:title' => "Edit Group Appearance",
    'group_custom_layout:edit:reset:confirm' => "Are you sure you wish to reset the custom group appearance?",
    'group_custom_layout:action:reset:error:no_custom' => "This group doesn't have a Custom Appearance to remove",
		'group_custom_layout:action:reset:error:remove' => "Error while removing Custom Appearance, please try again",
		'group_custom_layout:action:reset:success' => "Custom Appearance successfully removed",
    'group_custom_layout:action:save:error:add_to_group' => "Error while adding Custom Appearance to group",
		'group_custom_layout:action:save:success:group' => "Custom Appearance successfully saved",
		'group_custom_layout:action:save:error:last_save' => "Error while saving existing Custom Appearance",
		'group_custom_layout:action:save:success:existing' => "Custom Appearance successfully edited",
	
//group tools
		'group_tools:settings:auto_join:description' => "New users will automatically join the following groups",
		'group_tools:admin_transfer:submit' => "Transfer",
		'group_tools:groups:sorting:alfabetical' => "Alphabetical",
		'group_tools:action:mail:success' => "Message succesfully sent",

//widget_manager
		'widget_manager:add' => "<strong>Click to add a new widget</strong>",
    'widgets:group_forum_topics:title' => "Latest Discussion",
    'widgets:group_forum_topics:description' => "Show the latest forum topics",
    'widgets:group_forum_topics:settings:topic_count' => "Number of topics to show",
    'widget_manager:widgets:index_groups:name' => "Latest Groups",
    'widget_manager:widgets:index_groups:description' => "Show the latest and featured groups",
    'widget_manager:widgets:index_groups:no_result' => "No results",
    'widget_manager:widgets:index_groups:group_count' => "Number of groups to show",
    'widget_manager:widgets:index_groups:featured' => "Show only featured groups?",
    
		
//thewire
		'thewire:add' => "Add a wire post",
    
    // Likes
    
  'likes:this' => 'recommended this',
	'likes:deleted' => 'Your recommendation has been removed',
	'likes:see' => 'See who recommended this',
	'likes:remove' => 'Un-recommend this',
	'likes:notdeleted' => 'There was a problem removing your recommendation',
	'likes:likes' => 'You recommended this item',
	'likes:failure' => 'There was a problem recommending this item',
	'likes:alreadyliked' => 'You have already recommended this item',
	'likes:notfound' => 'The item you are trying to recommend cannot be found',
	'likes:likethis' => 'Recommend this',
	'likes:userlikedthis' => '%s recommendation',
	'likes:userslikedthis' => '%s recommendations',
	'likes:river:annotate' => 'recommends',
	'likes:delete:confirm' => 'Are you sure you want to un-recommend this?',

	'river:likes' => 'recommends %s %s',

	// notifications. yikes.
	'likes:notifications:subject' => '%s recommends your post "%s"',
	'likes:notifications:body' =>
'Hi %1$s,

%2$s recommends your post "%3$s" on %4$s

See your original post here:

%5$s

or view %2$s\'s profile here:

%6$s

Thanks,
%4$s
',
    
    // rename 'ban' to 'disable'
      'member_selfdelete:delete:account' => "Delete your account",
    'LoginException:BannedUser' => 'Your account has been disabled, you cannot log in.  If this is in error please email an administrator at landing@athabascau.ca to have your account reinstated.',
    'admin:user:ban:no' => "Can not disable user",
	'admin:user:ban:yes' => "User account disabled.",
	'admin:user:self:ban:no' => "You cannot disable your own account",
	'admin:user:unban:no' => "Can not reinstate user",
	'admin:user:unban:yes' => "User reinstated.",
    'ban' => "Disable Account",
	'unban' => "Reinstate Account",
	'banned' => "Account Disabled",
    'member_selfdelete:option:ban' => "Disable Account",
    'member_selfdelete:options:explanation:ban' =>"All of the users content will remain accessible with existing permissions.  The display
  name remains the same, the profile picture is reset to default.  The profile is visible, but will
  display the fact that the account is disabled.  They will not be able to log back in, though an administrator
  can re-enable the account.",
    
    /* File Tools */
    
    'file_tools:settings:sort:default' => 'Default file folder sorting options',
    
    /* Default Access */
    
    'default_access:settings' => "Default access permission for your posts <br /><span style='font-size:small;font-weight:normal;'><em>This affects the default permissions for your personal posts. It may be overridden when posting to groups. You may override this for every post that you make.</em></span>",
    
    /* email form */
    'email:address:instructions' => "The email address must be valid, if you
      wish to disable notifications you may do so in your settings here: %s",
		
    /* Groups */
    'groups:enableactivity' => 'Enable group activity tool',
    'blog:enableblog' => 'Enable group blog tool',
    'bookmarks:enablebookmarks' => 'Enable group bookmarks tool',
    'groups:enablepages' => 'Enable group wiki tool',
    'groups:enablefiles' => 'Enable group files tool',
	'groups:owned' => "Groups you own",
	'groups:yours' => "Your groups",
	'groups:nofriends' => "You have no people you are following left who have not been invited to this group.",
    
    /* Circles */
    'collections:add' => "New Circle",
    
    'au_landing:invalidemail' => "Your email address appears to be missing or invalid.
      Please enter a valid email address in your settings ('Your Account') so your notifications will work correctly.
      Notifications can also be controlled through your personal settings.",
    'activity_tabs:description' => "Here you can set up the activity tool to display the activities of all the people in
									groups that you belong to or circles that you 
									have made. Each will be displayed in its own tab. This is especially useful
									if you are interested in what people in specified groups have been posting
									both within the group and outside it, without the need to explicitly follow them.<br />
									Enable Activity Tabs for groups and circles:",
    'activity_tabs:collection' => "Circle",
    'activity_tabs:collections' => "Circles",
	
	'au_landing:textwidget:helptext' => "There is a bug with the text editor if the widget is moved before it is saved.  If you <b>cannot edit text</b> try refreshing the page once the widget is in the desired position.",
	
	// Liked Content
	'liked_content:most_liked' => "Number of recommendations",
	'liked_content:group:most_liked' => "Most recommended content",
	'liked_content:group:liked_content' => "Group recommended content",
	'liked_content:group:enable' => "Enable most recommended content",
	'liked_content:user:most_liked' => "Most recommended content",
	'liked_content:user:liked_content' => "Recommended content",
	'liked_content:liked_content' => "Recommended content",
	'liked_content:user:likes' => "Recommended by %s",
	'liked_content:user:most_liked' => "Recommended by Others",
	'liked_content:noresults' => "There is no recommended content to display",
	
	// Your Likes
	'liked_content:widget:your_likes:title' => "Recommended content",
	'liked_content:widget:your_likes:description' => "Display content that has been recommended",
	'liked_content:widget:your_likes:mine' => "Show only content you have recommended",
	
	// Your status
	'groups:my_status' => '',
	
	// Tags
	'tag_names:event_tags' => "Tags (comma separated)",
	'file:tags' => "Tags (comma separated)",
	'groups:interests' => "Tags (comma separated)",
	'rssimport:tags' => "Tags (comma separated)",
	'album:tags' => "Tags (comma separated)",
	'tag_names:tags' => "Tags (comma separated)",
	'tags' => "Tags (comma separated)",
	
	// au sets
	'au_sets:body' => "Description",
	
	// containers
	'container' => 'Where to post this',
	'container:in-group' => 'Posted to group',
	
	//fix for missing language strings in notification_subjects 
	    'notification_subjects:event:publish' => "created a",
	    'notification_subjects:event:notify' => "posted a new", 
	    
	//temp workaround for wrong notification message in groups 
	'groups:subscribed' => 'Group notifications',    
	'groups:unsubscribed' => 'Group notifications',    
	
	//fix for inverted phrasing in group tools
	'group_tools:cleanup:actions' => "Prevent users from joining this group",
	
	//thewire_tools
	'thewire_tools:usersettings:notify_mention' => "Receive a notification when you're mentioned in a Wire post",
	
	//system 404 message
	'error:404:content' => "Oops, sorry - we couldn't find that page. Please check the URL and/or use the Search field to find what you are looking for.",
	'au_landing:widget_reminder' => "<p><strong>Group administrator: click the 'Add Widgets' button to add widgets. Widgets make it much easier for your group members to find their way around this group and for you to emphasize things that you think are important. We recommend that you at least add a 'Group Activity' widget so that users can instantly see recent posts and comments.</strong></p>",

);
    
add_translation('en', $english);