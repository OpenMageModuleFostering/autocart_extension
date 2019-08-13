<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Block_Autocart extends Mage_Core_Block_Template {

    protected function _beforeToHtml() {
        $this->_prepareCollection();
        return parent::_beforeToHtml();
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel("autocart/autocart")->getCollection();

        $collection->setOrder('id', 'ASC')
                ->load();
        $this->setAutocartRules($collection);
        return $this;
    }

}
