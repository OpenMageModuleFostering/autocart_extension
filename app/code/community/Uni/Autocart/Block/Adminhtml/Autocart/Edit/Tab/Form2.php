<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Block_Adminhtml_Autocart_Edit_Tab_Form2 extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $afterElementHtml = '<p class="note"><span><b>' . ' If user add a product of this category then selected products from the next tab will add automatically.' . '</b></span></p>';
        $this->setForm($form);
        $fieldset = $form->addFieldset("autocart_form", array("legend" => Mage::helper("autocart")->__("Condition")));
        $fieldset->addField('category_ids', 'multiselect', array(
            'label' => 'Category',
            'class' => 'required-entry',
            'required' => true,
            'name' => 'category_ids',
            'values' => $this->get_categories(),
            'disabled' => false,
            'readonly' => false,
            'tabindex' => 5,
            'after_element_html' => $afterElementHtml
        ));
        $allCatIds='';
        $_ruleId=Mage::registry('autocart')->getId();
        $_currIds = Mage::registry('autocart')->getCategoryIds();
        $collection= Mage::getModel('autocart/autocart')->getCollection()
                     ->addFieldToSelect('category_ids')
                     ->addFieldToFilter('id',array('neq' => $_ruleId));
        foreach($collection as $col):
           $allCatIds.= $col->getCategoryIds();
           $allCatIds.= ',';
        endforeach;
        $arr_allCatIds=  explode(',', $allCatIds);
        $arr_currIds= explode(',', $_currIds);
        $result = array_intersect($arr_allCatIds, $arr_currIds);
        if(count($result)>0 && $collection->getSize()>0):
        $fieldset->addField('note', 'note', array(
            'text' => '<b style="color:red">Note: Some Categories in this rule are also used in another autocart rules.</b>'
        ));
        endif;
        if (Mage::registry('autocart')) {
            $form->setValues(Mage::registry('autocart')->getData());
        }
    }

    protected function get_categories() {

        $category = Mage::getModel('catalog/category');
        $tree = $category->getTreeModel();
        $tree->load();
        $ids = $tree->getCollection()->getAllIds();
        $arr = array();
        if ($ids) {
            foreach ($ids as $k => $id) {
                $cat = Mage::getModel('catalog/category');
                $cat->load($id);
                if ($cat->getId() > 3):
                    $arr[$k]['value'] = $cat->getId();
                    $arr[$k]['label'] = $cat->getName();
                endif;
            }
        }
        return $arr;
    }

}
