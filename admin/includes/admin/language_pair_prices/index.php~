<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/res/res_functions.php");
	meta("S", array("template"=>"expertise_item"), $expertise_items);
	meta("S", array("template"=>"language_pair"), $language_pairs);
	$results = "";
 
	if (!empty($expertise_items)) {	
		$lang_count = count($expertise_items);
		$lang_count++;
	}
	function getPrice($id){
		$query = "SELECT * FROM language_pair_prices WHERE pair_id=\"" . $id . "\"";//get all language pairs of employee
		$rs= mysql_query($query);
		$returnable = getSqlRows($rs);//yes, pears
		return $returnable;
	}
?>
<?php if(!empty($results)){
	echo(
		"<div id=\"results\">" . $results . "</div>"
	);
} ?>
<div class="ui title flexy force">
	<?= al("Language_pair_prices") ?>
</div>
<?php //out($language_pairs) ?>
<form method="post" id="lang_pairs" onsubmit="event.preventDefault();">
	<table class="ui">
		<thead>
			<tr>
				<th colspan="1" rowspan="2" class="right_black_border top_bottom_black_border"><?= al("Language_pairs") ?></th>
				<th colspan="<?= ($lang_count) ?>" style="text-align: center;"><?= al("expertise_items") ?></th>
			</tr>
			<tr>
				<th colspan="1"><?= al("regular") ?></th>
				<?php if(!empty($expertise_items)):?>
					<?php foreach ($expertise_items as $i): ?>
						<th colspan="1"><?= $i["name"] ?></th>
					<?php endforeach; ?>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($language_pairs)):?>
				<?php foreach ($language_pairs as $i): ?>
					<tr class="ui hover">
						<td class="head_td right_black_border top_bottom_black_border">
							<?= $i["name"] ?>
						</td>
						<td class="center_t">
							<input type="text" <?php
							if(empty($prices)){
								echo "value='0'";
							}else{
								foreach($prices as $key=>$item){
									if($item["speciality"] == "regular"){
										echo("value='".$item["rate"]."'");
										break;
									}
								}
							} ?> onchange="toggleCheckbox('pair_<?= $i["id"] ?>_<?= $i["id"] ?>[]')" >
						</td>
					<?php foreach ($expertise_items as $ii): ?>
					<?php $prices = getPrice($i["id"]);?>
						<td class="center_t">
							<input name="pair_<?= $i["id"] ?>_<?= $ii["id"] ?>[]" type="text" <?php
							if(empty($prices)){
								echo "value='0'";
							}else{
								foreach($prices as $key=>$item){
									if($item["speciality"] == $ii["id"]){
										echo("value='".$item["value"]."'");
									}
								}
							}
							?> onchange="toggleCheckbox('pair_<?= $i["id"] ?>_<?= $ii["id"] ?>[]')" >
							<input tips="no" name="pair_<?= $i["id"] ?>_<?= $ii["id"] ?>[]" type="hidden" <?php echo("value=\"".$i["id"]."\""); ?>>
							<input tips="uz" name="pair_<?= $i["id"] ?>_<?= $ii["id"] ?>[]" type="hidden" <?php echo("value=\"".$ii["id"]."\""); ?>>
						</td>
					<?php endforeach; ?>
					</tr>
				<?php endforeach;?>
			<?php endif;?>
		</tbody>	
	</table>

	<input type="hidden" name="action" value="" id="action">

	<div class="ui segment top">
		<?php /*<button type="submit" class="ui button primary"document.getElementById('action').value = 'update';">
			<?= al("saglabat") ?>
		</button>*/ ?>
	</div>
</form>