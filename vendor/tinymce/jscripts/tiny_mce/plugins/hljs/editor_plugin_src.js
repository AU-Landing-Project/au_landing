/**
 * @author Ron Wardenier
 * @version 1.0 (2011-08-21)
 * Based on codehighlight by Nawaf M Al Badia
 * To be used with highlight.js (http://softwaremaniacs.org/soft/highlight/en/)
 */

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('hljs');

	tinymce.create('tinymce.plugins.hljs', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('mceaddhljs', function() {
				ed.windowManager.open({
					file : url + '/hljs.htm',
					width : 530 + ed.getLang('hljs.delta_width', 0),
					height : 500 + ed.getLang('hljs.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url, // Plugin absolute URL
					some_custom_arg : 'custom arg' // Custom argument
				});
			});

			// Register example button
			ed.addButton('hljs', {
				title : 'hljs.hljs_button_desc',
				cmd : 'mceaddhljs',
				image : url + '/img/hljs.gif'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('hljs', n.nodeName == 'IMG');
			});
		},

		/**
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'hljs',
				author : 'Ron Wardenier',
				authorurl : 'http://wardenier.com/',
				infourl : 'mailto://ron@wardenier.com',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('hljs', tinymce.plugins.hljs);
})();