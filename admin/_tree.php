<?php
if($cat1 > 0)
{
	echo '<img style="display:block;margin:auto;height:20px;" src="/cms/css/images/loading.gif" />';
}
else
{
	//lietotājs
	get_user("S",array("orderby"=>"id DESC","limit"=>1),$l_usr);
	
	
	//aktivitāte
	if(event("S",array("orderby"=>"id DESC","limit"=>1),$l_event))
	{
		if(!empty($l_event[0]["user_id"]))
		{
			if(get_user("S",array("id"=>$l_event[0]["user_id"]),$e_usr))
				$l_event[0]["user"] = (!empty($e_usr[0]["name"])||!empty($e_usr[0]["surname"]))?($e_usr[0]["name"]." ".$e_usr[0]["surname"]):$e_usr[0]["mail"];
		}
	}
	
	//Atvērtās sadaļas
	meta("S",array("where"=>"opened > 0"),$opened_pages);
	foreach($opened_pages as $opk => $opv)
	{
		get_user("S",array("id"=>$opv["opened"],"limit"=>1),$opened_pages[$opk]["opener"]);
	}
		
	?>
	<h1><?php echo al("sveiki"); ?>, <?php echo ($user[0]["name"] || $user[0]["surname"]) ? ($user[0]["name"]." ".$user[0]["surname"]) : $user[0]["mail"]; ?>!</h1>
	<h2><?php echo al("veiksmi_darba"); ?></h2>
	<table class="last_actions">
		<tr>
			<th><?php echo al("jaunakais_lietotajs"); ?></th>
			<td><?php echo get_short_date($l_usr[0]["registered"]).'</td>
			<td>/ <a href="/admin/user/'.$l_usr[0]["id"].'">'.((!empty($l_usr[0]["name"])||!empty($l_usr[0]["surname"]))?($l_usr[0]["name"]." ".$l_usr[0]["surname"]):$l_usr[0]["mail"])."</a>"; ?></td>
			<td>/ soc</td>
		</tr>
		<tr>
			<th><?php echo al("jaunaka_aktivitate"); ?></th>
			<td><?php echo get_short_date($l_event[0]["date"]).'</td>
			<td>/ <a href="/admin/user/'.$l_event[0]["user_id"].'">'.$l_event[0]["user"]."</a>"; ?></td>
			<td>/ <?php echo $l_event[0]["action"]; ?></td>
		</tr>
		
		<?php
		foreach($opened_pages as $opk => $opv)
		{
			?>
			<tr>
				<th><?php if($opk<1) echo al("atvertas_sadalas"); ?></th>
				<td><?php echo get_short_date($opv["opener"][0]["last_seen"]); ?></td>
				<td>/ <a href="/admin/user/<?php echo $opv["opener"][0]["id"]; ?>"><?php
					echo (
						(!empty($opv["opener"][0]["name"]) || !empty($opv["opener"][0]["surname"]) || !empty($opv["opener"][0]["company_name"]))
						?
						(
							($opv["opener"][0]["user_type"]=="F") ? ($opv["opener"][0]["name"]." ".$opv["opener"][0]["surname"]) : (!empty($opv["opener"][0]["company_name"]) ? $opv["opener"][0]["company_name"] : $opv["opener"][0]["mail"])
						)
						:
						$opv["opener"][0]["mail"]
						);
					?></a></td>
				<td>/ <a class="red" href="/admin/tree/<?php echo $opv["id"]; ?>"><?php echo $opv["name"]; ?> <small class="red">(<?php echo $opv["id"]; ?>)</small></a></td>
			</tr>
			<?php
		}
		?>
	</table>
	<img class="home" src="/cms/css/images/hello.jpg" style="max-height:600px;" />
<?php
}
?>