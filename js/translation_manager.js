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

    $("#add_pairs").click(function(){
        var pair_data = {};
        var counting = 0;
        var was_error = false;
        $("#add_pairs_table span.error").remove();
        $("#add_pairs_table .error").removeClass("error");
        var curr_year = new Date().getFullYear();
        $("#add_pairs_table tbody tr").each(function(){
            $checkbox = $(this).find("input.checkbox");
            if($checkbox.is(":checked")){
                pair_data[counting] = {};
                pair_data[counting]["id"] = $(this).find(".name").attr("value");
                $date_field = $(this).find(".date_input");
                var reg = /^[0-9]+$/;
                var year = $date_field.val()
                if ((year.match(reg)) && (year.length == 4) && (year <= curr_year) && (year > 1920)) {
                    pair_data[counting]["date"] = $date_field.val();
                }else{
                    $date_field.before("<span class=\"error\">" + lg["field_required"] + "</span>");
                    $date_field.addClass("error");
                    was_error = true;
                }
                var money = 0;
                var money = $(this).find("input.price").val();
                var currency_v = 0;
                var currency_v = $(this).find("input[name=\"currency\"]").val();
                var currency_error = false;
                if(money != "undefined" && money != null && money != 0){
                    pair_data[counting]["amount"] = money;
                }else{
                    $(this).find("input.price").before("<span class=\"error\">" + lg["field_required"] + "</span>");
                    $(this).find("input.price").addClass("error");
                    was_error = true;
                    currency_error = true;
                }
                if(currency_v != "undefined" && currency_v != null && currency_v != 0){
                    pair_data[counting]["currency"] = currency_v;
                }else{
                    if(currency_error == false){
                        $(this).find(".select.currency").before("<span class=\"error\">" + lg["field_required"] + "</span>");
                        $(this).find("input[name=\"currency\"]").addClass("error");
                    }else{
                        $(this).find("input[name=\"currency\"]").addClass("error");
                    }
                    was_error = true;
                }
                counting++;
            }
        });
        if(!was_error){
            var employee_id = $("input#employee_id_input").val();
            $.ajax({
                type: "POST",
                url: "/res/translations_manager.php",
                data: {
                    action: "add_employee_pair",
                    data:pair_data,
                    employee_id: employee_id
                    },
                async: true,
                dataType: 'json',
                cache: false,
                success: function(response)
                {
                    if(response == "empty"){
                        console.log("ree"); 
                    }else if(response instanceof Array){
                        for(x in response) {
                            $target = $("span.name[value='"+response[x]+"']").parent().parent();
                            $target.hide('slow', function(){
                                $target.remove();
                                if (!($("#add_pairs_table tbody tr")[0])){
                                    $("#add_pairs_form").addClass("hide");  
                                    $("#add_pairs_title").addClass("hide");    
                                }
                            });
                        }
                        //console.log(response); 
                        //getEmployeePairs(employee_id);
                        location.reload();
                    }           
                },
                error: function(response)
                {
                    console.log(response);
                }
            });
        }else{
            console.log("not legit");
        }
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
		}
		if((form_data.time == "") || (typeof form_data.time == "undefined")){
			$(".dropdown.small:not(.date) .select").before("<span class=\"error\">" + lg["field_required"] + "</span>");
			$(".dropdown.small:not(.date) .select").addClass("redborder");
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
			}else if(form_data.faili[this_rel].length == 0){
				$(this).find(".file_sector label").addClass("redborder");
				$(this).find(".file_sector").before("<span class=\"error file_sec\">" + lg["field_required"] + "</span>");
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
						alert("the files exceed 30 mb");
					}else if(data == "empty"){
						alert("empty form!");
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
					alert("Something went wrong!");  
					console.log(data);
				}
			});
		}else{
			console.log("user error");
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
                        alert(lg.session_ended_logged_out);
                        location.reload();
                    }else{
                        alert("could not update!");
                    }     
                },
                error: function(response)
                {
                    console.log(response);
                    alert("could not update!");
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
                        }
                    }else if(response == "logged_out"){
                        alert(lg.session_ended_logged_out);
                        location.reload();
                    }else{
                        alert("could not update!");
                    }     
                },
                error: function(response)
                {
                    console.log(response);
                    alert("could not update!");
                }
            });
        }
    }
}

function getFilePrice(main_id, second_id, field){
	var speciality = $(".select.speciality[data_id='"+main_id+"'] input[name='speciality']").val();
	//console.log(speciality);
	$.ajax({
		type: "POST",
		url: '/res/translations_manager.php',
		data: {
			main_id: main_id,
			second_id: second_id,
			field: field,
			speciality_price_id: speciality,
			action: "getFilePrices"
		},
		async: true,
		cache: false,
		success: function(response)
		{	
			//console.log(response);
			response = JSON.parse(response);
			//console.log(response);
			if(response["status"] == "OK"){
				$("tr[file_id='"+main_id+"'] td.price").text(response["price"]);
			}else if(response == "error"){
				alert(lg.error);
			}else if(response == "logged_out"){
				alert(lg.session_ended_logged_out);
				location.reload();
			}else{
				alert("could not update!");
			}     
		},
		error: function(response)
		{
			console.log(response);
			alert("could not update!");
		}
	});
}

function getJobPrice(clicked, main_id, second_id, field, file, action){
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
                    }else if(response == "logged_out"){
                        alert(lg.session_ended_logged_out);
                        location.reload();
                    }else{
                        alert("could not update!");
                    }     
                },
                error: function(response)
                {
                    console.log(response);
                    alert("could not update!");
                }
            });
        }
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

function getEmployeePairs(employee_id){
    $.ajax({
        type: "POST",
        url: "/res/translations_manager.php",
        data:
        {
            action:     "get_employee_pairs",
            employee_id: employee_id
        },
        dataType: 'json',
        cache: false,
        async: true,
        success: function(returned)
        {
            if(returned instanceof Array){
                $("#translator_pairs tbody").html("");
                for(x in returned) {
                    $("#translator_pairs tbody").append("<tr><td><div>"+returned[x]["menu_name"]+"</div></td><td><div>"+returned[x]["when_learned"]+"</div></td><td>"+returned[x]["rate"]+" "+returned[x]["currency"]+"</td></tr>");
                }
            }  
        },
        error: function(response)
        {
            console.log(response);
        }
    });
}

function resetSelectInput(elem){
    $(elem).parent().parent().parent().find("input[name='speciality']").val($(elem).attr("val"));
    $(elem).parent().parent().parent().find(".select.speciality > .text").text($(elem).text());
}