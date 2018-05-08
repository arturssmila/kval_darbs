 form_cv_data.money = [];
  form_cv_data.position_id = $("#position_id_input").val();
 form_cv_data.currency = [];
 form_cv_data.editor = false;
 form_cv_data.questions = [];
$(document).ready(function() {
    //$("#file_upload_modal").remove();

    $(".langs .more").on("click touchend", function() {
        var id = guid();
        var last_rel = $("#apply_vacancy .language_dropdown_group").last().attr("rel");
        last_rel++;

        var closest = $("#apply_vacancy .language_dropdown_group[rel=" + (last_rel-1) + "]").html();
        $(this).before("<div class=\"language_dropdown_group\" id=\"" + id + "\" rel=\"" + last_rel + "\">" + closest + "</div>");
        $("#apply_vacancy .language_dropdown_group[rel=" + last_rel + "] .error").remove();
        $("#apply_vacancy .language_dropdown_group[rel=" + last_rel + "] .redborder").removeClass("redborder");
        $("#apply_vacancy .language_dropdown_group[rel=" + last_rel + "] .language_from .text").text(lg["source_language"]);
        $("#apply_vacancy .language_dropdown_group[rel=" + last_rel + "] .language_from input").attr("value", "");
        $("#apply_vacancy .language_dropdown_group[rel=" + last_rel + "] .language_to_select").text(lg["source_language"]);

        var input = Math.floor($("#quote_block .segment:first input").length / 2);
    });

    $(document).on("click touchend", ".language_dropdown_group .close", function() {
        var this_rel = $(this).closest(".language_dropdown_group").attr("rel");
        $(this).closest(".language_dropdown_group").remove();
        form_cv_data.from_langs[this_rel] = [];
        form_cv_data.to_langs[this_rel] = [];
    });

    $("#other_language").on("keyup", function() {
        var this_value = $(this).val();
        if(from_to == "to" && $(".multi_select_languages.other").is(':checked')){
            form_cv_data.to_langs[curr_rel] = this_value;
            if(this_value != ""){
                $(".language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_to .text").text(this_value);
            }else{
                $(".language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_to .text").text(lg["target_language"]);
            }
        }else if(from_to == "from" && $(".multi_select_languages.other").is(':checked')){
            form_cv_data.from_langs[curr_rel] = this_value;
            if(this_value != ""){
                $(".language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_from .text").text(this_value);
            }else{
                $(".language_dropdown_group[rel=\"" + curr_rel + "\"] .select.language_from .text").text(lg["source_language"]);
            }
        }
    });

    $('input#cv_file_input:file').on("change", function(){ 
        checkCV(this.files, curr_rel, "vacancies_modal");
    });

    /*$(document).on("click touchend", ".modal_file_item .close, .language_file_item .close", function() {
        curr_rel = 0;
        $(".modal_file_item[rel='" + 0 + "'][rel_1='" + 0 + "']").remove();
        $(".language_file_item[rel='" + 0 + "'][rel_1='" + 0 + "']").remove();
        var to_delete = form_cv_data.faili[0][0];
        if(deleteUploaded(0, to_delete)){
            form_cv_data.file_names.splice(0, 1);
            form_cv_data.faili.splice(0, 1);
            complete_size -= parseInt(form_cv_data.file_sizes[0][0]);
            form_cv_data.file_sizes.splice(0, 1);
            getModalFileList(0);
            updateCvFileList();
        }
    });*/
    $("#send_application").click(function(){
        var validated = 1;
        if(editor == true){
            form_cv_data.editor = true;
        }else{
            form_cv_data.editor = false;
        }
        $("#apply_vacancy .segment .error").remove();
        $("#apply_vacancy .segment input.required").removeClass("redborder");
        $("#apply_vacancy .segment textarea.required").removeClass("redborder");
        $("#apply_vacancy .segment input.phone").removeClass("redborder");
        $(".dropdown .select.language_to, .dropdown .select.language_from").removeClass("redborder");
        $("#vacancy_cv").removeClass("redborder");
        $("#apply_vacancy .segment.names input.required, #apply_vacancy .segment.email input.required, #apply_vacancy .segment.prof input.required").each(function(){
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
                        form_cv_data[name] = val;
                    }
                }else{
                    if(val.length > 1){
                        form_cv_data[name] = val;
                    }else{
                        $(this).before("<span class=\"error\">" + lg["more_than_two"] + "</span>");
                        $(this).addClass("redborder");
                        validated = 0;
                    }
                }
            }else{
                $(this).addClass("redborder");
                $(this).before("<span class=\"error\">" + lg["field_required"] + "</span>");
                validated = 0;
            }
        });
        var question_key = 0;
        form_cv_data.questions = [];
        $("#apply_vacancy .segment.questions textarea.required[v_id=\""+form_cv_data["position_id"]+"\"]").each(function(){
            var val = $(this).val();
            var ques_id = $(this).attr("q_id");
            var question = $(this).prev("span.title").text();
            if(val != ""){
                if(val.length >= min_character_count && val.length <= max_character_count){
                    if(!(question_key in form_cv_data.questions)){
                        form_cv_data.questions[question_key] = [];
                    }
                    form_cv_data.questions[question_key][0] = ques_id;
                    form_cv_data.questions[question_key][1] = question;
                    form_cv_data.questions[question_key][2] = val;
                    question_key++;
                }else if(val.length < min_character_count){
                    $(this).before("<span class=\"error\">" + lg["more_than_two"] + "</span>");
                    $(this).addClass("redborder");
                    validated = 0;
                }else if(val.length > max_character_count){
                    $(this).before("<span class=\"error\">" + lg["more_than_two"] + "</span>");
                    $(this).addClass("redborder");
                    validated = 0;
                }
            }else{
                $(this).addClass("redborder");
                $(this).before("<span class=\"error\">" + lg["field_required"] + "</span>");
                validated = 0;
            }
        });
        $("#apply_vacancy .segment.langs .language_dropdown_group").each(function(){
            var this_rel = $(this).attr("rel");
            if(editor == false){
                if(!(this_rel in form_cv_data.from_langs)){
                    $(this).find(".select.language_from").addClass("redborder");
                    $(this).find(".select.language_from").before("<span class=\"error\">" + lg["field_required"] + "</span>");
                    validated = 0;
                }else if(form_cv_data.from_langs[this_rel] == null || form_cv_data.from_langs[this_rel] == ""){
                    $(this).find(".select.language_from").addClass("redborder");
                    $(this).find(".select.language_from").before("<span class=\"error\">" + lg["field_required"] + "</span>");
                    validated = 0;
                }
            }
            if(!(this_rel in form_cv_data.to_langs)){
                $(this).find(".select.language_to").addClass("redborder");
                $(this).find(".select.language_to").before("<span class=\"error\">" + lg["field_required"] + "</span>");
                validated = 0;
            }else if(form_cv_data.to_langs[this_rel] == null || form_cv_data.to_langs[this_rel] == ""){
                $(this).find(".select.language_to").addClass("redborder");
                $(this).find(".select.language_to").before("<span class=\"error\">" + lg["field_required"] + "</span>");
                validated = 0;
            }
            var money = 0;
            var money = $(this).find("input.price").val();
            var currency_v = 0;
            var currency_v = $(this).find("input[name=\"currency\"]").val();
            if(money != "undefined" && money != null && money != 0){
                form_cv_data.money[this_rel] = money;
            }
            if(currency_v != "undefined" && currency_v != null && currency_v != 0){
                if(!(this_rel in form_cv_data.currency)){
                    form_cv_data.currency[this_rel] = {};
                }
                form_cv_data.currency[this_rel] = currency_v;
            }
        });
        if ((typeof form_cv_data.faili === 'undefined') || (form_cv_data.faili < 1)) {
            validated = 0;
            $("#vacancy_cv").addClass("redborder").before("<span class=\"error\">" + lg["field_required"] + "</span>");
        }
        if(validated == 1){
            $.ajax({
                url: '/res/cv_requests.php',  //server script to process data
                type: 'POST',
                data: {form_data: JSON.stringify(form_cv_data), action: "create_request"},
                async: true,
                success: function(data) {  
                    if(data == "big"){
                        alert("the files exceed 5 mb");
                    }else if(data == "empty"){
                        alert("empty form!");
                    }else if(data == "ok"){
                        alert(lg.form_submitted);
                        form_cv_data.first_name = null;
                        form_cv_data.last_name = null;
                        form_cv_data.email = null;
                        form_cv_data.from_langs = [];
                        form_cv_data.to_langs = [];
                        form_cv_data.faili = [];
                        form_cv_data.file_names = [];
                        form_cv_data.file_sizes = [];
                        form_cv_data.questions = [];
                        form_cv_data.money = [];
                        form_cv_data.currency = [];
                        form_cv_data.editor = editor_start;
                        $(".segment.names input").val("");
                        $(".segment.email input").val("");
                        $(".segment.questions textarea").val("");
                        $('.language_dropdown_group .rate_block input.required_price').val("");
                        $(".segment.prof .dropdown .select .text").text(starting_vacancy);
                        $("#position_id_input").val(starting_vacancy_id);
                        $("#position_input").val(starting_vacancy);
                        $('.language_dropdown_group').each(function(){
                            var rel = $(this).attr("rel");
                            if(rel > 0){
                                $(this).remove();
                            }
                        });
                        $(".language_dropdown_group[rel=\"0\"] .language_from .text").text(lg["source_language"]);
                        $(".language_dropdown_group[rel=\"0\"] .language_from input").removeAttr('value');
                        $(".language_dropdown_group[rel=\"0\"] .language_to .language_to_select").text(lg["source_languages"]);
                        $(".language_dropdown_group[rel=\"0\"] .language_to input").removeAttr('value');
                        updateCvFileList();
                        $(".more_files_warning.show").removeClass("show");
                        $("#quote_block .more").removeAttr("style");
                    }
                },
                error: function(data) {
                    alert("Something went wrong!");  
                    console.log(data);
                }
            });
            //console.log(form_cv_data);
        }else{
            updateCvFileList();

        }
    });
});

function checkCV(filesList, curr_rel, modal_id){
    var allow = 1;
    var last_size = 0;
    var curr_size = 0;
    curr_rel = 0;
    if(!(curr_rel in form_cv_data.faili)){
        form_cv_data.faili[curr_rel] = [];
    }else{
        form_cv_data.faili[curr_rel] = [];
        form_cv_data.file_names[curr_rel] = [];
        form_cv_data.file_sizes[curr_rel] = [];
    }
    for(i = 0; i < filesList.length; i++){
        complete_size += filesList[i].size;
        curr_size += filesList[i].size;
        last_size = filesList[i].size;
    }
    var path;
    if(allow == 1){
        if(complete_size > 5242880){
            complete_size -= curr_size;
            alert(lg["bad_file_size"]);
        }else{     
            if(!(curr_rel in form_cv_data.file_names)){
                form_cv_data.file_names[curr_rel] = [];
            }
            if(!(curr_rel in form_cv_data.file_sizes)){
                form_cv_data.file_sizes[curr_rel] = [];
            }
            var formData = new FormData();
            captcha = grecaptcha.getResponse();
            files = [];
            for(i = 0; i < filesList.length; i++){
                formData.append("file"+i, filesList[i]);
            }
            formData.append("action", "upload"); 
            formData.append("captcha", captcha);
            uploadFile(formData, modal_id);
        }
    }else{
    }
    $("#modal_file_input").val("");
}


function resetInputWithId(elem, edit){
    $parent = $(elem).closest(".dropdown");
    //form_cv_data[variable] = elem.textContent;

    var val = elem.textContent;
    var id = $(elem).attr("id");
    form_cv_data.position_id = id;
    //console.log(val);

    $("#position_input").val(val);
    $("#position_id_input").val(id);
    $parent.find(".text").html(val);
    if(edit == true){
        editor = true;
    }else{
        editor = false;
    }
    ShowQuestions(id);
}

function ShowQuestions(pos_id){
    $("#apply_vacancy .question").removeAttr("style");
    $("#apply_vacancy .question").each(function(){
        if($(this).find("textarea").attr("v_id") == pos_id){
            if($(this).hasClass("hide")){
                $(this).removeClass("hide");
            }
        }else{
            if(!($(this).hasClass("hide"))){
                $(this).addClass("hide");
            }
        }
    });
    $("#apply_vacancy .question:not(.hide)").first().css("padding-top", 0);
}

function toggleVacancyForm(thiss){
    $(thiss).toggleClass("simple");
    $(thiss).toggleClass("fifty_line_h");
    $("#toggle_vacancy_form").slideToggle(250).toggleClass("show");
    if(($("#toggle_vacancy_form").hasClass("show"))){
        $('html, body').animate({
            scrollTop: $("#toggle_vacancy_form").offset().top - 150
        }, 500);
    }
}