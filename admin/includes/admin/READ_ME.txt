There you can place additional files like _filename.php for admin menu.

FOR notify numbers:

	if(!empty($_POST["notify"]))
	{
		//if need: require('../../../config.php');
		?>
		NOTIFY_SPLITTER
		<span>
			<i style="opacity:1;" title="your title here">0</i>
			<b style="opacity:1;" title="your title here">1</b>
		</span>
		<?php
		exit();
	}