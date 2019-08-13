<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Block_Adminhtml_Autocart_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset("autocart_form", array("legend" => Mage::helper("autocart")->__("Rule information")));

        $fieldset->addField("rule_name", "text", array(
            "label" => Mage::helper("autocart")->__("Rule Name"),
            "class" => "required-entry",
            "required" => true,
            "name" => "rule_name",
        ));

        $fieldset->addField("description", "textarea", array(
            "label" => Mage::helper("autocart")->__("Description"),
            "class" => "required-entry",
            "required" => true,
            "name" => "description",
        ));
        $fieldset->addField("is_active", "select", array(
            "label" => Mage::helper("autocart")->__("Is Active"),
            "class" => "required-entry",
            "required" => true,
            "values" => Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray(),
            "name" => "is_active",
        ));
        if (Mage::registry('autocart')) {
            $form->setValues(Mage::registry('autocart')->getData());
        }
    }

}
