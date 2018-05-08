<?php
//Blog categories
if(meta("S",array("template"=>"blog_cat"),$data["blog_cats"]))
{
	/*
	foreach($data["blog_cats"] as $key => $val)
	{
		$data["blog_cats"][$key]["aliases"] =  explode(",",$val["alias_id"]);
		$data["blog_cats"][$key]["aliases"] =  implode("' OR id = '",$data["blog_cats"][$key]["aliases"]);
		meta("S",array("parent_id"=>$val["id"],"where"=>" 2=2 OR id = '".$data["blog_cats"][$key]["aliases"]."'"),$data["blog_cats"][$key]["posts"]);
	}
	*/
}
//out($data["blog_cats"]);

//Latest 2 posts
//$blog_latest_params["template"] = "blog_post";
//$blog_latest_params["limit"] = 2;
//$blog_latest_params["orderby"] = "date DESC";
//meta("S",$blog_latest_params,$data["blog_latest"]);
//out($data["blog_latest"]);

/*
meta("S",array("template"=>"blog_post","stats"=>1,"orderby"=>"stats DESC","limit"=>5),$data["popular_posts"]);
*/
//meta("S",array("template"=>"blog_author"),$data["blog_author"]);

//out($data["blog_cats"]);
$blog_params["template"]	= "blog_post";
$blog_params["orderby"]		= "date DESC";
$blog_params["where"]		= (!empty($blog_params["where"]) ? ($blog_params["where"]." AND ") : '')." hide_link <> 1";


meta("S",$blog_params,$data["blog"]);


?>