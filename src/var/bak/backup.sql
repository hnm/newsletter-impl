-- Mysql Backup of mdl_newsletter
-- Date 2019-06-24T12:13:41+02:00
-- Backup by 

DROP TABLE IF EXISTS `bstmpl_contact_page_controller`;
CREATE TABLE `bstmpl_contact_page_controller` ( 
	`id` INT NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `bstmpl_default_page_controller`;
CREATE TABLE `bstmpl_default_page_controller` ( 
	`id` INT NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `bstmpl_default_page_controller` (`id`) 
VALUES ( '3');

DROP TABLE IF EXISTS `bstmpl_start_page_controller`;
CREATE TABLE `bstmpl_start_page_controller` ( 
	`id` INT NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE `newsletter` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`subject` VARCHAR(255) NULL, 
	`preview_text` VARCHAR(80) NULL, 
	`n2n_locale` VARCHAR(12) NULL, 
	`sent` TINYINT UNSIGNED NULL, 
	`created` DATETIME NULL, 
	`created_by` VARCHAR(255) NULL, 
	`last_mod` DATETIME NULL, 
	`last_mod_by` VARCHAR(255) NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_blacklisted`;
CREATE TABLE `newsletter_blacklisted` ( 
	`email` VARCHAR(255) NOT NULL, 
	`created` DATETIME NULL, 
	PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_ci`;
CREATE TABLE `newsletter_ci` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`order_index` INT UNSIGNED NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_history`;
CREATE TABLE `newsletter_history` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`newsletter_id` INT UNSIGNED NULL, 
	`prepared_date` DATETIME NULL, 
	`newsletter_html` TEXT NULL, 
	`newsletter_text` TEXT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `newsletter_history` ADD INDEX `newsletter_history_index_1` (`newsletter_id`);


DROP TABLE IF EXISTS `newsletter_history_entry`;
CREATE TABLE `newsletter_history_entry` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`email` VARCHAR(255) NULL, 
	`status` ENUM('prepared','in-progress','sent','read','error') NULL, 
	`code` VARCHAR(255) NULL, 
	`status_message` VARCHAR(255) NULL, 
	`sent_date` DATETIME NULL, 
	`history_id` INT UNSIGNED NULL, 
	`salutation` VARCHAR(255) NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `newsletter_history_entry` ADD INDEX `newsletter_history_entry_index_1` (`history_id`);


DROP TABLE IF EXISTS `newsletter_history_link`;
CREATE TABLE `newsletter_history_link` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`history_id` INT UNSIGNED NULL, 
	`link` TEXT NULL, 
	`newsletter_ci_id` INT UNSIGNED NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `newsletter_history_link` ADD INDEX `newsletter_history_link_index_1` (`history_id`);
ALTER TABLE `newsletter_history_link` ADD INDEX `newsletter_history_link_index_2` (`newsletter_ci_id`);


DROP TABLE IF EXISTS `newsletter_history_link_click`;
CREATE TABLE `newsletter_history_link_click` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`history_entry_id` INT UNSIGNED NULL, 
	`history_link_id` INT UNSIGNED NULL, 
	`recipient_id` INT UNSIGNED NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `newsletter_history_link_click` ADD INDEX `newsletter_history_link_click_index_1` (`history_entry_id`);
ALTER TABLE `newsletter_history_link_click` ADD INDEX `newsletter_history_link_click_index_2` (`history_link_id`);
ALTER TABLE `newsletter_history_link_click` ADD INDEX `newsletter_history_link_click_index_3` (`recipient_id`);


DROP TABLE IF EXISTS `newsletter_impl_ci_subscription_form`;
CREATE TABLE `newsletter_impl_ci_subscription_form` ( 
	`id` INT NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci ;

INSERT INTO `newsletter_impl_ci_subscription_form` (`id`) 
VALUES ( '1');

DROP TABLE IF EXISTS `newsletter_impl_ci_subscription_form_recipient_categories`;
CREATE TABLE `newsletter_impl_ci_subscription_form_recipient_categories` ( 
	`ci_subscription_form_id` INT NOT NULL, 
	`recipient_category_id` INT NOT NULL, 
	PRIMARY KEY (`ci_subscription_form_id`, `recipient_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci ;


DROP TABLE IF EXISTS `newsletter_impl_common_ci_article`;
CREATE TABLE `newsletter_impl_common_ci_article` ( 
	`id` INT NOT NULL, 
	`title` VARCHAR(255) NULL, 
	`description_html` TEXT NULL, 
	`file_image` VARCHAR(255) NULL, 
	`link` VARCHAR(255) NULL, 
	`link_label` VARCHAR(255) NULL, 
	`pic_pos` VARCHAR(255) NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_impl_common_ci_featured_article`;
CREATE TABLE `newsletter_impl_common_ci_featured_article` ( 
	`id` INT NOT NULL, 
	`file_image` VARCHAR(255) NULL, 
	`title` VARCHAR(255) NULL, 
	`lead` VARCHAR(500) NULL, 
	`text_html` TEXT NULL, 
	`link` VARCHAR(255) NULL, 
	`link_label` VARCHAR(255) NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_impl_common_ci_image`;
CREATE TABLE `newsletter_impl_common_ci_image` ( 
	`id` INT NOT NULL, 
	`file_image` VARCHAR(255) NULL, 
	`link` VARCHAR(255) NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_impl_common_ci_salutation`;
CREATE TABLE `newsletter_impl_common_ci_salutation` ( 
	`id` INT NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_impl_common_ci_wysiwyg`;
CREATE TABLE `newsletter_impl_common_ci_wysiwyg` ( 
	`id` INT NOT NULL, 
	`title` VARCHAR(255) NULL, 
	`text_html` TEXT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_impl_common_npc`;
CREATE TABLE `newsletter_impl_common_npc` ( 
	`id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_impl_common_npc_recipient_categories`;
CREATE TABLE `newsletter_impl_common_npc_recipient_categories` ( 
	`newsletter_page_controller_id` INT UNSIGNED NOT NULL, 
	`recipient_category_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`newsletter_page_controller_id`, `recipient_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_newsletter_cis`;
CREATE TABLE `newsletter_newsletter_cis` ( 
	`newsletter_id` INT UNSIGNED NOT NULL, 
	`newsletter_ci_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`newsletter_id`, `newsletter_ci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_recipient`;
CREATE TABLE `newsletter_recipient` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`email` VARCHAR(255) NULL, 
	`first_name` VARCHAR(255) NULL, 
	`last_name` VARCHAR(255) NULL, 
	`gender` VARCHAR(255) NULL, 
	`status` VARCHAR(255) NULL, 
	`salute_with` VARCHAR(255) NULL, 
	`confirmation_code` VARCHAR(255) NULL, 
	`n2n_locale` VARCHAR(12) NULL, 
	`last_mod` DATETIME NULL, 
	`last_mod_by` VARCHAR(255) NULL, 
	`created` DATETIME NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_recipient_categories`;
CREATE TABLE `newsletter_recipient_categories` ( 
	`newsletter_id` INT UNSIGNED NOT NULL, 
	`recipient_category_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`newsletter_id`, `recipient_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_recipient_category`;
CREATE TABLE `newsletter_recipient_category` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`name` VARCHAR(255) NULL, 
	`lft` INT UNSIGNED NULL, 
	`rgt` INT UNSIGNED NULL, 
	`last_mod` DATETIME NULL, 
	`last_mod_by` VARCHAR(255) NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_recipient_history_entry_clicks`;
CREATE TABLE `newsletter_recipient_history_entry_clicks` ( 
	`recipient_id` INT UNSIGNED NOT NULL, 
	`history_link_click_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`recipient_id`, `history_link_click_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `newsletter_recipient_recipient_categories`;
CREATE TABLE `newsletter_recipient_recipient_categories` ( 
	`recipient_id` INT UNSIGNED NOT NULL, 
	`recipient_category_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`recipient_id`, `recipient_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`internal_page_id` INT UNSIGNED NULL, 
	`external_url` VARCHAR(255) NULL, 
	`page_content_id` INT UNSIGNED NULL, 
	`subsystem_name` VARCHAR(255) NULL, 
	`online` TINYINT UNSIGNED NOT NULL DEFAULT '1', 
	`in_path` TINYINT NOT NULL DEFAULT '1', 
	`hook_key` VARCHAR(255) NULL, 
	`in_navigation` TINYINT NOT NULL DEFAULT '1', 
	`nav_target_new_window` TINYINT NOT NULL DEFAULT '0', 
	`lft` INT UNSIGNED NOT NULL, 
	`rgt` INT UNSIGNED NOT NULL, 
	`last_mod` DATETIME NULL, 
	`last_mod_by` INT UNSIGNED NULL, 
	`indexable` TINYINT UNSIGNED NOT NULL DEFAULT '1', 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `page` (`id`, `internal_page_id`, `external_url`, `page_content_id`, `subsystem_name`, `online`, `in_path`, `hook_key`, `in_navigation`, `nav_target_new_window`, `lft`, `rgt`, `last_mod`, `last_mod_by`, `indexable`) 
VALUES ( '1',  NULL,  NULL,  '1',  NULL,  '1',  '1',  NULL,  '1',  '0',  '1',  '2',  '2019-06-24 11:29:22',  NULL,  '1');

DROP TABLE IF EXISTS `page_content`;
CREATE TABLE `page_content` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`subsystem_name` VARCHAR(255) NULL, 
	`page_controller_id` INT UNSIGNED NOT NULL, 
	`page_id` INT UNSIGNED NULL, 
	`ssl` TINYINT UNSIGNED NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `page_content` (`id`, `subsystem_name`, `page_controller_id`, `page_id`, `ssl`) 
VALUES ( '1',  NULL,  '3',  NULL,  '0');

DROP TABLE IF EXISTS `page_content_t`;
CREATE TABLE `page_content_t` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`n2n_locale` VARCHAR(5) NOT NULL, 
	`se_title` VARCHAR(255) NULL, 
	`se_description` VARCHAR(500) NULL, 
	`se_keywords` VARCHAR(255) NULL, 
	`page_content_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `page_content_t` ADD UNIQUE INDEX `page_content_id_n2n_locale` (`page_content_id`, `n2n_locale`);

INSERT INTO `page_content_t` (`id`, `n2n_locale`, `se_title`, `se_description`, `se_keywords`, `page_content_id`) 
VALUES ( '1',  'de_CH',  NULL,  NULL,  NULL,  '1');

DROP TABLE IF EXISTS `page_controller`;
CREATE TABLE `page_controller` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`method_name` VARCHAR(255) NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `page_controller` (`id`, `method_name`) 
VALUES ( '3',  'default');

DROP TABLE IF EXISTS `page_controller_t`;
CREATE TABLE `page_controller_t` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`n2n_locale` VARCHAR(16) NOT NULL, 
	`page_controller_id` VARCHAR(128) NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `page_controller_t` ADD UNIQUE INDEX `page_controller_id_n2n_locale` (`page_controller_id`, `n2n_locale`);

INSERT INTO `page_controller_t` (`id`, `n2n_locale`, `page_controller_id`) 
VALUES ( '1',  'de_CH',  '3');

DROP TABLE IF EXISTS `page_controller_t_content_items`;
CREATE TABLE `page_controller_t_content_items` ( 
	`page_controller_t_id` INT UNSIGNED NOT NULL, 
	`content_item_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`page_controller_t_id`, `content_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;

INSERT INTO `page_controller_t_content_items` (`page_controller_t_id`, `content_item_id`) 
VALUES ( '1',  '1');

DROP TABLE IF EXISTS `page_link`;
CREATE TABLE `page_link` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`type` VARCHAR(255) NULL, 
	`linked_page_id` INT UNSIGNED NULL, 
	`url` VARCHAR(255) NULL, 
	`label` VARCHAR(255) NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `page_link` ADD INDEX `page_link_index_1` (`linked_page_id`);


DROP TABLE IF EXISTS `page_t`;
CREATE TABLE `page_t` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`n2n_locale` VARCHAR(12) NULL, 
	`name` VARCHAR(255) NULL, 
	`title` VARCHAR(255) NULL, 
	`path_part` VARCHAR(255) NULL, 
	`page_id` INT UNSIGNED NULL, 
	`active` TINYINT UNSIGNED NOT NULL DEFAULT '1', 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `page_t` ADD INDEX `path_part` (`path_part`);
ALTER TABLE `page_t` ADD INDEX `page_leaf_t_index_1` (`page_id`);

INSERT INTO `page_t` (`id`, `n2n_locale`, `name`, `title`, `path_part`, `page_id`, `active`) 
VALUES ( '1',  'de_CH',  'holeradio',  NULL,  NULL,  '1',  '1');

DROP TABLE IF EXISTS `rocket_content_item`;
CREATE TABLE `rocket_content_item` ( 
	`id` INT NOT NULL AUTO_INCREMENT, 
	`panel` VARCHAR(32) NULL, 
	`order_index` INT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

INSERT INTO `rocket_content_item` (`id`, `panel`, `order_index`) 
VALUES ( '1',  'main',  '20');

DROP TABLE IF EXISTS `rocket_critmod_save`;
CREATE TABLE `rocket_critmod_save` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`ei_type_path` VARCHAR(255) NOT NULL, 
	`name` VARCHAR(255) NOT NULL, 
	`filter_data_json` TEXT NOT NULL, 
	`sort_data_json` TEXT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `rocket_critmod_save` ADD UNIQUE INDEX `name` (`name`);
ALTER TABLE `rocket_critmod_save` ADD INDEX `ei_spec_id` (`ei_type_path`);


DROP TABLE IF EXISTS `rocket_custom_grant`;
CREATE TABLE `rocket_custom_grant` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`custom_spec_id` VARCHAR(255) NOT NULL, 
	`rocket_user_group_id` INT UNSIGNED NOT NULL, 
	`full` TINYINT UNSIGNED NOT NULL DEFAULT '1', 
	`access_json` TEXT NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `rocket_custom_grant` ADD UNIQUE INDEX `script_id_user_group_id` (`custom_spec_id`, `rocket_user_group_id`);


DROP TABLE IF EXISTS `rocket_ei_grant`;
CREATE TABLE `rocket_ei_grant` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`ei_type_path` VARCHAR(255) NOT NULL, 
	`rocket_user_group_id` INT UNSIGNED NOT NULL, 
	`full` TINYINT UNSIGNED NOT NULL DEFAULT '1', 
	`access_json` TEXT NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `rocket_ei_grant` ADD UNIQUE INDEX `script_id_user_group_id` (`rocket_user_group_id`, `ei_type_path`);


DROP TABLE IF EXISTS `rocket_ei_grant_privileges`;
CREATE TABLE `rocket_ei_grant_privileges` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`ei_grant_id` INT UNSIGNED NOT NULL, 
	`ei_privilege_json` TEXT NOT NULL, 
	`restricted` TINYINT NOT NULL DEFAULT '0', 
	`restriction_group_json` TEXT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `rocket_login`;
CREATE TABLE `rocket_login` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`nick` VARCHAR(255) NULL, 
	`wrong_password` VARCHAR(255) NULL, 
	`power` ENUM('superadmin','admin','none') NULL, 
	`successfull` TINYINT UNSIGNED NOT NULL, 
	`ip` VARCHAR(255) NOT NULL DEFAULT '', 
	`date_time` DATETIME NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `rocket_user`;
CREATE TABLE `rocket_user` ( 
	`id` INT NOT NULL AUTO_INCREMENT, 
	`nick` VARCHAR(255) NOT NULL, 
	`firstname` VARCHAR(255) NULL, 
	`lastname` VARCHAR(255) NULL, 
	`email` VARCHAR(255) NULL, 
	`power` ENUM('superadmin','admin','none') NOT NULL DEFAULT 'none', 
	`password` VARCHAR(255) NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `rocket_user` ADD UNIQUE INDEX `nick` (`nick`);

INSERT INTO `rocket_user` (`id`, `nick`, `firstname`, `lastname`, `email`, `power`, `password`) 
VALUES ( '1',  'super',  'Testerich',  'von Testen',  'testerich@von-testen.com',  'superadmin',  '$2a$07$holeradioundholeradioe5FD29ANtu4PChE8W4mZDg.D1eKkBnwq');

DROP TABLE IF EXISTS `rocket_user_access_grant`;
CREATE TABLE `rocket_user_access_grant` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`script_id` VARCHAR(255) NOT NULL, 
	`restricted` TINYINT NOT NULL, 
	`privileges_json` TEXT NOT NULL, 
	`access_json` TEXT NOT NULL, 
	`restriction_json` TEXT NOT NULL, 
	`user_group_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;
ALTER TABLE `rocket_user_access_grant` ADD INDEX `user_group_id` (`user_group_id`);


DROP TABLE IF EXISTS `rocket_user_group`;
CREATE TABLE `rocket_user_group` ( 
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	`name` VARCHAR(64) NOT NULL, 
	`nav_json` TEXT NULL, 
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


DROP TABLE IF EXISTS `rocket_user_rocket_user_groups`;
CREATE TABLE `rocket_user_rocket_user_groups` ( 
	`rocket_user_id` INT UNSIGNED NOT NULL, 
	`rocket_user_group_id` INT UNSIGNED NOT NULL, 
	PRIMARY KEY (`rocket_user_id`, `rocket_user_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ;


