AU Landing
-----------

This plugin provides small customizations that are specific to the landing but are small enough that they don't really warrant their own plugin
Functions that are all providing one outcome or fixing one issue are grouped into a separate file in /lib and included in start.php
This makes it easier to keep track of and remove if necessary

Record of changes:

- Defines new language strings
		* /languages/en.php
		

- Adds custom video handlers for embed_extender that allows embedding of au_teacherstv and slideshare.net
		* registered plugin hooks in init of start.php, handlers in /lib/custom_video_handlers.php

		
- reregisters thewire widget for index context
- adds 'add to the wire' link to wire widget
		* overwrites wire content view at views/default/widgets/thewire/content.php (uses search context)
		* widget re-registered in init of start.php

		
- restores group acls as access options
		* registered plugin hook in init of start.php
		* handler in /lib/group_acls_for_access_options.php

		
- intercepts apache logs of deprecation notices
		* registered plugin hook in global scope of start.php
		* handler in /lib/deprecation log
		* toggle /views/default/plugin/au_landing/settings.php

		
- removes 'online users' tab
		* overwrites view at views/default/members/nav.php
		
		
- prevents routing to online users page
		* 'route' hook registered in init of start.php
		* handler in /lib/remove_online_users_tab.php

		
- Adds in missing widget 'group_forum_topics' previously found in widget manager, custom index groups widget
		* widgets registered in init of start.php
		* widget views in /views/default/widgets/group_forum_topics and /views/default/widgets/index_groups

		
- Modifies html_widget to give rich text editor (views/default/widgets/free_html/edit.php)
		* views/default/widgets/free_html/edit.php
		
		
- Modifies css to allow editor to extend outside of narrow widgets
		* views/default/au_landing/css.php
		
		
- extends widget edit view (prepending) to let users know to refresh the page if tinymce doesn't work after moving a widget
		* views/default/au_landing/textwidgets.php

		
- Changes group custom layout background image to just inside the group instead of whole page
		* overwrites views/default/group_custom_layout/group/css.php

		
- Makes individual_poll widget work in groups
		* overwrites views/default/widgets/poll_individual/content.php

//restored by jon		
- removes the "house" link from widget manager tabbed dashboard due to broken design
		* unregistered in init of start.php

		
// https://github.com/Elgg/Elgg/pull/326
// note this was never pulled in due to plans to change to CKeditor
- Makes tinymce work for ajax loaded textareas
- updates tinymce libraries
		* overwrites views/default/tinymce/init.php
		* overwrites views/default/js/tinymce.php

		
- appends link to notification settings to all notifications
		* hooked in init of start.php
		* handler in /lib/notification_subscription_settings_info.php
		

- sends notification to users when entities they own are edited by someone else
		* 'update' event registered in global scope of start.php
		* handler au_landing_page_update in /lib/functions.php
		
//replaced by Jon - widget maanger version still causes major server crisis
- removes 'and' option of content_by_tag widget (from Widget Manager)
		* overwrites views/default/widgets/content_by_tag/content.php
		* overwrites views/default/widgets/content_by_tag/edit.php
		

- removed links to group content when unavailable (not a member of a closed group)
		* 'menu:owner_block' hook called in init of start.php
		* handler in /lib/functions.php
		

- adds 'mine' option to dashboard river widget
		* overwrites /views/default/widgets/river_widget/edit.php
		* overwrites /views/default/widgets/river_widget/content.php
		

- routes blog/new to blog/add to handle old links/bookmarks
		* 'route' hook registered in init of start.php
		* handler in /lib/functions.php
		

- allows 20 featured groups to be displayed
		* overwrites /views/default/groups/sidebar/featured.php
		

- fixes title link in event_calendar widget
		* hook registered in init of start.php
		* handler in /lib/functions.php


- alerts users on login if they have an invalid email address on the system
		* login event registerd in global scope of start.php
		* handler in /lib/functions.php


- adds help text for change-email form
		* overwrites /views/default/core/settings/account/email.php
		
		
- removes limit of 50 friends in recipient dropdown when sending a message
		* messages router hook registered in init of start.php
		* handler au_landing_messages_router in /lib/functions.php

		
- removes page menu link for 'mail members' on group profile
- removes page menu link for edit group appearance
		* page menu hooked in init of start.php
		* handler au_landing_pagemenu in /lib/functions.php


- removes page menu link for 'edit group layout', adds GCL form to group other options tab of edit page (provided by group_tools)
		* view extension in init of start.php
		* views/default/groups/edit_gcl.php

		
// Note - this should be able to be removed after upgrading to Elgg 1.8.15
// JD - removed this
//- removes 'notifications' link in group profile for users who are not members of the group
//		* overwrites /views/default/groups/sidebar/my_status.php
		
		
- adds messages count to any menu item that contains a span with the class au-messages
		* views/default/au_landing/messages_count.php
		

//Note - JD removed this - now provided by thewire_tools
- forces thewire to be visible to logged in users only
		* object create event registered in global scope of start.php
		* handler au_landing_thewire_access in /lib/functions.php