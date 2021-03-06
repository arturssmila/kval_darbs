jQuery(window).bind("load", function() {
	optimize_elements();
    optimizeSponsors();
    /*if (($("#home").length > 0) || ($("#service_list").length > 0)){
        equalheight('.card .description');
    }*/
});

var isAdvancedUpload = function() {//make sure if broswer supports drag and drop upload
    var div = document.createElement('div');
    return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
}();
var is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
var $form = $('.box.file_upload');
var from_to = "none";//variable to see which lang select is open
if (isAdvancedUpload) {
    $form.addClass('has_advanced_upload');
    //$(".file_upload_value").attr("placeholder", lg.drag_drop + ":");
}
var $form_input = $('.box__input .box__file');
var from_other = false;//used for other lang checkbox
var to_other = false;//used for other lang checkbox
$(window).scroll(function(){ optimize_elements(); });
$(window).resize(function() { optimize_elements(); 
    optimizeSponsors();
    if (($("#home").length > 0) || ($("#service_list").length > 0)){
        equalheight('.card .description');
        equalheight('.card .title');
    }
 });

function optimize_elements() {
	optimize_stock_elements();/* DONT REMOVE */
}

function toggle_question_form($el, only_open) {
    $form = $el.parent();

    $modal = $form.parent();


    if (typeof only_open !== 'undefined') {
        if ($form.is(":visible")) {
             return;
        }
    }

    $form.find(".contents").slideToggle(250);
    $form.toggleClass("open");
    $modal.toggleClass("modal");
}
var sponsors_open = false;
var form_data = {};
form_data.from_langs = [];
form_data.to_langs = [];
form_data.faili = [];
form_data.file_names = [];
form_data.file_sizes = [];
form_data.time = "";
form_data.time_zone = $(".quote_block input[name=\"time_zone\"]").val();
var form_cv_data = {};
form_cv_data.from_langs = [];
form_cv_data.to_langs = [];
form_cv_data.faili = [];
form_cv_data.file_names = [];
form_cv_data.file_sizes = [];
var curr_rel = 0;
var complete_size = 0;
var done_with_deleting = 1;
$(document).ready(function() {
    updateHeader();  
    optimizeSponsors(); 

    $(".item.logging.simple").click(function(){
        var from_top = $("#header .bar").height();
        $("#log_in").css("top", from_top-2).toggleClass("show");
    })

    $('#login_button').click(function(){
        var data = {};
        $('#modal_login_form .input input').each(function(){
            data[$(this).attr('name')] = $(this).val();
        });
        if(Object.keys(data).length > 0)
        {
            $.ajax({
            type: "POST",
            url: "/cms/libs/00.php",
            data: {
                lang:lang,
                data:data
                },
            async: true,
            success: function(response)
                {
                    if(response=="OK")
                    {
                        window.location.reload();
                    }
                    else
                        alert(response);
                    
                }
            });
        }
    });


    if (($("#home").length > 0) || ($("#service_list").length > 0)){
        equalheight('.card .description');
        equalheight('.card .title');
    } 

    $(window).resize(function() {
        updateHeader();
    });

    $( '.scrollable' ).on( 'mousewheel DOMMouseScroll', function ( e ) {
        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
        e.preventDefault();
    });

    $("#page_question_form .title").click(function() {
        toggle_question_form($(this));
    });
    $("#ask_button").click(function() {
        toggle_question_form($("#page_question_form .title"));
    });

    
    var question_submit_clicked = false;
    $('#page_question_form form .controls span').click(function(){
        var sender_name = '';
        var sender_email = '';
        
        if(question_submit_clicked == false)
        {
            question_submit_clicked = true;
            $('#page_question_form .error').remove();
            var required = 0;
            var filled = 0;
            var data = {};
            var i = 0;
            $('#page_question_form .contact_form_line_div').each(function(){
                data[i] = {};
                data[i]["key"]      = $(this).attr('id');
                data[i]["type"]     = ($('input',$(this))[0]) ? 'input' : (($('.select[rel]',$(this))[0]) ? '.select' : 'textarea');
                data[i]["required"] = ($(this).hasClass('required')) ? 'required' : '';
                data[i]["rel"]      = ($(data[i]["type"],$(this)).is('[rel]')) ? $(data[i]["type"],$(this)).attr('rel') : '';
                data[i]["value"]    = $('.select_name',$(data[i]["type"],$(this)))[0] ? $('.select_name',$(data[i]["type"],$(this))).text() : $(data[i]["type"],$(this)).val();
                if(data[i]["required"]!='')
                {
                    //ir selects
                    if($('.select_name',$(data[i]["type"],$(this)))[0])
                    {
                        if($(data[i]["type"]+'[rel]',$(this)).attr('rel') == "")
                        {
                            data[i]["value"] = "";
                            $('.select_name',$(data[i]["type"],$(this))).addClass('redborder');
                        }
                    }
                    else
                    {
                        data[i]["value"] = check_field($(data[i]["type"],$(this))[0],((data[i]["key"]=='email') ? 2 : 3));
                    }
                        
                    if(data[i]["value"]=='')
                    {
                        $('#'+data[i]["key"]+'.contact_form_line_div',$('#page_question_form')).prepend('<div class="error" style="">'+lg["fill_field"]+'</div>');
                        //$('<div class="error" style="">'+lg["fill_field"]+'</div>').insertBefore('#'+data[i]["key"]+'.contact_form_line_div');
                    }
                    else
                    filled++;
                    required++;
                }
                if(data[i]["key"] == "name") sender_name = data[i]["value"];
                if(data[i]["key"] == "email") sender_email = data[i]["value"];
                i++;
            });
            if(filled == required)
            {
                var loading = '<img id="question_loading_image" src="/css/images/loading.gif" />';
                $('#question_submit_button').fadeOut(500,function(){
                    $(loading).insertBefore('#question_submit_button');
                    $('#question_loading_image').fadeIn(500);
                });
                data["subject"] = lg["question_from"] + sender_name;
                send_form_data(sender_name,sender_email,data,function(d){
                    //parāda ziņojumu
                    $('#question_loading_image').stop().remove();
                    if(d=="ok")
                    {
                        $("#page_question_form form #your_question textarea").val("");
                        $("#page_question_form form .controls").find(".button").replaceWith("<span>" + lg["message_sent"] + "</span>");
                        //ga('send', 'event', 'question', 'send', 'question-form', 1);
                    }
                    else
                    {
                        $('#question_submit_result').html('<div class="error">'+d+'</div>',function(){
                            
                        });
                        setTimeout(function() {
                            //$('#question_submit_result').html('');                            
                        },5000);                        
                        question_submit_clicked = false;
                        $('#question_submit_button').stop().show();
                    }
                });
            }
            else 
                question_submit_clicked = false;
        }
    });

    $("#header .bar .search .input, #header .tablet_attributes .tablet_search .search input").keyup(function(){
        var search_value = $(this).val();

        if(search_value!='')
        {
            var dropdown = $('.search_dropdown');
            $.ajax({
                type: 'POST',
                url: "/res/search.php",
                data:{
                    lang: lang,
                    action: "search",
                    search_value: search_value
                },
                async: true,
                success: function(obj) {
                    dropdown.html('');
                    if (obj[0].name != null) {
                        var name = "";
                        for (var n in obj) {
                            var regEx = new RegExp(search_value, "ig");
                            name = obj[n].name.replace(regEx, "<strong>"+search_value+"</strong>");
                            dropdown.append("<a href=\"" + obj[n].lang + "/" +  obj[n].url + "\" class=\"item\">" + name + "</a>");
                        }
                    }else{
                        dropdown.html("<div class=\"item\">" + lg["no_results"] +"</div>")
                    }
                    dropdown.slideDown(100);
                    $('.search_dropdown a.item').unbind();
                    $('.search_dropdown a.item').click(function(){
                        event.preventDefault();
                        var url = $(this).attr('href');
                        
                        $.ajax({
                            type: "POST",
                            url: "/res/search.php",
                            data:
                            {
                                action:     'stats',
                                url:        url,
                                search_value:   search_value
                            },
                            async: true,
                            success: function(data)
                                {
                                    window.location.href = url;
                                }
                            });
                    });
                },
                error: function(data){
                    console.log(data);
                }
            });
        }else{
            $('.search_dropdown').html('');
        }
    });

    $(document).mouseup(function(e) {
        var $dropdown = $(".search_dropdown");

        if (!$dropdown.is(e.target) && $dropdown.has(e.target).length === 0) {
            $dropdown.hide();
        }
    });

    if(!logged_in){
		$(".controls .get_quote").click(function() {
			if(!($("quote_block").is(':visible'))){
				$('#quote_block').toggleClass('show');
				if($('#open_quote').is(':visible')){
					$('#open_quote').toggle();
				}
			}else{
				if(!($('#open_quote').is(':visible'))){
					$('#open_quote').toggle();
				}
			}
			$('html, body').animate({
				scrollTop: $("#quote_block").offset().top - 150
			}, 500);
		});
		$("#blog .right .contents .title.first, #blog_cat .right .contents .title.first, #blog_post .right .contents .title.first").click(function(){
			if($(document).width() < 769){
				$(this).children(".down").toggleClass("show");
				$(this).children(".up").toggleClass("show");
				$(this).next("ul").toggleClass("show");
			}
		});
	
		$("#blog .right .contents .title.second, #blog_cat .right .contents .title.second, #blog_post .right .contents .title.second").click(function(){
			if($(document).width() < 769){
				$(this).children(".down").toggleClass("show");
				$(this).children(".up").toggleClass("show");
				$(this).next(".posts").toggleClass("show");
			}
		});
		$("#more_sponsors").click(function() {
			if(sponsors_open == false){
				$(".sponsors").removeClass("sponsors_close");
				$("#more_sponsors").text(lg.see_less.toUpperCase());
				$(".sponsors").addClass("sponsors_open");
				sponsors_open = true;
			}else if(sponsors_open == true){
				$(".sponsors").removeClass("sponsors_open");
				$(".sponsors").addClass("sponsors_close");
				$("#more_sponsors").text(lg.see_more.toUpperCase());
				sponsors_open = false;
			}
		});
		$('input#modal_file_input:file').on("change", function(){
			if($("input#modal_file_input").attr("mode") == "quote"){
				checkFiles(this.files, curr_rel, "quote_block", form_data);
			}else if($("input#modal_file_input").attr("mode") == "vacancy"){
				checkFiles(this.files, curr_rel, "apply_vacancy", form_cv_data);
			}else if($("input#modal_file_input").attr("mode") == "submit_work"){
				checkFiles(this.files, curr_rel, "submit_work", form_data);
			}
		});
		$("#testimonials_block .controls .item").click(function() {
			$parent = $(this).parent().parent();
			$testimonial = $parent.children(".item:visible");
	
			$testimonial.hide();
	
			if ($(this).hasClass("left")) {
				if ($testimonial.prev(".item").length <= 0) {
					$parent.children(".item:last").show();
					return;
				}
	
				$testimonial.prev(".item").show();
			}
	
			if ($(this).hasClass("right")) {
				if ($testimonial.next(".item").length <= 0) {
					$parent.children(".item:first").show();
					return;
				}
	
				$testimonial.next(".item").show();
			}
		});
		$("#submit_quote").click(function(){
			var validated = 1;
			$("#personal_data .segment .error").remove();
			$("#personal_data .segment input.required").removeClass("redborder");
			$("#personal_data .segment input.phone").removeClass("redborder");
			$("#personal_data .segment input.required").each(function(){
				var val = $(this).val();
				if(val != ""){
					var name = $(this).attr("name");
					if(name == "email"){
						var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
						if(re.test(val) == false){
							$(this).before("<span class=\"error\">" + lg["not_an_email"] + "</span>");
							$(this).addClass("redborder");
							validated = 0;
						}else{
							form_data[name] = val;
						}
					}else{
						form_data[name] = val;
					}
				}else{
					$(this).addClass("redborder");
					$(this).before("<span class=\"error\">" + lg["field_required"] + "</span>");
					validated = 0;
				}
			});
			$("#personal_data .segment .controls input.phone").each(function(){
				var val = $(this).val();
				var name = $(this).attr("name");
				if(val != ""){
					if(name == "phone_country_code"){
						var re = /^(\+?\d{1,3}|\d{1,4})$/;
						if(re.test(val) == false){
							$(this).before("<span class=\"error\">" + lg["not_a_country_code"] + "</span>");
							$(this).addClass("redborder");
							validated = 0;
						}else{
							form_data[name] = val;
						}
					}else if(name == "phone"){
						allowed_ch = "0123456789";
						var result = "";
						for(i=0;i<val.length;i++)
						{
							if(allowed_ch.indexOf(val.substr(i,1)) != -1)
							{
							  result = result + "" + val.substr(i,1);
							}
						}
						if(result.length < 8 || result.length > 15)
						{
							validated = 0;
							$(this).before("<span class=\"error\">" + lg["not_a_valid_number"] + "</span>");
							$(this).addClass("redborder");
						}else{
							form_data[name] = val;
						}
					}
				}else{
					delete form_data[name];
				}
			});
			if($("#quote_block .segment textarea").val() != ""){
				form_data.comment = $("#quote_block .segment textarea").val();
			}
			if(validated == 1){
				$.ajax({
					url: '/res/requests.php',  //server script to process data
					type: 'POST',
					data: {form_data: JSON.stringify(form_data), action: "create_request"},
					async: true,
					success: function(data) {  
						if(data == "big"){
							alert(lg.file_30_exceed+"!");
						}else if(data == "empty"){
							alert(lg.empty_form+"!");
						}else if(data == "ok"){
							alert(lg.form_submitted);
							form_data.from_langs = [];
							form_data.to_langs = [];
							form_data.faili = [];
							form_data.file_names = [];
							form_data.file_sizes = [];
							form_data.time_zone = $("#quote_block input[name=\"time_zone\"]").val();
							$('.language_dropdown_group').each(function(){
								var rel = $(this).attr("rel");
								if(rel > 0){
									$(this).remove();
								}
							});
							$(".file_upload_call").each(function(){
								var rel = $(this).attr("rel");
								if(rel > 0){
									$(this).remove();
								}
							});
							$(".language_dropdown_group[rel=\"0\"] .language_from .text").text(lg["source_language"]);
							$(".language_dropdown_group[rel=\"0\"] .language_from input").removeAttr('value');
							$(".language_dropdown_group[rel=\"0\"] .language_to .language_to_select").text(lg["source_languages"]);
							$(".language_dropdown_group[rel=\"0\"] .language_to input").removeAttr('value');
							updateDropdownFileList(0, "quote_block", form_data);
							$(".more_files_warning.show").removeClass("show");
							$("#quote_block .more").removeAttr("style");
						}
					},
					error: function(data) {
						alert(lg.error+"!");  
						console.log(data);
					}
				});
			}else{
	
			}
		});
    }

    $(".burger").click(function() {
        $(".tablet_menu").toggleClass("show");
    });

    $(document).on("click", '.tablet_dropdown .down.show, .tablet_dropdown .up.show', function() {
        $(this).parent().next('.tablet_dropdown_contents').toggleClass('show');
        $(this).parent().find('.down').toggleClass("show");
        $(this).parent().find('.up').toggleClass("show");
    });

    $('.tab_search_but').click(function() {
        $(this).prev('.search').toggleClass('show');
        $(this).removeClass("show");
        $(".tablet_attributes").addClass("open");
    });

    $('.tablet_company').click(function(){
        $(this).next('.menu_dropdown').stop(true).fadeIn(100);
    });

    $('#open_quote .get_quote').click(function(){
        $('#quote_block').toggleClass('show');
        $('#open_quote').toggle();
    });

    $('#close_quote').click(function(){
        $('#quote_block').toggleClass('show');
        $('#open_quote').toggle();
    });

    $(document).on("click", '#footer .row.contents .section .title .down.show, #footer .row.contents .section .text .down.show, #footer .row.contents .section .title .up.show, #footer .row.contents .section .text .up.show', function(){
        $(this).parent().next('.footer_dropdown').toggleClass("show");
        $(this).parent().children('.down').toggleClass("show");
        $(this).parent().children('.up').toggleClass("show");
    });

    $(document).click(function(event) { 
        if((!$(event.target).closest('#log_in').length) && (!$(event.target).closest('.item.logging.simple').length)){
            if($('#log_in').hasClass("show")) {
                $('#log_in').removeClass("show");
            }
        }//close log in if click out
        if((!$(event.target).closest('.tablet_search .search').length) && (!$(event.target).closest('.tab_search_but').length)) {
            if($('.tablet_search .search').hasClass("show")) {
                $('.tablet_search .search').removeClass("show");
                $(".tablet_attributes").removeClass("open");
                $('.tab_search_but').addClass("show");
            }//close search bar if click out
        }
        if((!$(event.target).closest('#page_question_form').length) && ($(event.target).closest('#page_question_form_modal').length)) {
            toggle_question_form($("#page_question_form .title"));//close question_form if click out
        }
        /*if((!$(event.target).closest('.menu_dropdown').length) && (!$(event.target).closest('.tablet_company').length)) {
            $(".menu_dropdown:visible").stop(true).delay(150).fadeOut(100);
        } */
        if((!$(event.target).closest('.tablet_menu.show').length) && (!$(event.target).closest('.burger').length)) {
            $(".tablet_menu").removeClass("show");
        }//close talbet menu if click out 
        if((!$(event.target).closest('.menu_dropdown.simple').length) && (!$(event.target).closest('.item.tablet_company.points').length)) {
            $(".menu_dropdown.simple").removeAttr("style");
        }
    });

    $(".menu_dropdown.languages .group .item.see_more, .tablet_menu .tablet_dropdown_contents.languages .group .item.see_more").click(function(){
        var this_lang_rel = $(this).attr("lang_rel");
        if($(this).text() == lg["see_less"]){
            $(this).text(lg["see_more"]);
        }else{
            $(this).text(lg["see_less"]);
        }
        if($(this).parent().parent().parent().parent().hasClass("menu_dropdown")){
            $(".menu_dropdown.languages .group .lang_group_dropdown[lang_rel="+this_lang_rel+"] .item.more").toggleClass("block", 'slow', "easeOutSine");
        }else{
            $(".tablet_dropdown_contents.languages .group[lang_rel="+this_lang_rel+"] .item.more").toggleClass("block", 'slow', "easeOutSine");
        }
    });

    $("#toggle_details").click(function() {
        $(".page_one").hide();
        $(".page_two").show();
    });

    $("#go_back").click(function() {
        $(".page_one").show();
        $(".page_two").hide();
    });

   

    $("#date").change(function() {
       $("#date").parent().find(".text").html($(this).val());
    });
    
     $(".date_picker").change(function() {
       $(this).parent().find(".text").html($(this).val());
    });

    var menu_size = $("#header .menu").children().length;


    $(".quote_block .more").unbind('click');
    $(".quote_block .more").on("click", function() {
        var number = $('.quote_block .language_dropdown_group').length;
        if(number > 4){
            console.log("nebūs");
        }else{
            var id = guid();
            var last_rel = $(".quote_block .language_dropdown_group").last().attr("rel");
            last_rel++;

            var closest = $(".quote_block .language_dropdown_group[rel=" + (last_rel-1) + "]").html();
            $(this).before("<div class=\"language_dropdown_group\" id=\"" + id + "\" rel=\"" + last_rel + "\">" + closest + "</div>");
            $(".quote_block .language_dropdown_group#" + id + " .language_file_item").remove();
            $(".quote_block .language_dropdown_group[rel=" + last_rel + "] .language_from .text").text(lg["source_language"]);
            $(".quote_block .language_dropdown_group[rel=" + last_rel + "] .language_from input").attr("value", "");
            $(".quote_block .language_dropdown_group[rel=" + last_rel + "] .language_to_select").text(lg["source_languages"]);
            $(".quote_block .language_dropdown_group#" + id + "[rel=" + last_rel + "] .file_sector .file_upload_call").attr("rel", last_rel);
            //$(".file_upload_call:last-child").after("<label class=\"bloated simple primary button file_upload_call\" rel=\"" + last_rel + "\">" + lg.upload + "</label>");

            var input = Math.floor($(".quote_block .segment:first input").length / 2);

            $("#" + id).find("input:first").attr("name", "langauge_from"/*_" + input*/);
            $("#" + id).find("input:last").attr("name", "langauge_to"/*_" + input*/);
            number = number + 1;
            if(number > 4){
                $(".quote_block .more").hide();
                $(".more_files_warning").addClass("show");
            }else{
                if($(".more_files_warning").hasClass("show")){
                    $(".more_files_warning").removeClass("show");
                }
            }
        }
    });


    

    $('input[name="date"]').change(function(){
        form_data.date = $(this).val(); 
    });

    $(document).on("click", ".selected_lang", function(){
        this_value = $(this).attr("value");
        //console.log(this_value);
        $('#language_select_modal .contents .columns .select_item .multi_select_languages').each(function () {
            if($(this).val() == this_value){
                for(i = 0; i < form_data.to_langs[curr_rel].length; i++){
                    if(form_data.to_langs[curr_rel][i]==this_value){
                        form_data.to_langs[curr_rel].splice (i, 1);
                        $(this).next("span").removeClass("active");
                        $(this).prop('checked', false);
                        break;
                    }
                }
            }
        });
        $(this).remove();
        if($('.selected_languages').find('.selected_lang').length > 0){
            var last = $(".selected_languages .selected_lang").last();
            var last_text = last.text();
            if (last.text().substring(last_text.length-1) == ",")
            {
                $(".selected_languages .selected_lang").last().text(last_text.substring(0, last_text.length-1));
            }
        }
        changeSelectLang(curr_rel, form_data.to_langs, lg, 'quote_block');
        $(".multi_select_languages[value='"+this_value+"']").trigger('click').trigger('click');
    });




    $("body").on("change", "#file_upload", function() {
        var filename = $(this).val().split('\\').pop();

        $(".file_upload_value").val(filename);
    });

});

function equalheight(container){
    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        $el,
        topPosition = 0;
    $(container).each(function() {

        $el = $(this);
        $($el).height('auto')
        topPostion = $el.position().top;

        if (currentRowStart != topPostion) {
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
              rowDivs[currentDiv].height(currentTallest);
            }
            rowDivs.length = 0; // empty the array
            currentRowStart = topPostion;
            currentTallest = $el.height();
            rowDivs.push($el);
        } else {
            rowDivs.push($el);
            currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
        }
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
        }
    });
}

function dragenter(e, id){
    e.preventDefault();
    e.stopPropagation();
    if($("#" + id + " #file_upload_modal_center").is(":visible")){
        $form.addClass('is_dragover');
    }
}

function dragover(e, id){
    e.preventDefault();
    e.stopPropagation();
}

function drop(e, id){
    e.preventDefault();
    e.stopPropagation();
    var droppedFiles = false;
    if($("#" + id + " #file_upload_modal_center").is(":visible")){
        $("#" + id + " .box.file_upload").removeClass('is_dragover');
        $(".one_file_error").hide();
        droppedFiles = e.dataTransfer.files;
        if (isAdvancedUpload && droppedFiles) {
            //$(".box__input").hide();
            $("#" + id + " .box.file_upload").addClass('is_success').removeClass('is_error');
            e.preventDefault();

            if(id == "vacancies_modal"){
                checkFiles(droppedFiles, curr_rel, "apply_vacancy", form_cv_data);
            }else{
                checkFiles(droppedFiles, curr_rel, "quote_block", form_data);
            }
        }
    }
}


function updateCvFileList(){
    curr_rel = 0;
    $(".segment.upload .language_file_item").remove();
    if(!(curr_rel in form_cv_data.file_names)){
        $(".segment.upload #vacancy_cv").after("<div class=\"language_file_item\" rel=\"0\" rel_1=\"-1\"></div>");
    }else{
        if(typeof form_cv_data.file_names[0][0] !== "undefined" && form_cv_data.file_sizes[0][0] != "NaN"){
            $(".segment.upload #vacancy_cv").after("<div class=\"language_file_item\" rel=\"0\" rel_1=\"0\"><span class=\"close\">✖</span>" + form_cv_data.file_names[0][0] + " " + ((form_cv_data.file_sizes[0][0])/1024/1024).toFixed(2)  + " MB</div>");
        }
    }
    return;
}

function make_droppable(id){
    if (isAdvancedUpload && !is_safari){
        var my_modal = document.getElementById(id);
        my_modal.addEventListener("dragenter", function(){
            dragenter(event, id);
        }, false);
        my_modal.addEventListener("dragover", function(){
            dragover(event, id);
        }, false);
        my_modal.addEventListener("drop", function(){
            drop(event, id);
        }, false);
    }
}

function language_select(thiss, id, form_data, form_id){//open language select modal
    if(id == "vacancies_modal"){
        $("#language_select_modal .contents .columns ul li.other").removeClass("hide");
    }else{
        if(!($("#language_select_modal .contents .columns ul li.other").hasClass("hide"))){
            $("#language_select_modal .contents .columns ul li.other").addClass("hide");
        }
    }
    $("#file_upload_modal").css("display", "table");
    $("#file_upload_modal_center").hide();
    $("#language_select_modal").show();
    $("#language_select_modal .multi_select_languages").removeAttr('checked');
    $(".select_item span.active").removeClass("active");
    curr_rel = thiss.parent().parent().parent().attr("rel");
    var this_value = 0;
    if($(".selected_languages").hasClass("show")){
        $(".selected_languages").removeClass("show");
    }
    if(id == "file_upload_modal"){
        $("#language_select_modal .columns .select_item input.multi_select_languages").each(function(){
            $(this).attr("onclick","multi_select_langs($(this), 'file_upload_modal', '"+form_id+"', form_data)");
        });
        if(thiss.hasClass("language_from")){
            from_to = "from";
            $("#language_select_modal > .title").text(lg.select_source.toUpperCase());
            if(curr_rel in form_data.from_langs){
                $('#language_select_modal .contents .columns .select_item .multi_select_languages').each(function () {
                    //console.log(form_data.from_langs[curr_rel]);
                    $(this).next("span").removeClass("active");
                    this_value = $(this).val();
                    if((form_data.from_langs[curr_rel]) == this_value){
                        $(this).prop('checked', true);
                        if(!($(this).next("span").hasClass("active"))){
                            $(this).next("span").addClass("active");
                        }
                    }
                });
            }
        }else{
            from_to = "to";
            $(".selected_languages").addClass("show");
            $(".selected_languages").html("");
            $("#language_select_modal > .title").text(lg.select_target.toUpperCase());
            /*$('#language_select_modal .contents .columns .select_item .multi_select_languages').each(function () {
                //console.log(form_data.from_langs[curr_rel]);
                this_value = $(this).val();
                $(this).prop("disabled", false);
            });*/
            if(curr_rel in form_data.to_langs){
                if(form_data.to_langs[curr_rel] !== null){
                    $('#language_select_modal .contents .columns .select_item .multi_select_languages').each(function () {
                        //console.log(form_data.from_langs[curr_rel]);
                        $(this).next("span").removeClass("active");
                        this_value = $(this).val();
                        for(i = 0; i < form_data.to_langs[curr_rel].length; i++){
                            if((form_data.to_langs[curr_rel][i]) == this_value){
                                $(this).prop('checked', true);
                                if(!($(this).next("span").hasClass("active"))){
                                    $(this).next("span").addClass("active");
                                }
                                $(".selected_languages").append("<div class=\"selected_lang\" value='"+this_value+"'>x "+$(this).next("span").text()+"</div>");
                            }
                        }
                    });
                }
            }
        }
    }else if(id == "vacancies_modal"){
        $("#language_select_modal .columns .select_item input.multi_select_languages").each(function(){
            $(this).attr("onclick","multi_select_langs($(this), 'vacancies_modal', 'apply_vacancy', form_cv_data)");
        });
        if(thiss.hasClass("language_from")){
            from_to = "from";
            $("#language_select_modal > .title").text(lg.select_source.toUpperCase());
            if(curr_rel in form_cv_data.from_langs){
                if(from_other == true){
                    $("#other_language").val(form_cv_data.from_langs[curr_rel]);
                    $(".multi_select_languages.other").prop('checked', true);
                }else{
                    $("#other_language").val("");
                }
                $('#language_select_modal .contents .columns .select_item .multi_select_languages').each(function () {
                    //console.log(form_cv_data.from_langs[curr_rel]);
                    $(this).next("span").removeClass("active");
                    this_value = $(this).val();
                    if((form_cv_data.from_langs[curr_rel]) == this_value){
                        $(this).prop('checked', true);
                        if(!($(this).next("span").hasClass("active"))){
                            $(this).next("span").addClass("active");
                        }
                    }
                });
            }
        }else{
            from_to = "to";
            if(to_other == true){
                $("#other_language").val(form_cv_data.to_langs[curr_rel]);
                $(".multi_select_languages.other").prop('checked', true);
            }else{
                $("#other_language").val("");
            }
            $("#language_select_modal > .title").text(lg.one_target_lang.toUpperCase());
            /*$('#language_select_modal .contents .columns .select_item .multi_select_languages').each(function () {
                //console.log(form_cv_data.from_langs[curr_rel]);
                this_value = $(this).val();
                $(this).prop("disabled", false);
            });*/
            if(curr_rel in form_cv_data.to_langs){
                $('#language_select_modal .contents .columns .select_item .multi_select_languages').each(function () {
                    //console.log(form_cv_data.from_langs[curr_rel]);
                    $(this).next("span").removeClass("active");
                    this_value = $(this).val();
                    if((form_cv_data.to_langs[curr_rel]) == this_value){
                        $(this).prop('checked', true);
                        if(!($(this).next("span").hasClass("active"))){
                            $(this).next("span").addClass("active");
                        }
                    }
                });
            }
        }
    }
}

function resetInputNoRel(elem, variable, form_data){
    if(variable != "currency"){
        form_data[variable] = {};
        form_data[variable] = elem.textContent;
    }
    $parent = $(elem).closest(".dropdown");

    var val = elem.textContent;
    //console.log(val);

    $parent.find("input").val(val);
    $parent.find(".text").html(val);
}

/*function resetInput(elem){
    curr_rel = $(elem).parent().parent().parent().parent().parent().attr("rel");
    form_data.from_langs[curr_rel] = $(elem).attr("val");
    if(!(curr_rel in form_data.to_langs)){
        form_data.to_langs[curr_rel] = [];
    }else{
        array_index = jQuery.inArray(($(elem).attr("val")), form_data.to_langs[curr_rel]);
        console.log(array_index);
        if(array_index > -1){
            form_data.to_langs[curr_rel].splice(array_index, 1);
            changeSelectLang(curr_rel, form_data.to_langs, lg);
        }
    }
    console.log(form_data);
}*/

function changeSelectLang(curr_rel, to_langs, lg, form_id){//update name of selected language
	if(curr_rel in to_langs){
		if(to_langs[curr_rel].length == 0){
			$("#"+form_id+" .language_dropdown_group[rel=" + curr_rel + "] .language_to_select").text(lg["source_languages"]);
			return;
		}
		if(to_langs[curr_rel].length > 1){
			$("#"+form_id+" .language_dropdown_group[rel=" + curr_rel + "] .language_to_select").text(to_langs[curr_rel].length + " " + lg["languages"]);
			return;
		}
		if(to_langs[curr_rel].length == 1){
			$("#"+form_id+" .language_dropdown_group[rel=" + curr_rel + "] .language_to_select").text("1 " + lg["language"]);
			return;
		}
    	}else{
		$("#"+form_id+" .language_dropdown_group[rel=" + curr_rel + "] .language_to_select").text(lg["source_languages"]);
		return;
    	}
}

function guid() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
    s4() + '-' + s4() + s4() + s4();
}

function updateHeader() {
    /*$('.landing.page #header_block').height(function(index, height) {
        console.log(window.innerHeight);
        return window.innerHeight - 272 - $(this).offset().top;
    }); */
    var header_h = $("#header").height();
    var doc_h = window.innerHeight;
    var doc_w = window.innerWidth;
    var padding_bot = 0;
    if(doc_h > 500){
        var cont_h = $(".landing.page #header_block").height();
        var to_split = (doc_h - header_h - cont_h - 86 - 186)/2;
        if(to_split < 140){
            if(doc_w > 400){
                padding_bot = -30;
            }else{
                padding_bot = -114;
            }
        }else{
            padding_bot = to_split;
        }
        $('.landing.page #header_block').css("padding-bottom", padding_bot+200).css("padding-top", to_split+94);
    }

}

function closeRow(thiss, form_data) {//delete language pair row and delete files associated with it
    var this_rel = $(thiss).closest(".language_dropdown_group").attr("rel");
    $(thiss).closest(".language_dropdown_group").remove();
    //$(".file_upload_call[rel='" + this_rel + "']").remove();
    form_data.from_langs[this_rel] = [];
    form_data.to_langs[this_rel] = [];
    form_data.file_names[this_rel] = [];
    if(curr_rel in form_data.faili){
        for(i = 0; i < form_data.faili[curr_rel].length; i++){
            var file = form_data.faili[curr_rel][i];
            deleteUploaded(0, file);
            complete_size -= parseInt(form_data.file_sizes[curr_rel][i]);
        }
    }
    form_data.faili[this_rel] = [];
    $(".quote_block .more").show();
    if($('.quote_block .language_dropdown_group').length < 5){
        if($(".more_files_warning").hasClass("show")){
            $(".more_files_warning").removeClass("show");
        }
    }                
}

function uploadFile(formD, form_id, form_data){//upload files to tmp dir
    extension_list = js_extensions.split(",");
    var path_to_php = "";
    if(form_id == "apply_vacancy"){
        path_to_php = "cv_requests";
    }else if(form_id == "quote_block"){
        path_to_php = "requests";
    }
    /*if(file.size > 31457280) {
        alert(lg["bad_file_size"]);
        filePath = "error";
        return filePath;
    } else if(!(extension_list.includes(file.type))) {
        alert(lg["acceptable_formats"] + " " + accepted_formats);
        filePath = "error";
    } else { */
        $.ajax({
            url: '/res/'+path_to_php+'.php',
            type: 'POST',
            data: formD,
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            xhr: function() {
                //var xhr = new window.XMLHttpRequest();
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.onprogress = function(e) {
                    if($("#inbox_svg").is(":visible")){
                        $("#inbox_svg").hide();
                    }
                    if(!($("#file_upload_modal .box__input .loading").hasClass("show"))){
                        $("#file_upload_modal .box__input .loading").addClass("show");
                    }
                };
                return xhr;
            },
            complete: function(){
                if(!($("#inbox_svg").is(":visible"))){
                    $("#inbox_svg").show();
                }
                if(($("#file_upload_modal .box__input .loading").hasClass("show"))){
                    $("#file_upload_modal .box__input .loading").removeClass("show")
                }
                enableBtn();
            },
            success: function(data) {
                //data = JSON.stringify(data);
                //data = data.replace(/['"]+/g, '');
                //console.log(data);
                console.log(data)
                if(data == "big"){
                    alert(lg["bad_file_size"]);
                }else if(data == "captcha"){
                    alert(lg["captcha"]);
                }else{
                    var new_id = guid();
                    for(i = 0; i < data.length; i++){
                        $(".file_label_content").append("<p id='" + new_id + "'>" + lg["file"] + " " + data[i]["name"] + " " + lg["successful_upload"] + "</p>");
                        setTimeout(function() {
                            $(".file_label_content #" + new_id + "").fadeOut(1000);
                        }, 1000);
                        if(data[i]["path"] == "format"){
                            alert(lg["acceptable_formats"] + " " + accepted_formats + " " + data[i]["name"])
                        }else if(data[i]["path"] == "format"){
                            alert(lg["bad_file_size"] + " " + data[i]["name"]);
                        }else{
                            form_data.faili[curr_rel].push(data[i]["path"]);  
                            form_data.file_names[curr_rel].push(data[i]["name"]);
                            form_data.file_sizes[curr_rel].push(data[i]["size"]);
                        }
                    }
                    if(form_id == "quote_block"){
                        updateDropdownFileList(curr_rel, "quote_block", form_data);
                        getModalFileList(curr_rel, "quote", form_data);
                    }else if(form_id == "apply_vacancy"){
                        updateCvFileList();
                        getModalFileList(curr_rel, "vacancy", form_cv_data);
                    }
                }
            },
            error: function(data) {
                alert(lg.error+"!");
                console.log(data);
                //alert(JSON.stringify(data));
            }
        });
        grecaptcha.reset();
    //}
}

function removeFileLine(thiss, mode, form_data, form_id){//remove file html line
    curr_rel = $(thiss).parent().attr("rel");
    var this_rel = $(thiss).parent().attr("rel");
    var sub_rel = $(thiss).parent().attr("rel_1");
    $(".modal_file_item[rel='" + this_rel + "'][rel_1='" + sub_rel + "']").remove();
    $(".language_file_item[rel='" + this_rel + "'][rel_1='" + sub_rel + "']").remove();
    var to_delete = form_data.faili[this_rel][sub_rel];
    if(deleteUploaded(0, to_delete)){
        form_data.file_names[this_rel].splice(sub_rel, 1);
        form_data.faili[this_rel].splice(sub_rel, 1);
        complete_size -= parseInt(form_data.file_sizes[this_rel][sub_rel]);
        form_data.file_sizes[this_rel].splice(sub_rel, 1);
        getModalFileList(curr_rel, mode, form_data);
        if(mode == "quote"){
            updateDropdownFileList(curr_rel, form_id, form_data);
        }else if(mode == "vacancy"){
            updateCvFileList();
        }
    }
}

function updateDropdownFileList(curr_rel, form_id, form_data){// update file list under language pair
    $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .language_file_item").remove();
    var curr_mode = $("#modal_file_input").attr("mode");
    if(!(curr_rel in form_data.file_names)){
        $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .dropdowns >.close").after("<div class=\"language_file_item\" rel=\"" + curr_rel + "\" rel_1=\"-1\"></div>");
    }else{
    	var were_some = false;
        for(i = 0; i < form_data.file_names[curr_rel].length; i++){
        	$("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .dropdowns >.close").after("<div class=\"language_file_item\" rel=\"" + curr_rel + "\" rel_1=\"" + i + "\"><span class=\"close\" onClick=\"removeFileLine($(this), '"+curr_mode+"', form_data, '"+form_id+"')\">✖</span>" + form_data.file_names[curr_rel][i] + " " + ((form_data.file_sizes[curr_rel][i])/1024/1024).toFixed(2)  + " MB</div>");
        	were_some = true;
        }
        if(were_some){
		$("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .error.file_sec").remove();
		$("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .file_sector label").removeClass("redborder");
        }
    }
    return;
}

/*function deleteFile(){// delete file when click on x next to file
    curr_rel = $(this).parent().attr("rel");
    var this_rel = $(this).parent().attr("rel");
    var sub_rel = $(this).parent().attr("rel_1");
    $(".modal_file_item[rel='" + this_rel + "'][rel_1='" + sub_rel + "']").remove();
    $(".language_file_item[rel='" + this_rel + "'][rel_1='" + sub_rel + "']").remove();
    var to_delete = form_data.faili[this_rel][sub_rel];
    if(deleteUploaded(0, to_delete)){
        form_data.file_names[this_rel].splice(sub_rel, 1);
        form_data.faili[this_rel].splice(sub_rel, 1);
        complete_size -= parseInt(form_data.file_sizes[this_rel][sub_rel]);
        form_data.file_sizes[this_rel].splice(sub_rel, 1);
        getModalFileList(curr_rel, form_data);
        updateDropdownFileList(curr_rel, "quote_block", form_data);
    }
}*/

function deleteUploaded(key, file){ //deletes uploaded file from tmp folder
    var formData = new FormData();
    formData.append(key, file);
    formData.append("action", "tmp_file_remove");

    $.ajax({
        url: '/res/requests.php',  //server script to process data
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        success: function(data) {                
        },
        error: function(data) {   
        }
    });
    return true;
}

function callFileUploadModal(thiss, id, mode) {//open file upload modal
    curr_rel = $(thiss).attr("rel");
    if(isAdvancedUpload && !is_safari){
        $(".file_label_content").html("<strong>" + lg["choose_file"] + "</strong><span class=\"box__dragndrop\"> " + lg["or_drag"] + "</span>.");
    }else{
        $(".file_label_content").html("<strong>" + lg["choose_file"] + "</strong>.");
    }
    if(id == 'file_upload_modal'){
        $("#modal_file_input").attr("mode", mode).attr("multiple","");
        $("#file_upload_modal_center .contents .subtitle").removeClass("hide");
        $("#file_upload_modal_center > .title").text(lg["quote_two"].toUpperCase());
        $("#file_upload_modal_center .size_warning").text(lg["file_size_limit"]);
    }else if(id == 'vacancies_modal'){
        $("#modal_file_input").attr("mode", mode);
        $("#modal_file_input").removeAttr("multiple");
        $("#file_upload_modal_center .contents .subtitle").addClass("hide");
        $("#file_upload_modal_center > .title").text(lg["upload_cv"].toUpperCase());
        $("#file_upload_modal_center .size_warning").text(lg["cv_file_size_limit"]);
    }
    $("#file_upload_modal").css("display", "table");
    $("#language_select_modal").hide();
    $("#file_upload_modal_center").show();
    $(".box__input").show();
    $(".box__error").hide();
    $(".box__uploading").hide();
    $(".box__success").hide();
    make_droppable("file_upload_modal");
    if(id == 'file_upload_modal'){
        getModalFileList(curr_rel, "quote", form_data);
    }else{
        getModalFileList(curr_rel, "vacancy", form_cv_data);
    }
}

function checkFiles(filesList, curr_rel, form_id, form_data){//prepare files for upload
    //$("#inbox_svg").hide();
    //$("#file_upload_modal .box__input .loading").addClass("show");
    var allow = 1;
    var last_size = 0;
    var curr_size = 0;
    if(!(curr_rel in form_data.faili)){
        form_data.faili[curr_rel] = [];
    }
    if(filesList.length > 5 || form_data.faili[curr_rel].length >= 5){
        allow = 0;
        alert(lg["row_file_limit"]);
    }else{
        for(i = 0; i < filesList.length; i++){
            complete_size += filesList[i].size;
            curr_size += filesList[i].size;
            last_size = filesList[i].size;
        }
    }
    /*if(!(extension_list.includes(file.type))) {
        alert(lg["acceptable_formats"] + " " + accepted_formats);
        filePath = "error";
    }*/
    var path;
    if(allow == 1){
        if(complete_size > 31457280){
            complete_size -= curr_size;
            alert(lg["bad_file_size"]);
        }else{     
            if(!(curr_rel in form_data.file_names)){
                form_data.file_names[curr_rel] = [];
            }
            if(!(curr_rel in form_data.file_sizes)){
                form_data.file_sizes[curr_rel] = [];
            }
            //$(".file_label_content").html("");
            var formData = new FormData();
            captcha = grecaptcha.getResponse();
            files = [];
            for(i = 0; i < filesList.length; i++){
                formData.append("file"+i, filesList[i]);
            }
            formData.append("action", "upload"); 
            formData.append("captcha", captcha);
            uploadFile(formData, form_id, form_data);
        }
    }else{
    }
    $("#modal_file_input").val("");
    //$("#inbox_svg").show();
    //$("#file_upload_modal .box__input .loading").removeClass("show");
}

function getModalFileList(curr_rel, curr_mode, form_data){//show files list in modal window
    console.log(form_data);
    $("#modal_files_list").html("");
    var data_name = "";
    if(curr_mode == "quote"){
        data_name = "form_data";
    }else if(curr_mode == "vacancy"){
        data_name = "form_cv_data";
    }
    if(curr_rel in form_data.file_names){
        for(i = 0; i < form_data.file_names[curr_rel].length; i++){
            $("#modal_files_list").append("<div class=\"modal_file_item\" rel=\"" + curr_rel + "\" rel_1=\"" + i + "\"><span class=\"close\" onClick=\"removeFileLine($(this), '"+curr_mode+"', "+data_name+", 'apply_vacancy')\">✖</span>" + form_data.file_names[curr_rel][i] + " " + ((form_data.file_sizes[curr_rel][i])/1024/1024).toFixed(2)  + " MB</div>");
        }
    }
    return;
}



function enableBtn(){
    $("form.box__input > svg").toggle();
    $(".file_label").toggle();
    $(".captcha_warning").toggle();
}

function optimizeSponsors(){
    if($(window).width() > 1024){
        if($(".sponsors .item").length <= 5){
            $("#more_sponsors").hide();
        }else{
            $("#more_sponsors").show();
        }
    }else if($(window).width() > 768){
        if($(".sponsors .item").length <= 3){
            $("#more_sponsors").hide();
        }else{
            $("#more_sponsors").show();
        }
    }else if($(window).width() > 550){
        if($(".sponsors .item").length <= 2){
            $("#more_sponsors").hide();
        }else{
            $("#more_sponsors").show();
        }
    }else if($(window).width() < 550){
        if($(".sponsors .item").length <= 2){
            $("#more_sponsors").hide();
        }else{
            $("#more_sponsors").show();
        }
    }
}

function multi_select_langs(thiss, id, form_id, form_data){//function to control how checked languages get aded to from data
    if($(thiss).is(':checked')){
        if(from_to == "to"){
            if(id == "file_upload_modal"){
                if(!($(thiss).next("span").hasClass("active"))){
                    $(thiss).next("span").addClass("active");
                }
                if(!(curr_rel in form_data.to_langs)){
                    form_data.to_langs[curr_rel] = [];
                    form_data.to_langs[curr_rel][0] = $(thiss).val();
                    changeSelectLang(curr_rel, form_data.to_langs, lg, form_id);
                }else{
                    var was_there = 0;
                    if(form_data.to_langs[curr_rel] !== null){
                        for(i = 0; i < form_data.to_langs[curr_rel].length; i++){
                            if((form_data.to_langs[curr_rel][i]) == $(thiss).val){
                                was_there = 1;
                                break;
                            }
                        }
                    }
                    if(was_there == 0){
                        form_data.to_langs[curr_rel].push($(thiss).val());
                        changeSelectLang(curr_rel, form_data.to_langs, lg, form_id);
                    }
                }
                if($('.selected_languages').find('.selected_lang').length !== 0){
                    $(".selected_languages .selected_lang").last().append(",");
                }
                $(".selected_languages").append("<div class=\"selected_lang\" value='"+$(thiss).val()+"'>x "+$(thiss).next("span").text()+"</div>");
            }else if(id == "vacancies_modal"){
                to_other = false;
                $("#language_select_modal .contents .columns span").removeClass("active");
                $(thiss).next("span").addClass("active");
                $("#language_select_modal .multi_select_languages").removeAttr('checked');
                if($(thiss).val() != "other"){
                    to_other = false;
                    form_data.to_langs[curr_rel] = $(thiss).val();
                    $('#language_select_modal .contents .columns .select_item .multi_select_languages').each(function () {
                        //console.log(form_data.from_langs[curr_rel]);
                        this_value = $(this).val();
                        if((form_data.to_langs[curr_rel]) == this_value){
                            $(this).prop('checked', true);
                            $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_to .text").text($(this).next("span").text());
                        }
                    });
                }else{
                    to_other = true;
                    var other_val = "";
                    other_val = $("#other_language").val();
                    (thiss).prop('checked', true);
                    if(other_val == ""){
                        $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_to .text").text(lg["target_language"]);
                    }else{
                        form_data.to_langs[curr_rel] = other_val;
                        $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_to .text").text(other_val);
                    }
                }
            }
        }else if(from_to == "from"){
            from_other = false;
            $("#language_select_modal .contents .columns span").removeClass("active");
            $(thiss).next("span").addClass("active");
            $("#language_select_modal .multi_select_languages").removeAttr('checked');
            if($(thiss).val() != "other"){
                form_data.from_langs[curr_rel] = $(thiss).val();
                $('#language_select_modal .contents .columns .select_item .multi_select_languages').each(function () {
                    //console.log(form_data.from_langs[curr_rel]);
                    this_value = $(this).val();
                    if((form_data.from_langs[curr_rel]) == this_value){
                        $(this).prop('checked', true);
                        $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_from .text").text($(this).next("span").text());
                    }
                });
            }else{
                from_other = true;
                var other_val = "";
                other_val = $("#other_language").val();
                (thiss).prop('checked', true);
                if(other_val == ""){
                    $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_from .text").text(lg["source_language"]);
                }else{
                    form_data.to_langs[curr_rel] = other_val;
                    $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_from .text").text(other_val);
                }
            }
        }
    }else{
        if($(thiss).next("span").hasClass("active")){
            $(thiss).next("span").removeClass("active");
        }
        if(from_to == "to"){
            to_other = false;
            if(id == "file_upload_modal"){
                if((curr_rel in form_data.to_langs) && (form_data.to_langs[curr_rel].length > 0)){
                    for(i = 0; i < form_data.to_langs[curr_rel].length; i++){
                        if((form_data.to_langs[curr_rel][i]) == $(thiss).val()){
                            $(".selected_lang[value=\""+form_data.to_langs[curr_rel][i]+"\"]").remove();
                            if($('.selected_languages').find('.selected_lang').length > 0){
                                var last = $(".selected_languages .selected_lang").last();
                                var last_text = last.text();
                                if (last.text().substring(last_text.length-1) == ",")
                                {
                                    $(".selected_languages .selected_lang").last().text(last_text.substring(0, last_text.length-1));
                                }
                            }
                            form_data.to_langs[curr_rel].splice (i, 1);
                           /* if(form_data.to_langs[curr_rel].length == 0){
                            	form_data.to_langs.splice (curr_rel, 1);
                            }*/
                            //console.log(form_data);
                            //form_data.to_langs[curr_rel][i] = "";
                            changeSelectLang(curr_rel, form_data.to_langs, lg, form_id);
                            break;
                        }
                    }
                }
            }else if(id == "vacancies_modal"){
                if(curr_rel in form_data.to_langs){
                    if(form_data.to_langs[curr_rel] != null){
                        if(form_data.to_langs[curr_rel].length > 0){
                            form_data.to_langs[curr_rel] = null;
                        }
                    }
                    $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_to .text").text(lg["target_language"]);
                }else{
                    form_data.to_langs[curr_rel] = null;
                    $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_to .text").text(lg["target_language"]);
                }
            }
        }else if(from_to == "from"){
            from_other = false;
            if(curr_rel in form_data.from_langs){
                if(form_data.from_langs[curr_rel].length > 0){
                    form_data.from_langs[curr_rel] = null;
                    $("#"+form_id+" .language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_from .text").text(lg["source_language"]);
                }
            }
        }
    }
}
