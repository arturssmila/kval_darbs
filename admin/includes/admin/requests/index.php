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
					$query = "SELECT file_path FROM request_files WHERE request_id = \"" . $value . "\"";
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

						$query = "DELETE FROM request_files WHERE request_id = \"" . $value . "\"";
						mysql_query($query);
					}
					$query = "DELETE FROM request_languages WHERE request_id = \"" . $value . "\"";
					mysql_query($query);
					$query = "DELETE FROM translation_requests WHERE id = \"" . $value . "\"";
					mysql_query($query);
				}
			}	
		    $Paginator  = new Paginator( "SELECT * FROM translation_requests ORDER BY created DESC" );		 
		    $requests = $Paginator->getData( $limit, $page );
		}	
		if(!empty($_POST["action"]) && $_POST["action"] == "mark_resolved"){
			foreach ($_POST as $key => $value) {
				if($key != "action"){
					$query = "UPDATE translation_requests SET resolved='1' WHERE id=" . $value;
					mysql_query($query);
				}
			}	
		    $Paginator  = new Paginator( "SELECT * FROM translation_requests ORDER BY created DESC" );		 
		    $requests = $Paginator->getData( $limit, $page );
		}
		/*if(!empty($_POST["action"]) && $_POST["action"] == "filter"){
			$query_elements = "";
			if(!empty($_POST["action"]["lang_from"]) || !empty($_POST["action"]["lang_to"]) || !empty($_POST["action"]["due_date"]) || !empty($_POST["action"]["sub"])){
				if(!empty($_POST["action"]["lang_from"]) || !empty($_POST["action"]["lang_to"])){
					$query = "SELECT * FROM translation_requests WHERE";
					foreach ($_POST as $key => $value) {
						if($key != "action"){
							switch($value){
								case "lang_from":
									$current_query = "SELECT * FROM request_languages WHERE lang_from=" . 
									if(!empty($query_elements)){
										$query_elements .= " AND date_due=" . $_POST["due_date"];
									}else{
										$query_elements .= " date_due=" . $_POST["due_date"];
									}
									break;
								case "lang_to":
									if(!empty($query_elements)){
										$query_elements .= " AND date_due=" . $_POST["due_date"];
									}else{
										$query_elements .= " date_due=" . $_POST["due_date"];
									}
									break;
								case "due_date":
									if(!empty($query_elements)){
										$query_elements .= " AND date_due=" . $_POST["due_date"];
									}else{
										$query_elements .= " date_due=" . $_POST["due_date"];
									}
									break;
								case "sub":
									if(!empty($query_elements)){
										$query_elements .= " AND created=" . $_POST["sub"];
									}else{
										$query_elements .= " created=" . $_POST["sub"];
									}
									break;
							}
						}
					}
				    $Paginator  = new Paginator( $query );
				    $requests = $Paginator->getData( $limit, $page );
				}else{
					$query = "SELECT * FROM translation_requests WHERE";
					foreach ($_POST as $key => $value) {
						if($key != "action"){
							switch($value){
								case "due_date":
									if(!empty($query_elements)){
										$query_elements .= " AND date_due=" . $_POST["due_date"];
									}else{
										$query_elements .= " date_due=" . $_POST["due_date"];
									}
									break;
								case "sub":
									if(!empty($query_elements)){
										$query_elements .= " AND created=" . $_POST["sub"];
									}else{
										$query_elements .= " created=" . $_POST["sub"];
									}
									break;
							}
						}
					}	
					$query .= $query_elements;
				    $Paginator  = new Paginator( $query );
				    $requests = $Paginator->getData( $limit, $page );
				}
			}else{
			    $Paginator  = new Paginator( "SELECT * FROM translation_requests ORDER BY created DESC" );		 
			    $requests = $Paginator->getData( $limit, $page );
			}
		}	*/
		reload();	
	}else{
	    $Paginator  = new Paginator( "SELECT * FROM translation_requests ORDER BY created DESC" );		 
	    $requests = $Paginator->getData( $limit, $page );
	}
?>

<div class="ui title flexy force">
	<?= al("requests") ?>
	<?php	/*<form>
		<select name="searchest" id="searchest" class="ui pull_left" style="display: inline-block;">
			<option value="" data=""></option>
			<option value="all_buildings" data="">Visas ēkas</option>
			<option value="1175"> Artilērijas iela 44 , Rīga </option>
				<option value="1176"> Avotu iela 68 , Rīga </option>
				<option value="1041"> Jelgava, 360 </option>
				<option value="1002"> Jelgava, Smilūu 280 </option>
		</select>
	</form> */ ?>

<?php	/*<div class="ui pull_right">
		<input class="ui search" placeholder="<?= al("search") ?>">
	</div> */ ?>
</div>

<form method="post" id="requests">
	<table class="ui sortable">
		<thead>
			<tr>
				<th style="width: 20px"><?= al("id") ?></th>
				<th><?= al("vards") ?></th>
				<th><?= al("uzvards") ?></th>
				<th><?= al("email") ?></th>
				<th><?= al("phone") ?></th>
				<th><?= al("due_date") ?></th>
				<th><?= al("number_of_files") ?></th>
				<th><?= al("resolved") ?></th>
				<th><?= al("submitted") ?></th>
			</tr>
		</thead>
		<tbody>
			<?php if(!empty($requests)):?>
				<?php foreach ($requests->data as $i): ?>
					<?php
						$langs = array();
						$query = "SELECT * FROM request_languages WHERE request_id = '" . $i["id"] . "'";
						$res = mysql_query($query);
						if(mysql_num_rows($res) > 0)
						{
							while($row = mysql_fetch_assoc($res))
							{
								$langs[] = $row;
							}
						}

						$no_lang_files = array();
						$lang_files = array();
						$query = "SELECT * FROM request_files WHERE request_id = '" . $i["id"] . "'";
						$res = mysql_query($query);
						if(mysql_num_rows($res) > 0)
						{
							while($row = mysql_fetch_assoc($res))
							{	
								if(empty($row["languages_id"])){
									$no_lang_files[] = $row;
								}else{
									$lang_files[] = $row;
								}
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
							<?php if(!empty($i["phone"]) && !empty($i["phone"])){
								echo $i["phone"];
							}else{
								echo "-";
							} ?>
						</td>
						<td>	
							<?php if(!empty($i["date_due"]) && !empty($i["time_due"])){
								echo $i["date_due"] . " " . $i["time_due"];
							}else if(!empty($i["date_due"])){
								echo $i["date_due"];
							}else{
								echo "-";
							} ?>
						</td>
						<td>
							<?= mysql_num_rows($res) ?>
						</td>
							<?php if($i["resolved"] == 0){
								echo "<td style=\"background-color: rgb(239,95,81)\">";
									echo al("nope");
								echo "</td>";
							}else{
								echo "<td style=\"background-color: rgb(66,206,80)\">";
									echo al("yes");
								echo "</td>";
							} ?>
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
					<?php if ((!empty($langs)) || (!empty($lang_files)) || (!empty($no_lang_files)) || (!empty($i["comment_text"]))): ?>
						<td colspan="9" class="ui no_padding">
							<?php if(!empty($i["comment_text"])): ?>
								<table style="width: 100%">
									<thead>
										<th> <?= al("comment") ?></th>
									</thead>
									<tbody>
										<tr>
											<td colspan="8" class="ui">
												<?= $i["comment_text"] ?>
											</td>
										</tr>
									</tbody>
								</table>
							<?php endif; ?>
							<?php if(!empty($langs)): ?>
							<table class="ui">
								<thead>
									<tr class="avoid-sort">	
										<th><?= al("language_from") ?></th>
										<th><?= al("language_to") ?></th>
										<th><?= al("files") ?></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($langs as $key => $lang_item): ?>
										<tr class="avoid-sort">
											<td>
												<?php if(!empty($lang_item["lang_from"])){
													$language_from = "";
													meta("S", array("template"=>"language", "id"=>$lang_item["lang_from"]), $language_from);
													if(!empty($language_from[0])){
														echo $language_from[0]["name"];
													}else{
														echo "-";
													}
												}else{
													echo "-";
												} ?>
											</td>
											<td>
												<?php if(!empty($lang_item["lang_to"])){
													$exploded_langs = explode(",",$lang_item["lang_to"]);
													for( $n = 0; $n < count($exploded_langs); $n++){
														meta("S", array("template"=>"language", "id"=>$exploded_langs[$n]), $data["lang_to"]);
														echo $data["lang_to"][0]["name"];
														if($n != (count($exploded_langs) - 1)){
															echo ", ";
														}
													}
													
												}else{
													echo "-";
												} ?>
											</td>
											<td>
												<?php if(!empty($label)){
													unset($label);
												} ?>
												<?php
													foreach ($lang_files as $ii){
														if($ii["languages_id"] == $lang_item["id"]){
															$exploded = explode("/", $ii["file_path"]);
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
															echo("<a target=\"_blank\" style=\"display: block\" href=\"$label\">" . $ii["file_name"] . "</a>");
															echo " ";
														}
													}
												?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php endif; ?>
							<?php if(!empty($no_lang_files)): ?>
								<table style="width: 100%">
									<thead>
										<tr class="avoid-sort">	
											<th colspan="8">files without language pairs</th>
										</tr>
									</thead>
									<tbody>
										<tr class="avoid-sort">
											<td>
												<?php foreach ($no_lang_files as $key => $file_item): ?>
													<?php if(!empty($label)){
														unset($label);
													} ?>
													<?php
														$exploded = explode("/", $file_item["file_path"]);
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
														echo("<a target=\"_blank\" style=\"display: block\" href=\"$label\">" . $file_item["file_name"] . "</a>");
														echo " ";
													?>
												<?php endforeach; ?>
											</td>
										</tr>
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
		<button type="submit" class="ui button primary" onClick="document.getElementById('action').value = 'mark_resolved';">
			<?= al("mark_resolved") ?>
		</button>
			
	</div>
</form>

					

<?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>