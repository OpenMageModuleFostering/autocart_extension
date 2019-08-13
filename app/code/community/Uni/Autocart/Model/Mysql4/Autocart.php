<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Model_Mysql4_Autocart extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('autocart/autocart', 'id');
    }

}
