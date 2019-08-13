<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Block_Adminhtml_Autocart_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId("autocart_tabs");
        $this->setDestElementId("edit_form");
        $this->setTitle(Mage::helper("autocart")->__("Autocart Rule Information"));
    }

    protected function _beforeToHtml() {
        $this->addTab("form_section", array(
            "label" => Mage::helper("autocart")->__("Rule Information"),
            "title" => Mage::helper("autocart")->__("Rule Information"),
            "content" => $this->getLayout()->createBlock("autocart/adminhtml_autocart_edit_tab_form")->toHtml(),
        ));
        $this->addTab("form_section2", array(
            "label" => Mage::helper("autocart")->__("Conditions"),
            "title" => Mage::helper("autocart")->__("Conditions"),
            "content" => $this->getLayout()->createBlock("autocart/adminhtml_autocart_edit_tab_form2")->toHtml(),
        ));
        $this->addTab('form_section4', array(
            'label' => Mage::helper('autocart')->__('Products'),
            'title' => Mage::helper('autocart')->__('Products'),
            'url' => $this->getUrl('*/*/product', array('_current' => true)),
            'class' => 'ajax',
        ));
        $this->addTab("form_section3", array(
            "label" => Mage::helper("autocart")->__("Actions"),
            "title" => Mage::helper("autocart")->__("Actions"),
            "content" => $this->getLayout()->createBlock("autocart/adminhtml_autocart_edit_tab_form3")->toHtml(),
        ));
        return parent::_beforeToHtml();
    }

}
