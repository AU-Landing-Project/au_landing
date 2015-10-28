# AU Landing

This plugin provides small customizations that are specific to the landing but are small enough that they don't really warrant their own plugin
Functions that are all providing one outcome or fixing one issue are grouped into a separate file in /lib and included in start.php
This makes it easier to keep track of and remove if necessary

Record of changes:

- Defines new language strings

		* /languages/en.php

		
- restores group acls as access options

		* registered plugin hook in init of start.php

		* handler in /lib/group_acls_for_access_options.php

		
- intercepts apache logs of deprecation notices

		* registered plugin hook in global scope of start.php

		* handler in /lib/hooks.php

		* toggle /views/default/plugin/au_landing/settings.php

		
- removes 'online users' tab

		* members:config, tabs hook registered in init
                
                * handler in /lib/hooks.php
		
		
- prevents routing to online users page

		* 'route' hook registered in init of start.php

		* handler in /lib/hooks.php


		
- Changes group custom layout background image to just inside the group instead of whole page

		* overwrites views/default/group_custom_layout/group/css.php


- appends link to notification settings to all notifications

		* hooked in init of start.php

                * hook in hooks.php au_landing_email_append
		

- sends notification to users when entities they own are edited by someone else

		* 'update' event registered in init of start.php

		* handler au_landing_page_update in /lib/events.php
		
//replaced by Jon - widget manager version still causes major server crisis
- removes 'and' option of content_by_tag widget (from Widget Manager)

		* overwrites views/default/widgets/content_by_tag/content.php

		* overwrites views/default/widgets/content_by_tag/edit.php
		

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

		* handler in /lib/hooks.php


- alerts users on login if they have an invalid email address on the system

		* login event registered in init of start.php

		* handler in /lib/events.php


- adds help text for change-email form

		* overwrites /views/default/core/settings/account/email.php

		
- removes page menu link for 'mail members' on group profile

- removes page menu link for edit group appearance

		* page menu hooked in init of start.php

		* handler au_landing_pagemenu in /lib/hooks.php


- GCL form added to group_tools other options page

                * view extended in init

                * view extension views/default/au_landing/gcl.php

		
- adds messages count to any menu item that contains a span with the class au-messages

		* views/default/au_landing/messages_count.php

                * views/default/js/au_landing/messages_count.js

                * views/default/css/au_landing.php
		
