<?php
function event($cAction, $aParams, &$aResult) {
	switch($cAction) {
		case "S":
			$sWhere = " 1=1 ";
			$orderby = "id ASC";
			$limit = " ";
			if(!empty($aParams["id"]))		$sWhere .= "AND id = '".$aParams["id"]."' ";
			if(!empty($aParams["date"]))		$sWhere .= "AND mail = '".$aParams["mail"]."' ";
			if(!empty($aParams["user_id"]))		$sWhere .= "AND soc = '".$aParams["soc"]."' ";
			if(!empty($aParams["orderby"]))		$orderby = $aParams["orderby"];
			if(!empty($aParams["limit"]))		$limit .= "LIMIT ".$aParams["limit"]." ";
			
			$query = "SELECT ".
								"id, ".
								"date, ".
								"user_id, ".
								"action ".
							"FROM ".PREFIX."events ".
							"WHERE ".$sWhere." ".
							"ORDER BY $orderby ".
							$limit;
//echo $query;
			$rRes = mysql_query($query);
			
			if(mysql_num_rows($rRes) > 0) {
				while($row = mysql_fetch_assoc($rRes))
					$aResult[] = $row;
				return true;			
			}
		break;
		case "I":
			
			$params = '';
			if (!empty($aParams))
			{
				$i=0;
				foreach ($aParams as $key => $value)
				{
					if($i>0) $params.= ", ";
					$params.= $key." = '".mysql_real_escape_string($value)."'";
					$i++;
				}
			}
			mysql_query("INSERT INTO ".PREFIX."events SET ".$params);
			return true;
		break;
	}
	return false;
}
?>
