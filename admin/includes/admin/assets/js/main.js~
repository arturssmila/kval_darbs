function action(action) {
	document.getElementById('action').value = action;
}

Opentip.styles.generic = { 
	borderColor: "white",
	background: "white"
}	

Opentip.defaultStyle = "generic";



$(document).ready(function() {
	tinymce.baseURL = "/admin/includes/admin/assets/vendor/tinymce";

	tinymce.init({ 
		selector: "textarea#mce_edit",//aizvieto tikai textarea ar id mce_edit
		skin: "custom",
	    setup: function (editor) {
	        editor.on('change', function () {
	            tinymce.triggerSave();
	        });
	    }
	});

	if ($("body").find(".page_1").length > 0) {
		$("body").find(".page_item:not(.page_1)").hide();

		$(".pagination .pages .page:first-child").addClass("active");
	}

	$(".alert").click(function() {
		$(this).fadeOut(100);
	});

	$(".ui.sortable").tablesorter({
		sortList: [[0,1]],
		selectorHeaders: "> thead > tr > th",
    	cssInfoBlock : "avoid-sort", 
		textExtraction: function (node) {
            var txt = $(node).text();
            txt = txt.replace('-', '');
            return txt;
        },
        emptyTo: 'bottom'

		/*textExtraction: function (node) {
	        if (($(node).index()==6) && ($(node).text().toLowerCase()=='-')){
	        	$(node).parent().addClass('jsnamark');
	        }
	        return $(node).text();
	    }*/
	}).bind('sortEnd', function () { 
		$(".hidden_tables").each(function(){
			if(!($(this).hasClass("hidden"))){
				$(this).addClass("hidden");
			}
		});
		$(".page_item").removeAttr("style");
	    //$(this).append($(this).find('.jsnamark'));
	}); 

	/*$(".hover").click(function() {
		var $target = $($(this).data("drop"));

		$target.insertAfter($(this));

		$target.slideToggle("fast");

		$target.find("*:hidden").show();
		console.log("Ŗeee");
	});*/

	var last_clicked = -1;

	$("#requests tr.hover, #vacancy_requests tr.hover").click(function(e) {
		var id_str = $(this).attr("data");
		var $targ = $('#' + id_str);
		var pls_show_id = $(".pls_show").attr("id");
		$(".pls_show").not("#" + id_str).addClass("hidden").removeClass("pls_show");
		$("tr.ui.hover.page_item[data='" + pls_show_id + "']").removeAttr("style");
		$("#requests tr.hover").removeAttr("style");
		$("#vacancy_requests tr.hover").removeAttr("style");

		if($targ.hasClass("pls_show")){
			$targ.removeClass("pls_show");
			$targ.removeAttr( 'style' );
			$targ.addClass("hidden");	
		}else{
			$(this).css("background-color", "#eceff2");	
			$targ.insertAfter($(this));
			$targ.slideToggle("fast");
			$targ.removeAttr( 'style' );
			$targ.removeClass("hidden");
			$targ.addClass("pls_show");	
		}
	});
   	
   	$("a.link_ap").click(function(e) {
        e.stopPropagation();
   });

	


	$(".ui.checkbox").click(function(event) {
		event.stopPropagation();
	});

	/*$("#estates > .ui > thead > tr > th").click(function() {
		$("[data-drop]").each(function(index) {
			var $target = $($(this).data("drop"));

			$target.hide();
		});
	});*/

	var origin_tables = {};

	$(".ui.search").bind("propertychange change click keyup input paste", function(event) {
		var $target = typeof $(this).data("target") == "undefined" ? $("body").find("table.ui").first() : $($(this).data("target"));

		var id = $(this).attr("class");

		if (! (id in origin_tables)) {
			origin_tables[id] = $target.clone(true, true);
		}

		var search = $(this).val();

		$target.find("tr").show();
		$target.find("td").css("background", "inherit");

		$target.replaceWith(origin_tables[id]);

		$.each($target.find("tbody tr"), function(key, value) {
			var has = false;

			$.each($(this).find("td"), function(key2, value2) {
				if ($(this).html().toLowerCase().indexOf(search.toLowerCase()) > -1) {
					has = true;
				}
			});

			if (! has) {
				$(this).hide();
			}
		});

		$target.find("table").hide();

		$target.tablesorter({
			sortList: [[0,1]],
			selectorHeaders: "> thead > tr > th"
		}); 
	});

});