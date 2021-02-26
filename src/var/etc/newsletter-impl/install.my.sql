-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kmu-win.newsletter_impl_common_ci_article
CREATE TABLE IF NOT EXISTS `newsletter_impl_common_ci_article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description_html` text,
  `file_image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `link_label` varchar(255) DEFAULT NULL,
  `pic_pos` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kmu-win.newsletter_impl_common_ci_featured_article
CREATE TABLE IF NOT EXISTS `newsletter_impl_common_ci_featured_article` (
  `id` int(11) NOT NULL,
  `file_image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lead` varchar(500) DEFAULT NULL,
  `text_html` text,
  `link` varchar(255) DEFAULT NULL,
  `link_label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kmu-win.newsletter_impl_common_ci_image
CREATE TABLE IF NOT EXISTS `newsletter_impl_common_ci_image` (
  `id` int(11) NOT NULL,
  `file_image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kmu-win.newsletter_impl_common_ci_salutation
CREATE TABLE IF NOT EXISTS `newsletter_impl_common_ci_salutation` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kmu-win.newsletter_impl_common_ci_wysiwyg
CREATE TABLE IF NOT EXISTS `newsletter_impl_common_ci_wysiwyg` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text_html` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kmu-win.newsletter_impl_common_npc
CREATE TABLE IF NOT EXISTS `newsletter_impl_common_npc` (
  `id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle kmu-win.newsletter_impl_common_npc_recipient_categories
CREATE TABLE IF NOT EXISTS `newsletter_impl_common_npc_recipient_categories` (
  `newsletter_page_controller_id` int(10) unsigned NOT NULL,
  `recipient_category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`newsletter_page_controller_id`,`recipient_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `newsletter_impl_ci_subscription_form` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `newsletter_impl_ci_subscription_form_recipient_categories` (
  `ci_subscription_form_id` int(11) NOT NULL,
  `recipient_category_id` int(11) NOT NULL,
  PRIMARY KEY (`ci_subscription_form_id`,`recipient_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

