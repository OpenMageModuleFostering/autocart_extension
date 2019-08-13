<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */


class Uni_Autocart_Block_Adminhtml_Autocart_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form(array(
            "id" => "edit_form",
            "action" => $this->getUrl("*/*/save", array("id" => $this->getRequest()->getParam("id"))),
            "method" => "post",
            "enctype" => "multipart/form-data",
                )
        );
        if (Mage::registry('autocart')) {
            $form->setValues(Mage::registry('autocart')->getData());
        }
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}
