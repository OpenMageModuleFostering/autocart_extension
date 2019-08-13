<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Block_Adminhtml_Autocart_Edit_Tab_Form3 extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset("autocart_form", array("legend" => Mage::helper("autocart")->__("Condition")));
        $_saveUrl = Mage::helper("adminhtml")->getUrl("adminhtml/promo_quote/new");
        $addRule = "editForm.submit($('edit_form').action+'back/edit/');window.setLocation('$_saveUrl')";
        $fieldset->addField('some_field', 'hidden', array(
            'after_element_html' => '<button type="button" onclick="' . $addRule . '">Save & Create Shopping Cart Price Rule</button>',
            'popup' => true
        ));
    }

}
