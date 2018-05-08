<?php
	require_once dirname(__DIR__) . '/Paginator.class.php';

	/*$new_notifications["users"] = '';
	if(get_user("S",array("registered"=>"1 DAY","orderby"=>"registered DESC"),$users))
	{
		$query="SELECT COUNT(id) AS `NumberOfProducts` 
		FROM  `translation_requests` 
		WHERE DATE_ADD( created, INTERVAL 1 
		DAY ) > NOW()";
		 
		$op = (86400-(strtotime(date('Y-m-d H:i:s')) - strtotime($users[0]["registered"])))/86400; //izdalam pret 24h
		$new_notifications["users"] = '<span><i style="opacity:'.$op.';" title="'.al("new_users").'">'.count($users).'</i></span>';
	}*/


	$limit      = ( (isset( $_GET['cat2'] )) && (!empty($_GET['cat2'])) ) ? ((!is_numeric($_GET['cat2'])) ? "all" : $_GET['cat2']) : 20;
    $page       = ( isset( $_GET['cat1'] ) ) ? ((is_numeric($_GET['cat1'])) ? $_GET['cat1'] : 1) : 1;
    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
 
	if (!empty($_POST)) {

		
		alert(al("action_processing"), "primary");

		if(!empty($_POST["action"]) && $_POST["action"] == "remove"){
			foreach ($_POST as $key => $value) {
				if($key != "action"){
					$query = "SELECT cv_file_path FROM request_files WHERE id = \"" . $value . "\"";
					$rs = mysql_query($query);
				    if(mysql_num_rows($rs) > 0){
				    	$files = array();
					    while($row = mysql_fetch_assoc($rs))
						{
							$files[] = $row;
						}
						foreach ($files as $keyy => $valuee) {
							if(is_file($valuee["file_path"])){
								unlink($valuee["file_path"]);
							}
						}
					}
					$query = "DELETE FROM vacancy_languages WHERE vacancy_id = \"" . $value . "\"";
					mysql_query($query);
					$query = "DELETE FROM vacancy_questions WHERE vacancy_id = \"" . $value . "\"";
					mysql_query($query);
					$query = "DELETE FROM vacancy_requests WHERE id = \"" . $value . "\"";
					mysql_query($query);
				}
			}	
		    $Paginator  = new Paginator( "SELECT * FROM vacancy_requests ORDER BY created DESC" );		 
		    $requests = $Paginator->getData( $limit, $page );
		}
		reload();	
	}else{
	    $Paginator  = new Paginator( "SELECT * FROM vacancy_requests ORDER BY created DESC" );		 
	    $requests = $Paginator->getData( $limit, $page );
	}
?>

<div class="ui title flexy force">
	<?= al("Vacancy_requests") ?>
</div>

<form method="post" id="vacancy_requests">
	<table class="ui sortable">
		<thead>
			<tr>
				<th style="width: 20px"><?= al("id") ?></th>
				<th><?= al("vards") ?></th>
				<th><?= al("uzvards") ?></th>
				<th><?= al("email") ?></th>
				<th><?= al("vacancy_position") ?></th>
				<th><?= al("cv_file") ?></th>
				<th><?= al("submitted") ?></th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($requests)):?>
				<?php foreach ($requests->data as $i): ?>
					<?php
						$langs = array();
						$query = "SELECT * FROM vacancy_languages WHERE vacancy_id = '" . $i["id"] . "'";
						$res = mysql_query($query);
						if(mysql_num_rows($res) > 0)
						{
							while($row = mysql_fetch_assoc($res))
							{
								$langs[] = $row;
							}
						}

						$questions = array();
						$query = "SELECT * FROM vacancy_questions WHERE vacancy_id = '" . $i["id"] . "'";
						$res = mysql_query($query);
						if(mysql_num_rows($res) > 0)
						{
							while($row = mysql_fetch_assoc($res))
							{	
								$questions[] = $row;
							}
							//out($no_lang_files);
							//var_dump($lang_files);
						}
						?>

					<tr class="ui hover" <?php /*onClick="window.location.href = '<?= url($i["id"]) ?>';" */?> data="<?= $i["id"] ?>">
						<td>
							<?= $i["id"] ?>
						</td>
						<td>	
							<?= $i["first_name"] ?>
						</td>
						<td>	
							<?= $i["last_name"] ?>
						</td>
						<td>	
							<?= $i["email"] ?>
						</td>
						<td>	
							<?php
								meta("S", array("template"=>"vacancy", "id"=>$i["vacancy_name_id"]), $vacancy_name);
								if(!empty($vacancy_name)){
									echo $vacancy_name[0]["name"];
								}else{
									echo $i["recorded_vacancy_name"];
								}
							?>
						</td>
						<td>
							<?php
								$exploded = explode("/", $i["cv_file_path"]);
								foreach ($exploded as $keyyy => $valueee) {
									if($valueee != "images"){
										unset($exploded[$keyyy]);
									}else{
										break;
									}
								}
								$imploded = array_values($exploded);
								$label = implode("/", $imploded);
								$label = 'http://'.$_SERVER['HTTP_HOST'] . "/" . $label;
								echo("<a target=\"_blank\" style=\"display: block\" href=\"$label\">CV</a>");
								echo " ";
							?>
						</td>
						<td>
							<?= $i["created"] ?>

							<div class="ui pull_right">
								<label class="ui checkbox">
									<input type="checkbox" name="id_<?= $i["id"] ?>" value="<?= $i["id"] ?>">
									<span></span> 
								</label>
							</div>
						</td>
					</tr>
					<tr class="hidden hidden_tables" id="<?= $i["id"] ?>">
					<?php if ((!empty($langs)) || (!empty($questions))): ?>
						<td colspan="9" class="ui no_padding">
							<?php if(!empty($questions)): ?>
								<table style="width: 100%">
									<thead>
										<th> <?= al("questions") ?></th>
									</thead>
									<tbody>
										<?php foreach ($questions as $key => $value): ?>
											<tr>
												<td colspan="8" class="ui" style="background-color: #e0e0d1;">
													<?php
														meta("S", array("template"=>"vacancy", "id"=>$value["question_id"]), $question);
														if(!empty($question)){
															echo $question[0]["name"];
														}else{
															echo $value["recorded_question_text"];
														}
													?>
												</td>
											</tr>
											<tr>
												<td colspan="8" class="ui">
													<strong><?= al("answer"); ?>:</strong> <?= $value["question_answer"]; ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							<?php endif; ?>
							<?php if(!empty($langs)): ?>
							<table class="ui">
								<thead>
									<tr class="avoid-sort">	
										<th><?= al("language_from") ?></th>
										<th><?= al("language_to") ?></th>
										<th><?= al("rate") ?></th>
										<th><?= al("currency") ?></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($langs as $key => $lang_item): ?>
										<tr class="avoid-sort">
											<td>
												<?php if(!empty($lang_item["language_from"])){
													$language_from = "";
													if(is_numeric($lang_item["language_from"])){
														meta("S", array("template"=>"language", "id"=>$lang_item["language_from"]), $language_from);
														echo $language_from[0]["name"];
													}else{
														echo $lang_item["language_from"];
													}
												}else{
													echo "-";
												} ?>
											</td>
											<td>
												<?php if(!empty($lang_item["language_to"])){
													$language_to = "";
													if(is_numeric($lang_item["language_to"])){
														meta("S", array("template"=>"language", "id"=>$lang_item["language_to"]), $language_to);
														echo $language_to[0]["name"];
													}else{
														echo $lang_item["language_to"];
													}
												}else{
													echo "-";
												} ?>
											</td>
											<td>
												<?php if(!empty($lang_item["rate"])){
													echo $lang_item["rate"];
												}else{
													echo "-";
												} ?>
											</td>
											<td>
												<?php if(!empty($lang_item["rate"])){
													echo $lang_item["currency"];
												}else{
													echo "-";
												} ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php endif; ?>
						</td>
					<?php endif; ?>
				</tr>
				<?php endforeach;?>
			<?php endif;?>
		</tbody>	
	</table>

	<input type="hidden" name="action" value="" id="action">

	<div class="ui segment top">
		<button type="submit" class="ui button danger" data-ot="<?= al("INS_estate_remove") ?>" onClick="document.getElementById('action').value = 'remove';">
			<?= al("delete_highlighted") ?>
		</button>			
	</div>
</form>

					

<?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>