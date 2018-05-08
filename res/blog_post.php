<?php
mysql_query("INSERT INTO ".PREFIX."stats SET meta_id = '".$data["cat"][0]["id"]."'");
include("blog_queries.php");
//Latest 2 posts
$blog_latest_params["template"] = "blog_post";
$blog_latest_params["limit"] = 8;
$blog_latest_params["orderby"] = "date DESC";
meta("S",$blog_latest_params,$data["blog_latest"]);
//out($data["blog_latest"]);

if(meta("S",array("template"=>"blog_post","stats"=>1,"orderby"=>"stats DESC","limit"=>3),$data["popular_posts"]))
{
	foreach($data["popular_posts"] as $key => $val)
	{
		$data["popular_posts"][$key]["url"] = get_product_url($val["url"]);
	}
}
//meta("S",array("template"=>"blog_author"),$data["blog_author"]);

//out($data["blog_cats"]);


?>