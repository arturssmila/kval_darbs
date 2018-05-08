$(document).ready(function(){

    $("#create_employee").click(function(){
        var data = {};
        var i = 0;
        var was_error = false;
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
            data[i]["value"]    = $(this).val();

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

        if(was_error == true){
            return;
        }
        $("#create_employee").addClass("hide");
        $(".loading").removeClass("hide");
        console.log(data);
        if(Object.keys(data).length > 0)
        {  
            $.ajax({
                type: "POST",
                url: "/res/manager_admin.php",
                data: {
                    action: "employee_data",
                    data:data
                    },
                async: true,
                dataType: 'json',
                cache: false,
                success: function(response)
                {
                    if(Object.keys(response).length > 0){
                        $.ajax({
                            type: "POST",
                            url: "/cms/libs/00.php",
                            data: {
                                lang:lang,
                                data:response
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
                    }                    
                }
            });
        }else{
        }
    });

    /*$(".date_input").change(function() {//as stupid as this looks this is needed because pikaday somehow does not change the attribute value. It only changes the visual value in input.
        var value = $(this).val();
        $(this).attr("value", value);
    });*///pikaday disabled right now for this so we do not need it

    
    
});

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

function set_position(elem){
    $parent = $(elem).closest(".dropdown");

    var val = elem.textContent;
    var position = $(elem).attr("position");

    $("#position_id").val(position);
    $parent.find(".text").html(val);
}