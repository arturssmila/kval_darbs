$(document).ready(function() {
    $('#signup_button').click(function(){
        var data = {};
        var i = 0;
        var was_error = false;
        $('span.error').remove();
        $('.redborder').removeClass("redborder");
        $('#registration_form .segment:not(.hide) input').each(function(){
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
        data["register"] = true;
        $("#signup_button").addClass("hide");
        $(".loading").removeClass("hide");
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
                    //console.log(response);
                    if(response=="")
                    {
                        $("#registration_done").removeClass("hide");
                        $(".loading").addClass("hide");
                        send_template_data("", sender_email, data,'template_user_register',function(response){
                            console.log(response)
                        });
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
        }
    });
});

function resetInputDropdown(elem, val){
    $parent = $(elem).closest(".dropdown");

    var txt = elem.textContent;
    //console.log(val);

    $parent.find("input").val(val);
    $parent.find(".text").html(txt);
}

function changeUserType(elem, val, mode){
    $(".centered_form .segment").each(function(){
        var this_mode = $(this).attr("mode");
        $this_input = $(this).find("input");
        if((this_mode == mode) || (this_mode == 'b')){
            if(this_mode == mode){
                if(!($this_input.hasClass("required"))){
                    $this_input.addClass("required");
                }
                if($(this).hasClass("hide")){
                    $(this).removeClass("hide");
                }
            }
        }else{
            if($this_input.hasClass("required")){
                $this_input.removeClass("required");
            }
                if(!($(this).hasClass("hide"))){
                    $(this).addClass("hide");
                }
        }
    });
    resetInputDropdown(elem, val);
}