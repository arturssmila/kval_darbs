$(document).ready(function() {
    var forgot_password_submit_clicked = false;
    $('#forgot_password_form #forgot_password_button').click(function(){
        if(forgot_password_submit_clicked == false)
        {
            forgot_password_submit_clicked = true;
            var required = 0;
            var filled = 0;
            var data = {};
            var i = 0;
            var was_error = false;
            $('span.error').remove();
            $('#forgot_password_form input').each(function(){
                $(this).removeClass("error");
                data[i] = {};
                data[i]["key"]      = $(this).attr('name');
                data[i]["type"]     = "forgot";
                data[i]["required"] = ($(this).hasClass('required')) ? 'required' : '';
                data[i]["value"]    = $(this).val();
                if(data[i]["required"]!='')
                {              
                    required++;     
                    if(data[i]["value"]=='')
                    {
                        $(this).before("<span class=\"error\">" + lg["field_required"] + "</span>");
                        $(this).addClass("error");
                        was_error = true;
                    }else{
                        filled++;
                    }
                }
                i++;
            });
            if(was_error == true){
                forgot_password_submit_clicked = false;
                return;
            }
            console.log(data);
            //return false;
            if(filled == required)
            {
                $("#forgot_password_button").addClass("hide");
                $(".loading").removeClass("hide");
                reset_password('forgot_password',data,function(d){
                    console.log(d);
                    if("ok" in d){
                        $(".loading").addClass("hide");
                        $("#reset_code_sent").removeClass("hide");
                        $("input[name='email']").val("");
                    }else{
                        $(".loading").addClass("hide");
                        $("#forgot_password_button").removeClass("hide");
                        alert("error. try again");
                        $("input[name='email']").val("");
                    }
                    forgot_password_submit_clicked = false;
                });
            }
            else {
                forgot_password_submit_clicked = false;
            }
        }
    });
});