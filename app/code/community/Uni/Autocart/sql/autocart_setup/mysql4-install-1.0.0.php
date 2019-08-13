
<?php

/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('uni_autocart')};

CREATE TABLE {$this->getTable('uni_autocart')} (
  `id` bigint(20) NOT NULL primary key auto_increment,
  `rule_name` VARCHAR( 255 ) NOT NULL,
  `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL default '2',
  `category_ids` VARCHAR( 255 ) NOT NULL,
  `product_ids` VARCHAR( 2555 ) NOT NULL,
  `update_time` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup();
