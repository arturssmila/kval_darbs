<?php
//HAVE TO ADD UPDATES IN THE END!!!

//2017.12.06
mysql_query("UPDATE `".PREFIX."meta` SET `date` = '2000-01-01 00:00:00' WHERE `date` = '0000-00-00 00:00:00';");

//2016.12.06
mysql_query("ALTER TABLE `".PREFIX."lang` CHANGE `name` `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;");
//2016.11.07
//refuse from level
mysql_query("ALTER TABLE `".PREFIX."meta` DROP `level`;");

//2016.10.12
mysql_query("ALTER TABLE `".PREFIX."users` CHANGE `password` `password` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;");

//2016.09.09
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'tree'			WHERE `name` = 'sadalas';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'users'			WHERE `name` = 'lietotaji';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'search'			WHERE `name` = 'meklet';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'profile'			WHERE `name` = 'mani_dati';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'languages'		WHERE `name` = 'valodas';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'language_file'		WHERE `name` = 'valodas_fails';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'adm_language_file'	WHERE `name` = 'adm_valodas_fails';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'templates'		WHERE `name` = 'sadalu_tipi';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'template_fields'		WHERE `name` = 'sadalu_tipu_laucini';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'activities'		WHERE `name` = 'aktivitates';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'images'			WHERE `name` = 'atteli';");
mysql_query("UPDATE `".PREFIX."adm_lang` SET `name` = 'updates'			WHERE `name` = 'atjaunosana';");

//2016.09.07
mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."user_types` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`type` varchar(30) DEFAULT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

mysql_query("ALTER TABLE `".PREFIX."user_types` ADD `permissions` LONGTEXT NULL DEFAULT NULL AFTER `type`;");

mysql_query("INSERT INTO ".PREFIX."user_types (id, type)
	SELECT * FROM (SELECT '1', 'super_admin') AS tmp
	WHERE NOT EXISTS (
		SELECT id FROM ".PREFIX."user_types WHERE `id` = '1' AND `type` = 'super_admin'
	) LIMIT 1;");

mysql_query("INSERT INTO ".PREFIX."user_types (id, type)
	SELECT * FROM (SELECT '2', 'admin') AS tmp
	WHERE NOT EXISTS (
		SELECT id FROM ".PREFIX."user_types WHERE `id` = '2' AND `type` = 'admin'
	) LIMIT 1;");

mysql_query("INSERT INTO ".PREFIX."user_types (id, type)
	SELECT * FROM (SELECT '3', 'user') AS tmp
	WHERE NOT EXISTS (
		SELECT id FROM ".PREFIX."user_types WHERE `id` = '3' AND `type` = 'user'
	) LIMIT 1;");

mysql_query("INSERT INTO ".PREFIX."user_types (id, type)
	SELECT * FROM (SELECT '4', 'viewer') AS tmp
	WHERE NOT EXISTS (
		SELECT id FROM ".PREFIX."user_types WHERE `id` = '4' AND `type` = 'viewer'
	) LIMIT 1;");

//2016.05.23
$query_ins = "INSERT INTO ".PREFIX."templates SET t_id = '0',t_p_id = '0',template = 'text',template_name = '-- Default page --'";
$query_up = "SELECT * FROM ".PREFIX."templates WHERE template = 'text'";
$res_up = mysql_query($query_up);
if(mysql_num_rows($res_up) > 0)
{
	if(mysql_num_rows($res_up)>1)
	{
		mysql_query("DELETE FROM ".PREFIX."templates WHERE template = 'text'");
		mysql_query($query_ins);
	}
	else
	{
		mysql_query("UPDATE `".PREFIX."templates` SET t_id = '0' WHERE template = 'text'");
	}
}
else
{
	mysql_query($query_ins);
}

//2016.04.26
mysql_query("ALTER TABLE `".PREFIX."fields` ADD `default_value` TEXT NULL DEFAULT NULL AFTER `field_type`");

//2016.04.01
mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."users_data` (
	`user_id` int(11) DEFAULT NULL,
	`name` varchar(255) DEFAULT NULL,
	`lang_id` int(11) NOT NULL,
	`value` text,
	KEY `name` (`name`),
	KEY `lang_id` (`lang_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

//2016.02.11
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'comment_date_format') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'comment_date_format'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'comment_approoving') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'comment_approoving'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'form_mail') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'form_mail'
	) LIMIT 1;");
//2015.07.24
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'draugiem_api') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'draugiem_api'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'draugiem_application_id') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'draugiem_application_id'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'draugiem_link') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'draugiem_link'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'facebook_application_id') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'facebook_application_id'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'facebook_application_secret') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'facebook_application_secret'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'facebook_link') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'facebook_link'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'google_analytics_code') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'google_analytics_code'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'google_tag_manager_code') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'google_tag_manager_code'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'google_link') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'google_link'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'google_client_id') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'google_client_id'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'google_client_secret') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'google_client_secret'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'twitter_consumer_key') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'twitter_consumer_key'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'twitter_consumer_secret') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'twitter_consumer_secret'
	) LIMIT 1;");
mysql_query("INSERT INTO ".PREFIX."settings (name)
	SELECT * FROM (SELECT 'twitter_link') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."settings WHERE name = 'twitter_link'
	) LIMIT 1;");

//2015.06.04
mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."languages_settings` (
	`name` varchar(50) NOT NULL,
	`value` varchar(50) DEFAULT NULL,
	UNIQUE KEY `name` (`name`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

mysql_query("INSERT INTO ".PREFIX."languages_settings (name, value)
	SELECT * FROM (SELECT 'lang_type', 'suffix') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."languages_settings WHERE name = 'lang_type'
	) LIMIT 1;");

mysql_query("INSERT INTO ".PREFIX."languages_settings (name, value)
	SELECT * FROM (SELECT 'lang_position', 'link') AS tmp
	WHERE NOT EXISTS (
		SELECT name FROM ".PREFIX."languages_settings WHERE name = 'lang_position'
	) LIMIT 1;");

//2015.04.--
mysql_query("ALTER TABLE  `".PREFIX."meta` CHANGE  `image`  `image` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL");
mysql_query("ALTER TABLE  `".PREFIX."meta` CHANGE  `image_big`  `image_big` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL");
mysql_query("ALTER TABLE  `".PREFIX."meta` CHANGE  `image_small`  `image_small` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL");
mysql_query("ALTER TABLE  `".PREFIX."meta` CHANGE  `image_thumb`  `image_thumb` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL");

//2015.03.26
mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."meta_images_data` (
	`img_id` int(11) NOT NULL,
	`lang_id` int(11) DEFAULT NULL,
	`name` varchar(255) DEFAULT NULL,
	`teaser` text,
	`alt` varchar(255) DEFAULT NULL,
	`title` varchar(255) DEFAULT NULL,
	KEY `img_id` (`img_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;");


//2014.11.21
mysql_query("ALTER TABLE `".PREFIX."meta_images`  ADD `ordered` INT NOT NULL DEFAULT '0' AFTER `meta_id`");

//2017.02.15
mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."linked_users` (
	`user_id` INT NULL DEFAULT NULL ,
	`linked_user` INT NULL DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

//2017.06.20
mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."password_resets` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`user_id` INT NULL ,
	`reset_code` INT NULL ,
	`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

//2014.11.21
mysql_query("ALTER TABLE `".PREFIX."password_resets` CHANGE `reset_code` `reset_code` VARCHAR(50) NULL DEFAULT NULL;");

//2017.07.11
mysql_query("ALTER TABLE `".PREFIX."meta_data` CHANGE `field_content` `field_content` LONGTEXT NULL DEFAULT NULL;");

//2017.08.29
mysql_query("ALTER TABLE `".PREFIX."backup` ADD `meta_id` INT NULL DEFAULT NULL AFTER `user_id`;");

//2017.09.01
mysql_query("ALTER TABLE  `".PREFIX."settings` CHANGE `value` `value` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;");

//2017.10.02
mysql_query("ALTER TABLE `".PREFIX."meta` ADD `deny_page` ENUM('1','0') NOT NULL DEFAULT '0' AFTER `hide_link`;");

//2018.02.28
mysql_query("ALTER TABLE `".PREFIX."lang` CHANGE `name` `name` VARCHAR(255) NULL DEFAULT NULL;");

//2018.04.05
mysql_query("ALTER TABLE `".PREFIX."users` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;");
mysql_query("ALTER TABLE `".PREFIX."users` CHANGE `mail` `mail` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '';");

//No date
mysql_query("ALTER TABLE `".PREFIX."fields` ADD `in_langs` INT(1) NOT NULL DEFAULT '1';");
mysql_query("ALTER TABLE `".PREFIX."fields` ADD `placeholder` TEXT NULL DEFAULT NULL AFTER `default_value`;");

//2018.04.06
mysql_query("ALTER TABLE `".PREFIX."fields` ADD `ordered` INT NOT NULL DEFAULT '0' AFTER `field_id`;");

?>