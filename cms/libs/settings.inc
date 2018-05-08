<?php
$settings = array();
$query = "SELECT ".
		"* ". 
	"FROM ".PREFIX."settings ".
	"ORDER BY name ";

$rRes = mysql_query($query) or die(mysql_error().$query);

if(mysql_num_rows($rRes) > 0)
{
	while($row = mysql_fetch_assoc($rRes))
	{
		if (empty($row["name"])) break;
		$settings[$row["name"]] = $row["value"];
	}			
}


$settings["draugiem_redirect"]	=	"http".(!empty($_SERVER['HTTPS']) ? "s" : '')."://".$_SERVER['HTTP_HOST']."/cms/libs/dr.php";
$settings["draugiem_hash"]	=	md5((!empty($settings["draugiem_api"]) ? $settings["draugiem_api"] : '').$settings["draugiem_redirect"]);

$settings["anal_code"] = '';
if(!empty($settings["google_analytics_code"]))
{
	$anal_host = $_SERVER['HTTP_HOST'];
	$anal_code = str_split($settings["google_analytics_code"]);
	$anal_code = implode($anal_host,$anal_code);
	
	$settings["anal_code"] = '
		<script type="text/javascript">'."
			var google_analytics_code = '".$anal_code."';
			var anal_host = '".$anal_host."';
			google_analytics_code = google_analytics_code.replace(/".$anal_host."/gi, '');
			
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			ga('create', google_analytics_code, 'auto');
			ga('send', 'pageview');
			
		</script>";
}

$settings["googletagmanager"] = '';
if(!empty($settings["google_tag_manager_code"]))
{
	$settings["googletagmanager"] = '
			<script type="text/javascript">'."
				(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','".$settings["google_tag_manager_code"]."');".'
			</script>
			<noscript>
				<iframe
					src="https://www.googletagmanager.com/ns.html?id='.$settings["google_tag_manager_code"].'"
					height="0" width="0"
					style="display:none;visibility:hidden"></iframe>
			</noscript>
		';
}
?>