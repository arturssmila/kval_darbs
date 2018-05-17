$(document).ready(function(){



    /*$(".date_input").change(function() {//as stupid as this looks this is needed because pikaday somehow does not change the attribute value. It only changes the visual value in input.
        var value = $(this).val();
        $(this).attr("value", value);
    });*///pikaday disabled right now for this so we do not need it
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
    
    
});

function createEmployee(){
	var data = {};
	var i = 0;
	var was_error = false;
	var checkbox_count = 0;
	$('span.error').remove();
	$('.redborder').removeClass("redborder");
	$('#create_employee_form .segment:not(.hide) input').each(function(){
		$(this).removeClass("error");
		data[i] = {};
		data[i]["key"]      = $(this).attr('name');
		data[i]["required"] = ($(this).hasClass('required'))?'required':'';
		if($(this).attr("info_type") == "user_data"){
			data[i]["data"]     = "user_data";
		}else{
			data[i]["data"]     = "user";
		}
		if($(this).attr("type") == "checkbox"){
			checkbox_count++;
			data[i]["type"] = $(this).attr("check_type");
			if($(this).is(':checked')){
				data[i]["value"]    = $(this).val();
			}
		}else{
			data[i]["value"]    = $(this).val();
		}

		if(data[i]["required"]!='')
		{                   
			if(data[i]["value"]=='')
			{
				$(this).before("<span class=\"error\">" + lg["field_required"] + "</span>");
				$(this).addClass("error");
				was_error = true;
			}
			if(data[i]["key"] == "mail"){
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if(re.test(data[i]["value"]) == false){
					$(this).before("<span class=\"error\">" + lg["not_an_email"] + "</span>");
					$(this).addClass("redborder");
					was_error = true;
				}
			}else if(data[i]["key"] == "phone"){
				var re = /((?:\+|00)[17](?: |\-)?|(?:\+|00)[1-9]\d{0,2}(?: |\-)?|(?:\+|00)1\-\d{3}(?: |\-)?)?(0\d|\([0-9]{3}\)|[1-9]{0,3})(?:((?: |\-)[0-9]{2}){4}|((?:[0-9]{2}){4})|((?: |\-)[0-9]{3}(?: |\-)[0-9]{4})|([0-9]{7}))/g;
				if(re.test(data[i]["value"]) == false){
					$(this).before("<span class=\"error\">" + lg["not_a_valid_number"] + "</span>");
					$(this).addClass("redborder");
					was_error = true;
				}
			}
		}
		i++;
	});
	for(x in data){
		if(data[x]["type"] == "position"){
			if((typeof data[x]["value"] == "undefined") || (data[x]["value"] == "")){
				delete data[x];
				checkbox_count = checkbox_count - 1;
			}
		}
	}
	
	if(checkbox_count == 0){
		was_error = true;
		alert("Choose at least one position");
	}

	if(was_error == true){
		return;
	}else{
		data["register"] = true;
		$("#create_employee").addClass("hide");
		$(".loading").removeClass("hide");
		//console.log(data);
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
					if(response=="")
					{
						$("#registration_done").removeClass("hide");
						$(".loading").addClass("hide");
						$('#registration_form input[type="password"]').each(function(){
							$(this).val("");
						});
					}
					else{
						alert(response);
						$(".loading").addClass("hide");
						$("#signup_button").removeClass("hide");
					}
					
				}
			});
		}else{
			console.log("nenotiks");
		}
	}
};

function changeRegistrationStatus(action, user_id){
    $.ajax({
        type: "POST",
        url: "/res/manager_admin.php",
        data:
        {
            action:     action,
            user_id:    user_id
        },
        async: true,
        success: function(data)
        {
            if(data == "ok"){
                $target = $(".row_table[person_id='"+user_id+"']");
                $target.hide('slow', function(){
                    $target.remove();
                    if (!($(".row_table")[0])){
                        $("#manager .empty").addClass("show");    
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/res/manager_admin.php",
                    data:
                    {
                        action:     "notification"
                    },
                    async: true,
                    success: function(returned)
                    {
                        if (returned == parseInt(returned, 10)) {
                            $(".menu li.active .notification").text(returned);
                        }
                    }
                });
            }else{
                console.log(data);
                alert("error");
            }
        }
    });
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
			console.log(response);
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

function getJobPrice(main_id){
	$.ajax({
		type: "POST",
		url: "/res/translations_manager.php",
		data: {
			main_id: main_id,
			action: "getJobPrice"
		},
		async: true,
		cache: false,
		success: function(response)
		{
			console.log(response);
			response = JSON.parse(response);
			console.log(response);
			if(response["status"] == "OK"){
				$("tr[job_id='"+main_id+"'] > td.price").text(response["price"]);
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


function offerToClient(job_id){
	if (confirm(lg.offer_client+"?")) {
		$.ajax({
			type: "POST",
			url: "/res/translations_manager.php",
			data: {
				main_id: job_id,
				action: "offerToClient"
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
					alert("could not remove!");
				} 
			},
			error: function(response)
			{
				console.log(response);
				alert("could not offer! Refresh and check if all prices are right");
			}
		});
    	} else {
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

function set_position(elem){
    $parent = $(elem).closest(".dropdown");

    var val = elem.textContent;
    var position = $(elem).attr("position");

    $("#position_id").val(position);
    $parent.find(".text").html(val);
}