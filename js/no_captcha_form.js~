
$(document).ready(function() {
	$('input#modal_file_input:file').unbind();
	$('input#modal_file_input:file').on("change", function(){
		checkFilesAdmin(this.files, curr_rel, "submit_work", form_data);
	});
});

function dragenter_logged(e, id){
    e.preventDefault();
    e.stopPropagation();
    if($("#" + id + " #file_upload_modal_center").is(":visible")){
        $form.addClass('is_dragover');
    }
}

function dragover_logged(e, id){
    e.preventDefault();
    e.stopPropagation();
}

function drop_logged(e, id){
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


		checkFilesAdmin(droppedFiles, curr_rel, "submit_work", form_data);
        }
    }
}

function make_droppable_logged(id){
    if (isAdvancedUpload && !is_safari){
    	var my_modal = document.getElementById(id);
        my_modal.addEventListener("dragenter", function(){
            dragenter_logged(event, id);
        }, false);
        my_modal.addEventListener("dragover", function(){
            dragover_logged(event, id);
        }, false);
        my_modal.addEventListener("drop", function(){
            drop_logged(event, id);
        }, false);
    }
}

function language_select_nocapt(thiss, id, form_data, form_id){//open language select modal
    if(id == "vacancies_modal"){
        $("#"+id+" .contents .columns ul li.other").removeClass("hide");
    }else{
        if(!($("#"+id+" .contents .columns ul li.other").hasClass("hide"))){
            $("#"+id+" .contents .columns ul li.other").addClass("hide");
        }
    }
    $("#"+id).css("display", "table");
    $("#file_upload_modal_center").hide();
    $("#language_select_modal").show();
    $("#language_select_modal .multi_select_languages").removeAttr('checked');
    $(".select_item span.active").removeClass("active");
    curr_rel = thiss.parent().parent().parent().attr("rel");
    var this_value = 0;
    if($(".selected_languages").hasClass("show")){
        $(".selected_languages").removeClass("show");
    }
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
}


function uploadFileLogged(formD, form_id, form_data){//upload files to tmp dir
    extension_list = js_extensions.split(",");
    //console.log(formD);
        $.ajax({
            url: '/res/translations_manager.php',
            type: 'POST',
            data: formD,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "json",
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
               // console.log(data)
                if(data == "big"){
                    alert(lg["bad_file_size"]);
                }else if(data == "empty"){
                    alert(lg["empty"]);
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
				updateDropdownFileList(curr_rel, "sumbit_work", form_data);
				getModalFileList(curr_rel, "quote", form_data);
                }
            },
            error: function(data) {
                alert("Something went wrong! PDF or plain text only!");
                console.log(data);
                //alert(JSON.stringify(data));
            }
        });
    //}
}

function callFileUploadModalAdmin(thiss, id, mode) {//open file upload modal
	curr_rel = $(thiss).attr("rel");
    	if(isAdvancedUpload && !is_safari){
    		$(".file_label_content").html("<strong>" + lg["choose_file"] + "</strong><span class=\"box__dragndrop\"> " + lg["or_drag"] + "</span>.");
    	}else{
    		$(".file_label_content").html("<strong>" + lg["choose_file"] + "</strong>.");
    	}
	$("#modal_file_input").attr("mode", mode).attr("multiple","");
	$("#file_upload_modal_center .contents .subtitle").removeClass("hide");
	$("#file_upload_modal_center > .title").text(lg["quote_two"].toUpperCase());
	$("#file_upload_modal_center .size_warning").text(lg["file_size_limit"]);
	$("#"+id).css("display", "table");
	$("#language_select_modal").hide();
	$("#file_upload_modal_center").show();
	$(".box__input").show();
	$(".box__error").hide();
	$(".box__uploading").hide();
	$(".box__success").hide();
    	make_droppable_logged("file_upload_modal_logged");
	getModalFileList(curr_rel, "quote", form_data);
}

function checkFilesAdmin(filesList, curr_rel, form_id, form_data){//prepare files for upload
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
    var path;
   // console.log(path);
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
            files = [];
            for(i = 0; i < filesList.length; i++){
                formData.append("file"+i, filesList[i]);
            }
            formData.append("action", "upload"); 
            uploadFileLogged(formData, form_id, form_data);
        }
    }else{
    }
    $("#modal_file_input").val("");
    //$("#inbox_svg").show();
    //$("#file_upload_modal .box__input .loading").removeClass("show");
}

