<?php
function template($cAction, $aParams, &$aResult)
{
	$aResult = Array();
	switch($cAction) {
		case "S":
			$where = " 1 = 1 ";
			$limit = " LIMIT 1 ";
			
			if(!empty($aParams["id"]))		$where .= "AND t_id = '".$aParams["id"]."' ";
			if(isset($aParams["parent_id"]))	$where .= "AND t_p_id = '".$aParams["parent_id"]."' ";
			if(isset($aParams["template"]))		$where .= "AND template = '".$aParams["template"]."' ";
			
			if(!empty($aParams["where"]))		$where .= "AND ".$aParams["where"]." ";
			if(!empty($aParams["limit"]))		$limit .= "LIMIT ".$aParams["limit"]." ";
			
			$query = "SELECT ".
								"t_id AS id, ".
								"t_p_id AS parent_id, ".
								"template, ".
								"template_name ". 
							"FROM ".PREFIX."templates ".
							"WHERE ".$where." ".
							$limit;
//echo ++$gg."<br />";
if(!empty($aParams["alert"])) echo "<br /><br />".$query."<br /><br />";
//print_r($aParams);
			$rRes = mysql_query($query) or die(mysql_error().$query);
			
			if(mysql_num_rows($rRes) > 0)
			{
				while($row = mysql_fetch_assoc($rRes))
				{
					if (empty($row["template"])) break;
					$aResult[] = $row;
				}
				return true;			
			}
		break;
	}
	return false;
}
?>
