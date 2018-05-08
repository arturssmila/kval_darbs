/**
 * editor_plugin_src.js
 *
 * Copyright 2011, Allen Choong Chieng Hoon
 * Released under BSD License
 *
 * @date	2011-11-30
 * @version	1.0
 */

(function() {
	tinymce.create('tinymce.plugins.InsertTabPlugin', {
		init : function(ed, url) {
			var t = this;
			this.insertTabStatus = false; //So that can pass to other function
			this.ed = ed;
			
			function tabCancel(ed,e) {
				if(e.keyCode === 9) {
					return tinymce.dom.Event.cancel(e);
				}
			}
			
			function tabHandler(ed,e) {
				if(e.keyCode===9 && t.insertTabStatus === true) {
					if(ed.selection.getNode().nodeName.toLowerCase() == 'pre') {
						ed.selection.setContent("\t");
					}
					else {
						ed.selection.setContent('&nbsp;&nbsp;&nbsp;&nbsp;');
					}
					return tinymce.dom.Event.cancel(e);
				}
			}
			
			if(tinymce.isGecko) {
				ed.onKeyPress.add(tabHandler);
				//ed.onKeyDown.add(tabCancel);
			}
			else {
				ed.onKeyDown.add(tabHandler);
			}
			
			ed.addCommand('toggleInsertTab',function() {
					t._toggleInsertTab();
			});
			
			//Register button
			ed.addButton('inserttab',{
						title:'Insert tab',
						image:url+'/inserttab.gif',
						cmd:'toggleInsertTab'
					});
		},
		
		getInfo : function() {
			return {
				longname : 'Insert tab',
				author : 'Allen Choong',
				authorurl : 'http://allencch.wordpress.com',
				version : "1.0"
			};
		},
		
		// Private methods
		_toggleInsertTab: function() {
			this.insertTabStatus = !this.insertTabStatus;
			this.ed.controlManager.setActive('inserttab',this.insertTabStatus);
		}
	});

	// Register plugin
	tinymce.PluginManager.add('inserttab', tinymce.plugins.InsertTabPlugin);
})();
