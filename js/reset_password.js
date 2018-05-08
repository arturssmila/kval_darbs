$(document).ready(function() {
    var reset_password_submit_clicked = false;
    $('#reset_password_button').click(function(){
        if(reset_password_submit_clicked == false)
        {
            reset_password_submit_clicked = true;
            var required = 0;
            var filled = 0;
            var data = {};
            var i = 0;
            var was_error = false;
            $('span.error').remove();
            $('.error').removeClass('error');
            if($(".segment input[name='password']").val() !== $(".segment input[name='password2']").val()){
                $("input[name='password2']").addClass("error");
                $("input[name='password2']").before("<span class=\"error\">" + lg["password_no_match"] + "</span>");
                was_error = true;
            }
            if(was_error == true){
                reset_password_submit_clicked = false;
                return;
            }
            $('#reset_container .segment input').each(function(){
                $(this).removeClass("error");
                data[i] = {};
                data[i]["key"]      = $(this).attr('name');
                data[i]["type"]     = "reset";
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
                reset_password_submit_clicked = false;
                return;
            }
            //console.log(data);
            //return false;
            if(filled == required)
            {
                $("#reset_password_button").addClass("hide");
                $(".loading").removeClass("hide");
                reset_password('reset_password',data,function(d){
                    if(d["password_changed"] == 1){
                        $(".loading").addClass("hide");
                        $("#reset_done").removeClass("hide");
                        $(".segment input[name='password']").val("");
                        $(".segment input[name='password2']").val("");
                    }else{
                        alert("password_no_match");
                        $(".loading").addClass("hide");
                        $("#reset_password_button").removeClass("hide");
                        $("input[name='password2']").addClass("error");
                        $("input[name='password2']").before("<span class=\"error\">" + lg["password_no_match"] + "</span>");
                    }
                    reset_password_submit_clicked = false;
                });
            }
            else 
                reset_password_submit_clicked = false;
        }
    });
});