<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Block_Adminhtml_Autocart_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'autocart';
        $this->_controller = 'adminhtml_autocart';
        $this->_mode = 'edit';
        $this->_updateButton('save', 'label', Mage::helper('autocart')->__('Save Rule'));
        $this->_updateButton('delete', 'label', Mage::helper('autocart')->__('Delete Rule'));
        $this->_addButton("saveandcontinue", array(
            "label" => Mage::helper("autocart")->__("Save And Continue Edit"),
            "onclick" => "saveAndContinueEdit()",
            "class" => "save",
                ), -100);
        $this->_formScripts[] = "
                    function saveAndContinueEdit(){
                            editForm.submit($('edit_form').action+'back/edit/');
                    }
            ";
        $model = Mage::getModel('autocart/autocart')->load($this->getRequest()->getParam($this->_objectId));
        Mage::register('autocart', $model);
    }

    public function getHeaderText() {
        if (Mage::registry('autocart') && Mage::registry('autocart')->getId()) {
            return Mage::helper('autocart')->__('Edit Rule');
        } else {
            return Mage::helper('autocart')->__('Add Rule');
        }
    }

}
