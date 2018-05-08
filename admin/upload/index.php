<?php

$id= !empty($_GET["id"]) ? $_GET["id"] : '';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Bilžu ielāde</title>
<link href="default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="swfupload.js"></script>
<script type="text/javascript" src="swfupload.queue.js"></script>
<script type="text/javascript" src="fileprogress.js"></script>
<script type="text/javascript" src="handlers.js"></script>
<script type="text/javascript">
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "swfupload.swf",
				upload_url: "upload.php?id=<?php echo $id; ?>",
				post_params: {"PHPSESSID" : ""},
				file_size_limit : "200 MB",
				file_types : "*.jpg;*.jpeg;*.png;*.gif",
				file_types_description : "Photo Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "button1.png",
				button_width: "132",
				button_height: "36",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont">Ielādēt</span>',
				button_text_style: ".theFont { font-family:Verdana;font-size: 13; text-align: center;cursor:pointer; }",
				button_text_left_padding: 0,
				button_text_top_padding: 3,

				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     };
	</script>
</head>
<body>


	<form id="form1" action="upload.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
 			<div class="fieldset flash" id="fsUploadProgress">
			<span class="legend">Bilžu ielāde</span>
			</div>
		<div id="divStatus">0 faili ielādēti</div>
			<div><table><tr><td>
				<span id="spanButtonPlaceHolder" style="cursor:pointer;"></span></td><td>
				<div id="btnCancel" onclick="swfu.cancelQueue();" disabled="disabled" style="
					margin-left:5px;
					width: 132px;
					height: 36px;
					font-size:12px;
					padding:6px 0px 0px 0px;
					background-image:url('button1.png');
					background-position: 0px -72px;
					vertical-align:center;
					text-align:center;
					cursor:pointer;
					">Atcelt visas ielādes</div>
				<div onclick="window.close(); window.opener.location.reload();" style="
				     margin-left:5px;
				     width: 132px;
				     height: 36px;
				     font-size:12px;
				     padding:6px 0px 0px 0px;
				     background-image:url('button1.png');
				     background-position: 0px -72px;
				     vertical-align:center;
				     text-align:center;
				     cursor:pointer;
				     ">Aizvērt</div>
				 
            </td></tr></table>
            </div>
	</form>

</body>
</html>
