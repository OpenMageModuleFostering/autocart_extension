<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Block_Adminhtml_Autocart extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_autocart';
        $this->_blockGroup = 'autocart';
        $this->_headerText = Mage::helper('autocart')->__('Manage Auto Add To Cart Rules');
        $this->_addButtonLabel = Mage::helper('autocart')->__('Add New Rule');
        parent::__construct();
    }

}
