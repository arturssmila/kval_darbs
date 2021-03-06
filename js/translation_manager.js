$(window).resize(function() { optimize_elements();
    equalheight('#manager .row_table .visible_row .cell');
});
$(document).ready(function(){

    $(".row.show_more").click(function(){
        var clicked_rel = $(this).attr("rel");
        $(".hidden_row").each(function(){
            if($(this).is(':visible') && $(this).attr("rel") != clicked_rel){
                $(this).slideToggle(250);
            }
        });
        $(".row.show_more .more").each(function(){
            if($(this).parent().attr("rel") != clicked_rel){
                if(!($(this).hasClass("show"))){
                    $(this).addClass("show");
                }
            }
        });
        $(".row.show_more .less").each(function(){
            if($(this).parent().attr("rel") != clicked_rel){
                $(this).removeClass("show");
            }
        });
        $(this).find(".more").toggleClass("show");
        $(this).find(".less").toggleClass("show");
        $(".hidden_row[rel='"+clicked_rel+"']").slideToggle(250, function() {
            if ($(this).is(':visible')){
                $(this).css('display','inline-block');
            }
        });
    });



	$("#submit_work_button").click(function(){
		var validated = 1;
		$("#submit_work .redborder").removeClass("redborder");
		$("#submit_work .segment .error").remove();
		/*$("#submit_work .segment input.required").removeClass("redborder");
		$("#submit_work .segment textarea.required").removeClass("redborder");
		$(".dropdown .select.language_to, .dropdown .select.language_from").removeClass("redborder");
		$("#submit_work").removeClass("redborder");*/
		if($("#submit_work .segment textarea").val() != ""){
			form_data.comment = $(".quote_block .segment textarea").val();
		}
		if((form_data.date == "") || (typeof form_data.date == "undefined")){
			$(".dropdown.date .select").before("<span class=\"error\">" + lg["field_required"] + "</span>");
			$(".dropdown.date .select").addClass("redborder");
			validated = 0;
		}
		if((form_data.time == "") || (typeof form_data.time == "undefined")){
			$(".dropdown.small:not(.date) .select").before("<span class=\"error\">" + lg["field_required"] + "</span>");
			$(".dropdown.small:not(.date) .select").addClass("redborder");
			validated = 0;
		}
		$("#submit_work .segment.langs .language_dropdown_group").each(function(){
			var this_rel = $(this).attr("rel");
			if(!(this_rel in form_data.from_langs)){
				$(this).find(".select.language_from").addClass("redborder");
				$(this).find(".select.language_from").before("<span class=\"error\">" + lg["field_required"] + "</span>");
				validated = 0;
			}else if(form_data.from_langs[this_rel] == null || form_data.from_langs[this_rel] == ""){
				$(this).find(".select.language_from").addClass("redborder");
				$(this).find(".select.language_from").before("<span class=\"error\">" + lg["field_required"] + "</span>");
				validated = 0;
			}
			if(!(this_rel in form_data.to_langs)){
				$(this).find(".select.language_to").addClass("redborder");
				$(this).find(".select.language_to").before("<span class=\"error\">" + lg["field_required"] + "</span>");
				validated = 0;
			}else if(form_data.to_langs[this_rel] == null || form_data.to_langs[this_rel] == ""){
				$(this).find(".select.language_to").addClass("redborder");
				$(this).find(".select.language_to").before("<span class=\"error\">" + lg["field_required"] + "</span>");
				validated = 0;
			}
			if(form_data.faili[this_rel] == null || form_data.faili[this_rel] == ""){
				$(this).find(".file_sector label").addClass("redborder");
				$(this).find(".file_sector").before("<span class=\"error file_sec\">" + lg["field_required"] + "</span>");
				validated = 0;
			}else if(form_data.faili[this_rel].length == 0){
				$(this).find(".file_sector label").addClass("redborder");
				$(this).find(".file_sector").before("<span class=\"error file_sec\">" + lg["field_required"] + "</span>");
				validated = 0;
			}
		});
		if(validated == 1){
			$.ajax({
				url: '/res/translations_manager.php',  //server script to process data
				type: 'POST',
				data: {form_data: JSON.stringify(form_data), action: "create_request"},
				async: true,
				success: function(data) {
					console.log(data);
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
						form_data.time_zone = $(".quote_block input[name=\"time_zone\"]").val();
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
						updateDropdownFileList(0, "submit_work", form_data);
						$(".more_files_warning.show").removeClass("show");
						$(".quote_block .more").removeAttr("style");
					}
				},
				error: function(data) {
					alert(lg.error);  
					console.log(data);
				}
			});
		}else{
			console.log(lg.error);
		}
    });

    equalheight("#manager .row_table .visible_row .cell");
});

function hiddenRow(clicked, table_id, togglable_class){
	var search_string = "#"+table_id+" ."+togglable_class;
	if($(search_string+"[toggle_id='"+clicked+"']").hasClass("hide")){
		$(search_string).addClass("hide");
		$(search_string+"[toggle_id='"+clicked+"']").removeClass("hide");
	}else{
		$(search_string).addClass("hide");
	}
}

function hiddenRow_toggleSingle(clicked, table_id, togglable_class){
	if($("#"+table_id+" ."+togglable_class+"[toggle_id='"+clicked+"']").is(":hidden")){
		if($("#"+table_id+" ."+togglable_class+"[toggle_id='"+clicked+"']").hasClass("hide")){
			$("#"+table_id+" ."+togglable_class+"[toggle_id='"+clicked+"']").removeClass("hide");
		}else{
			$("#"+table_id+" ."+togglable_class+"[toggle_id='"+clicked+"']").toggle();
		}
	}else{
		$("#"+table_id+" ."+togglable_class+"[toggle_id='"+clicked+"']").toggle();
	}
}

function changeSpecialities(pair_id, table_id){
    var pair_data = {};
    var counting = 0;
    $("#"+table_id+" .to_toggle[toggle_id='"+pair_id+"'] input.speciality").each(function(){
        if($(this).is(":checked")){
            pair_data[counting] = {};
            pair_data[counting] = $(this).val();
            counting++;
        }
    });
    if(counting > 0){
        $.ajax({
            type: "POST",
            url: "/res/translations_manager.php",
            data: {
                action: "changePairSpecialities",
                data: pair_data,
                pair_id: pair_id
            },
            async: true,
            dataType: 'json',
            cache: false,
            success: function(response)
            {
                console.log(response);
                if(response == "empty"){
                    console.log("ree"); 
                }else if(response == "ok"){
                    $(".to_toggle[toggle_id='"+pair_id+"'] .button.bloated.primary").addClass("hide");
                    $(".to_toggle[toggle_id='"+pair_id+"'] .done_text").removeClass("hide").delay(1500).queue(function(next){
                        $(this).addClass("hide");
                        $(".to_toggle[toggle_id='"+pair_id+"'] .button.bloated.primary.submit").removeClass("hide");
                        location.reload();
                        next();
                    });
                }           
            },
            error: function(response)
            {
                console.log(response);
            }
        });
    }
}
function moveJobToTrash(job_id, action){
	if (confirm(lg.move_to_trash+"?")) {
		$.ajax({
			type: "POST",
			url: "/res/translations_manager.php",
			data: {
				main_id: job_id,
				action: action
			},
			async: true,
			cache: false,
			success: function(response)
			{
				//response = JSON.parse(response);
				console.log(response);
				if(response == "ok"){
					$("tr[job_id='"+job_id+"']").remove();
					$("tr.to_toggle[toggle_id='"+job_id+"_job']").remove();
				}else if(response == "error"){
					alert(lg.error);
				}else if(response == "logged_out"){
					alert(lg.session_ended_logged_out);
					location.reload();
				}else{
					alert(lg.could_not_rem+"!");
				} 
			},
			error: function(response)
			{
				console.log(response);
				alert(lg.could_not_rem+"!");
			}
		});
    	} else {
	}
}

function changeDateDue(clicked_obj, job_id, action){
	var date_due = $(clicked_obj).parent().parent().find("input#date_"+job_id).val();
	if (confirm("change due date?")) {
		$.ajax({
			type: "POST",
			url: "/res/translations_manager.php",
			data: {
				main_id: job_id,
				date_due: date_due,
				action: action
			},
			async: true,
			cache: false,
			success: function(response)
			{
				//response = JSON.parse(response);
				console.log(response);
				if(response == "ok"){
					alert(lg.date_due_changed+"!");
				}else if(response == "error"){
					alert(lg.error);
				}else if(response == "logged_out"){
					alert(lg.session_ended_logged_out);
					location.reload();
				}else{
					alert(lg.could_not_ch+"!");
				} 
			},
			error: function(response)
			{
				console.log(response);
				alert(lg.could_not_ch+"!");
			}
		});
    	} else {
	}
}

function AcceptJob(job_id, accept){
	if (confirm(accept+"?")) {
		$.ajax({
			type: "POST",
			url: "/res/translations_manager.php",
			data: {
				main_id: job_id,
				accept: accept,
				action: "acceptJob"
			},
			async: true,
			cache: false,
			success: function(response)
			{
				//response = JSON.parse(response);
				console.log(response);
				if(response == "ok"){
					alert(lg.done+"!");
					$("tr[job_id='"+job_id+"']").remove();
					$("tr.to_toggle[toggle_id='"+job_id+"_job']").remove();
				}else if(response == "error"){
					alert(lg.error);
				}else if(response == "logged_out"){
					alert(lg.session_ended_logged_out);
					location.reload();
				}else{
					alert(lg.could_not_ch_st+"!");
				} 
			},
			error: function(response)
			{
				console.log(response);
				alert(lg.could_not_ch_st+"!");
			}
		});
    	} else {
	}
}

function submitJob(job_id){
	if (confirm("submit?")) {
		$.ajax({
			type: "POST",
			url: "/res/translations_manager.php",
			data: {
				job_id: job_id,
				action: "submitJob"
			},
			async: true,
			cache: false,
			success: function(response)
			{
				//response = JSON.parse(response);
				console.log(response);
				if(response == "ok"){
					alert(lg.done+"!");
					$("tr[job_id='"+job_id+"']").remove();
					$("tr.to_toggle[toggle_id='"+job_id+"_job']").remove();
				}else if(response == "error"){
					alert(lg.error);
				}else if(response == "logged_out"){
					alert(lg.session_ended_logged_out);
					location.reload();
				}else{
					alert(lg.could_not_ch_st+"!");
				} 
			},
			error: function(response)
			{
				console.log(response);
				alert(lg.could_not_ch_st+"!");
			}
		});
    	} else {
	}
}

function moveFromTrash(job_id, action){
	if (confirm(lg.restore+"?")) {
		$.ajax({
			type: "POST",
			url: "/res/translations_manager.php",
			data: {
				main_id: job_id,
				action: action
			},
			async: true,
			cache: false,
			success: function(response)
			{
				//response = JSON.parse(response);
				console.log(response);
				if(response == "ok"){
					$("tr[job_id='"+job_id+"']").remove();
					$("tr.to_toggle[toggle_id='"+job_id+"_job']").remove();
				}else if(response == "error"){
					alert(lg.error);
				}else if(response == "logged_out"){
					alert(lg.session_ended_logged_out);
					location.reload();
				}else{
					alert(lg.could_not_rem+"!");
				} 
			},
			error: function(response)
			{
				console.log(response);
				alert(lg.could_not_rem+"!");
			}
		});
    	} else {
	}
}

function openChangeInput(clicked){
    $(clicked).parent().parent().next(".changable").removeClass("hide");
    $(clicked).parent().parent().addClass("hide");
}

function changeCellValue(clicked, main_id, field, file, action){
    $parent = $(clicked).parent().parent();
    var original_val = $parent.prev(".original").find(".cell_content").text();
    var value = $(clicked).parent().prev("input").val();
    if(value == original_val){
        $parent.prev(".original").removeClass("hide");
        $parent.addClass("hide");
    }else{
        if (value !== null){
            $.ajax({
                type: "POST",
                url: file,
                data: {
                    main_id: main_id,
                    field: field,
                    action: action,
                    value: value
                },
                async: true,
                dataType: 'json',
                cache: false,
                success: function(response)
                {
                    console.log(response);
                    if(response == "ok"){
                        $parent.prev(".original").find(".cell_content").text(value);
                        $parent.prev(".original").removeClass("hide");
                        $parent.addClass("hide");
                    }else if(response == "logged_out"){
                        alert(lg["session_ended_logged_out"]);
                        location.reload();
                    }else{
                        alert(lg.could_not_upd+"!");
                    }     
                },
                error: function(response)
                {
                    console.log(response);
                    alert(lg.could_not_upd+"!");
                }
            });
        }
    }
}

function changeUserInfo(clicked, user_data, main_id, field, file, action){
    $parent = $(clicked).parent().parent();
    var original_val = $parent.prev(".original").find(".cell_content").text();
    var value = $(clicked).parent().prev("input").val();
    if(value == original_val){
        $parent.prev(".original").removeClass("hide");
        $parent.addClass("hide");
    }else{
        if (value !== null){
            $.ajax({
                type: "POST",
                url: file,
                data: {
                    main_id: main_id,
                    field: field,
                    user_data: user_data,
                    action: action,
                    value: value
                },
                async: true,
                dataType: 'json',
                cache: false,
                success: function(response)
                {
                    console.log(response);
                    if(response == "ok"){
                        $parent.prev(".original").find(".cell_content").text(value);
                        $parent.prev(".original").removeClass("hide");
                        $parent.addClass("hide");
                    }else if(response == "logged_out"){
                        alert(lg["session_ended_logged_out"]);
                        location.reload();
                    }else{
                        alert(lg.could_not_upd+"!");
                    }     
                },
                error: function(response)
                {
                    console.log(response);
                    alert(lg.could_not_upd+"!");
                }
            });
        }
    }
}

function changeCellValue_2ids(clicked, main_id, second_id, field, file, action){
    $parent = $(clicked).parent().parent();
    var original_val = $parent.prev(".original").find(".cell_content").text();
    var value = $(clicked).parent().prev("input").val();
    if(value == original_val){
        $parent.prev(".original").removeClass("hide");
        $parent.addClass("hide");
    }else{
        if (value !== null){
            $.ajax({
                type: "POST",
                url: file,
                data: {
                    main_id: main_id,
                    second_id: second_id,
                    field: field,
                    action: action,
                    value: value
                },
                async: true,
                dataType: 'json',
                cache: false,
                success: function(response)
                {
                    console.log(response);
                    if(response == "ok"){
                        $parent.prev(".original").find(".cell_content").text(value);
                        $parent.prev(".original").removeClass("hide");
                        $parent.addClass("hide");
                        if(action == "changeFileWordCount"){
                        	$("tr[file_id='"+main_id+"'] td.price").text("-");
                        	var job_id = $(".select.speciality[data_id='"+main_id+"']").attr("job_id");
                        	$("tr[job_id='"+job_id+"'] > td.price").text("-");
                        }
                    }else if(response == "logged_out"){
                        alert(lg.session_ended_logged_out);
                        location.reload();
                    }else{
                        alert(lg.could_not_upd+"!");
                    }     
                },
                error: function(response)
                {
                    console.log(response);
                    alert(lg.could_not_upd+"!");
                }
            });
        }
    }
}

function approvePrice(job_id){
	if (confirm(lg.approve_price+"?")) {
		$.ajax({
			type: "POST",
			url: "/res/translations_manager.php",
			data: {
				main_id: job_id,
				action: "approvePrice"
			},
			async: true,
			cache: false,
			success: function(response)
			{
				//response = JSON.parse(response);
				console.log(response);
				if(response == "ok"){
					$("tr[job_id='"+job_id+"']").remove();
					$("tr.to_toggle[toggle_id='"+job_id+"_job']").remove();
				}else if(response == "error"){
					alert(lg.error);
				}else if(response == "logged_out"){
					alert(lg.session_ended_logged_out);
					location.reload();
				}else{
					alert(lg.could_not_appr+"!");
				} 
			},
			error: function(response)
			{
				console.log(response);
				alert(lg.could_not_appr+"!");
			}
		});
    	} else {
	}
}

function cancelUpdate(clicked){
    $parent = $(clicked).parent().parent();
    $parent.prev(".original").removeClass("hide");
    $parent.addClass("hide");
}

function tableAction(table_id, file, action){
    var data = {};
    var counting = 0;
    $("#"+table_id+" input.main_select").each(function(){
        if($(this).is(":checked")){
            data[counting] = {};
            data[counting] = $(this).val();
            counting++;
        }
    })
    if(counting > 0){
        $.ajax({
            type: "POST",
            url: file,
            data: {
                action: action,
                data: data
            },
            async: true,
            dataType: 'json',
            cache: false,
            success: function(response)
            {
               	 if(response == "ok"){
				if(action == "removeEmployeePairs"){
					location.reload();
				}
               	 }else if(response == "logged_out"){
				alert(lg.session_ended_logged_out);
				location.reload();
			 }
                //if(is_numeric(response) && action == "removeEmployeePairs")         
            },
            error: function(response)
            {
                console.log(response);
            }
        });
    }
}


function resetSelectInput(elem){
    $(elem).parent().parent().parent().find("input[name='speciality']").val($(elem).attr("val"));
    $(elem).parent().parent().parent().find(".select.speciality > .text").text($(elem).text());
}