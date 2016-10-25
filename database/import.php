<?php
#IMPORT USERS FROM megamedia_old to new
/*
INSERT INTO `new_megamedia_eu`.`is_users` (id,name,email,created_at,updated_at) SELECT
`megamedia`.`users`.`id`,`megamedia`.`users`.`username` as name,`megamedia`.`users`.`email`,`megamedia`.`users`.`created_at`,`megamedia`.`users`.`updated_at`
FROM `megamedia`.`users` WHERE 1 GROUP BY `megamedia`.`users`.`email`
 */

/*
 * IMPORT CASTS
INSERT INTO `new_megamedia_eu`.`is_casts`(`id`, `name`, `created_at`, `updated_at`) SELECT
`megamedia`.`casts`.`id`,`megamedia`.`casts`.`name`,`megamedia`.`casts`.`created_at`,`megamedia`.`casts`.`updated_at`
FROM `megamedia`.`casts`
 */