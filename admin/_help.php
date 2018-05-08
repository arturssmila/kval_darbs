<?php 
if(!empty($_POST))
{
	$name = !empty($_POST["name"]) ? $_POST["name"] : '';
	$save = !empty($_POST["save"]) ? $_POST["save"] : '';
	if ($save)
	{
		$xml = new SimpleXMLElement('<help/>');
		
		$old = array('"');
		$new = array('&quot;');
		foreach($name as $name_key => $name_val)
		{
			$item = $xml->addChild('item');
			foreach($name_val as $key => $val)
			{
				$trans = $item->addChild('translation');
				$trans->addChild('iso', $key);
				$trans->addChild('title', $val["title"]);
				$trans->addChild('description', $val["description"]);
			}
		}
		file_put_contents("../help.xml",$xml->asXML());
	}
	header("location: /admin/$mode/");
	exit();
}

/********************************************************************************************/
$help = array();
$help_sort = array();		
?>
<script>
name_id = 0;
function new_help_val()
{
	name_id = name_id - 1;
	html = 	'<tr>'+
	<?php
	foreach($languages as $key => $val)
	{
	?>
		'	<td class="top">'+
		'		<input type="text" name="name['+name_id+'][<?php echo $val["iso"]; ?>][title]" value="" />'+
		'		<textarea style="margin-top:2px;width:100%;min-width:100%;" name="name['+name_id+'][<?php echo $val["iso"]; ?>][description]"></textarea>'+
		'	</td>'+
	<?php
	}
	?>
		'</tr>';
	$("#lang_table").append(html);
}
</script>
<?php
$help_file = @simplexml_load_file("../help.xml");
if($help_file!==FALSE)
{
	foreach ($help_file->item as $item)
	{
		$translations = array();
		$title = '';
		$description = '';
		foreach($item->translation as $translation)
		{
			$translations["{$translation->iso}"]["title"] = "{$translation->title}";
			$translations["{$translation->iso}"]["description"] = "{$translation->description}";
		}
		$help[] = $translations;
		$title		= !empty($translations[$admin_lang]["title"])		?$translations[$admin_lang]["title"]		:(!empty($translations[$languages[0]["iso"]]["title"])		?$translations[$languages[0]["iso"]]["title"]		:reset($translations));
		$description	= !empty($translations[$admin_lang]["description"])	?$translations[$admin_lang]["description"]	:(!empty($translations[$languages[0]["iso"]]["description"])	?$translations[$languages[0]["iso"]]["description"]	:reset($translations));
		if(is_array($title)) $title = $title["title"];
		if(is_array($description)) $description = $description["description"];
		$help_sort[$title] = $description;
	}
}
/****************************************************************************************************************************************************************************************/
if($update_host == $_SERVER['HTTP_HOST'])//server
{
?>
<form action="" method="post">
	<table id="lang_table" style="width:100%;position:relative;">
		<tr>
			<th colspan="2" align="left"><?php echo al("help"); ?></th>
		</tr>
		<tr>
			<?php
			foreach($languages as $lkey => $lval)
			{
			?>
			<th><?php echo $lval["name"]; ?></th>
			<?php
			}
			?>
		</tr>
		<?php
		foreach($help as $key => $val)
		{
		?>
		<tr>
			<?php
			foreach($languages as $lkey => $lval)
			{
				echo '<td class="top">';
				?>
				<input 
					<?php echo empty($val[$lval["iso"]]["title"])? 'class="redborder"' : ''; ?>
					name="name[<?php echo $key; ?>][<?php echo $lval["iso"]; ?>][title]"
					type="text"
					value="<?php echo (!empty($val[$lval["iso"]]["title"])?$val[$lval["iso"]]["title"]:''); ?>"
					onkeyup="$('div',$(this).parent('td')).slideDown(500);$('div h2',$(this).parent('td')).html($(this).val());"
					/>
				<textarea
					<?php echo empty($val[$lval["iso"]]["description"])? 'class="redborder"' : ''; ?>
					name="name[<?php echo $key; ?>][<?php echo $lval["iso"]; ?>][description]"
					style="margin-top:2px;width:100%;min-width:100%;"
					onkeyup="$('div',$(this).parent('td')).slideDown(500);$('div teaser',$(this).parent('td')).html($(this).val());"
					><?php echo (!empty($val[$lval["iso"]]["description"])?$val[$lval["iso"]]["description"]:''); ?></textarea>
				<div style="display:none;">
					<h2><?php echo (!empty($val[$lval["iso"]]["title"])?$val[$lval["iso"]]["title"]:''); ?></h2>
					<teaser><?php echo (!empty($val[$lval["iso"]]["description"])?$val[$lval["iso"]]["description"]:''); ?></teaser>
				</div>
				<?php
				echo '</td>';
			}
			?>
		</tr>
		<?php
		}
		?>
	</table>
	<button type="save" name="save" value="save"><?php echo al("saglabat"); ?></button>
</form>
<button type="restore" name="add" onclick="new_help_val();"><?php echo al("pievienot_jaunu"); ?></button>
<?php
}
/****************************************************************************************************************************************************************************************/
else /***********************************************************************************************************************************************************************************/
/****************************************************************************************************************************************************************************************/
{
	?>
	<table id="lang_table" style="width:100%;position:relative;">
		<tr>
			<th colspan="2" align="left"><?php echo al("help"); ?></th>
		</tr>
	</table>
	<?php
	ksort($help_sort);
	foreach($help_sort as $key => $val)
	{
		echo '<h2>'.$key.'</h2>';
		echo '<teaser>'.$val.'</teaser>';
	}
}
/****************************************************************************************************************************************************************************************/
?>
