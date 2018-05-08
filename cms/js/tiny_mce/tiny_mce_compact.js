/*tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        //plugins : "table,inlinepopups",
        plugins : "table,save,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect,forecolor,backcolor,|,link,unlink,table,removeformat,code",
        theme_advanced_buttons2 : "insertimage",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Example content CSS (should be your site CSS)
        content_css : "/cms/css/tiny_mce_content.css",

});*/

tinyMCE.init({
        // General options
	setup : function(ed) {
				ed.onKeyUp.add(function(ed, e) {
					$('#'+ed.id).val(tinyMCE.activeEditor.getContent());
					
					//Nezinu, kāpēc te ir šīs divas rindiņas.. 
					//Aizkomentētas, jo met erroru jebkurā Tiny lauciņā --v
					//value[ed.id] = tinyMCE.activeEditor.getContent();
					//show_template();
					// ------^
				});
				},
   
        mode : "specific_textareas",
        entity_encoding : "raw",
        editor_selector : "tiny",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        extended_valid_elements : "line",
        // Theme options
        //theme_advanced_buttons1 : "bold,italic,underline,strikethrough,cite,line,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect,forecolor,backcolor,|,link,unlink,table,image,removeformat,code",
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,cite,line,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,table,image,removeformat,code",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "/cms/css/tiny_mce_content.css",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});
