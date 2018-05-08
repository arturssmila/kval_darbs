<?php 
//print_r($user); 
?>
<form action="/admin/profile_save.php" method="post" enctype="multipart/form-data">
	<table class="edit none" style="position:relative;">
		<tr>
			<th colspan="2" align="left"><?php echo al("profila_info"); ?></th>
		</tr>
		<tr>
			<td>ID</td>
			<td>
				<?php echo $user[0]["id"]; ?>
				<input type="hidden" name="id" value="<?php echo $user[0]["id"]; ?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo al("attels"); ?></td>
			<td>
				<?php if ($user[0]["image"]) { ?>
				<img src="<?php echo $user[0]["image"]; ?>" /><br />
				<?php } ?>
				<input name="uploadedfile" type="file" />
			</td>
		</tr>
		<tr>
			<td><?php echo al("e_pasts"); ?> / <?php echo al("lietotajvards"); ?></td>
			<td>
				<input type="text" name="mail" value="<?php echo $user[0]["mail"]; ?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo al("vards"); ?></td>
			<td>
				<input type="text" name="name" value="<?php echo $user[0]["name"]; ?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo al("uzvards"); ?></td>
			<td>
				<input type="text" name="surname" value="<?php echo $user[0]["surname"]; ?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo al("user_type"); ?></td>
			<td>
				<select name="admin">
									<option value="0"><?php echo al("netiek_paneli"); ?></option>
					<?php if(is_super_admin()) { ?>
									<option value="1" <?php echo ((!empty($user[0]["admin"]) && ($user[0]["admin"]==1)) ? "selected":""); ?>><?php echo al("super_admin"); ?></option>
					<?php } ?>
					<?php if(is_admin()) { ?>
									<option value="2" <?php echo ((!empty($user[0]["admin"]) && ($user[0]["admin"]==2)) ? "selected":""); ?>><?php echo al("admin"); ?></option>
					<?php } ?>
					<?php if(is_user()) { ?>
									<option value="3" <?php echo ((!empty($user[0]["admin"]) && ($user[0]["admin"]==3)) ? "selected":""); ?>><?php echo al("user"); ?></option>
					<?php } ?>
									<option value="4" <?php echo ((!empty($user[0]["admin"]) && ($user[0]["admin"]==4)) ? "selected":""); ?>><?php echo al("viewer"); ?></option>
				</select>
			</td>
		</tr>
		<tr>
				<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<th><?php echo al("sistemas_valoda"); ?></th>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td>
				<select name="admin_language">
				<?php
					foreach($languages as $key => $val)
					{
						echo '<option '.(($val["iso"]==$admin_lang)?'selected':'').' value="'.$val["iso"].'">'.$val["name"].' ('.$val["iso"].')</option>';
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
				<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
				<th colspan="2" align="left"><?php echo al("paroles_maina"); ?></th>
		</tr>
		<tr>
			<td><?php echo al("esosa_parole"); ?></td>
			<td>
				<input type="password" name="pasword_old" value="" />
			</td>
		</tr>
		<tr>
			<td><?php echo al("jauna_parole"); ?></td>
			<td>
				<input type="password" name="pasword" value="" />
			</td>
		</tr>
		<tr>
			<td><?php echo al("jauna_parole_velreiz"); ?></td>
			<td>
				<input type="password" name="password_new" value="" />
			</td>
		</tr>
		
	</table>
	<button type="submit" name="submit"><?php echo al("saglabat"); ?></button>
</form>
