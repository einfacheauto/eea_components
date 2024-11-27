CREATE TABLE tx_eeacomponents_domain_model_calculator (
  uid int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pid int(10) UNSIGNED NOT NULL DEFAULT 0,
  tstamp int(10) UNSIGNED NOT NULL DEFAULT 0,
  crdate int(10) UNSIGNED NOT NULL DEFAULT 0,
  deleted smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  hidden smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  starttime int(10) UNSIGNED NOT NULL DEFAULT 0,
  endtime int(10) UNSIGNED NOT NULL DEFAULT 0,
  sys_language_uid int(11) NOT NULL DEFAULT 0,
  l10n_parent int(10) UNSIGNED NOT NULL DEFAULT 0,
  l10n_state text DEFAULT NULL,
  l10n_diffsource mediumblob DEFAULT NULL,
  t3ver_oid int(10) UNSIGNED NOT NULL DEFAULT 0,
  t3ver_wsid int(10) UNSIGNED NOT NULL DEFAULT 0,
  t3ver_state smallint(6) NOT NULL DEFAULT 0,
  t3ver_stage int(11) NOT NULL DEFAULT 0,
  customerid varchar(255) NOT NULL DEFAULT '',
  KEY parent (pid,deleted,hidden),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE tx_eeacomponents_domain_model_productfinder (
  uid int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pid int(10) UNSIGNED NOT NULL DEFAULT 0,
  tstamp int(10) UNSIGNED NOT NULL DEFAULT 0,
  crdate int(10) UNSIGNED NOT NULL DEFAULT 0,
  deleted smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  hidden smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  starttime int(10) UNSIGNED NOT NULL DEFAULT 0,
  endtime int(10) UNSIGNED NOT NULL DEFAULT 0,
  sys_language_uid int(11) NOT NULL DEFAULT 0,
  l10n_parent int(10) UNSIGNED NOT NULL DEFAULT 0,
  l10n_state text DEFAULT NULL,
  l10n_diffsource mediumblob DEFAULT NULL,
  t3ver_oid int(10) UNSIGNED NOT NULL DEFAULT 0,
  t3ver_wsid int(10) UNSIGNED NOT NULL DEFAULT 0,
  t3ver_state smallint(6) NOT NULL DEFAULT 0,
  t3ver_stage int(11) NOT NULL DEFAULT 0,
  customerid varchar(255) NOT NULL DEFAULT '',
  KEY parent (pid,deleted,hidden),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE=utf8mb4_unicode_ci;