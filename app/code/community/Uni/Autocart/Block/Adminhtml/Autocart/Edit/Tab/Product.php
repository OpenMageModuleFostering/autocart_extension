<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Block_Adminhtml_Autocart_Edit_Tab_Product extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('productGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('product_filter');
    }

    protected function _addColumnFilterToCollection($column) {
        if ($column->getId() == 'in_category') {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in' => $productIds));
            } elseif (!empty($productIds)) {
                $this->getCollection()->addFieldToFilter('entity_id', array('nin' => $productIds));
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    protected function _prepareCollection() {

        $collection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect('sku')
                ->addAttributeToSelect('name')
                ->addAttributeToSelect('attribute_set_id')
                ->addAttributeToSelect('type_id')
                ->addAttributeToFilter('type_id', 'simple')
                ->addAttributeToFilter('status', 1);
        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);
        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns() {
        $paramId = $this->getRequest()->getParam('id');
        $autocartCollection = Mage::getModel('autocart/autocart')->getCollection()
                ->addFieldToFilter('id', $paramId);
        $data = $autocartCollection->getData();
        $idArray = explode(',', $data[0]['product_ids']);
        $this->addColumn('in_category', array(
            'header_css_class' => 'a-center',
            'type' => 'checkbox',
            'values' => $idArray,
            'align' => 'center',
            'index' => 'entity_id',
            'name' => 'in_category',
            'field_name' => 'product_ids[]'
        ));

        $this->addColumn('entity_id', array(
            'header' => Mage::helper('catalog')->__('ID'),
            'width' => '50px',
            'type' => 'number',
            'index' => 'entity_id',
        ));
        $this->addColumn('name', array(
            'header' => Mage::helper('catalog')->__('Name'),
            'index' => 'name',
        ));
        $this->addColumn('type', array(
            'header' => Mage::helper('catalog')->__('Type'),
            'width' => '60px',
            'index' => 'type_id',
            'type' => 'options',
            'options' => Mage::getSingleton('catalog/product_type')->getOptionArray(),
        ));
        $this->addColumn('sku', array(
            'header' => Mage::helper('catalog')->__('SKU'),
            'width' => '80px',
            'index' => 'sku',
        ));

        if (Mage::helper('catalog')->isModuleEnabled('Mage_Rss')) {
            $this->addRssList('rss/catalog/notifystock', Mage::helper('catalog')->__('Notify Low Stock RSS'));
        }

        return parent::_prepareColumns();
    }

    public function getGridUrl() {
        return $this->_getData('grid_url') ? $this->_getData('grid_url') : $this->getUrl('*/*/productgrid', array('_current' => true));
    }

    protected function _getProductIds() {
        $products = $this->getRequest()->getPost('product_ids');
        if (is_null($products)) {
            return array_keys($products);
        }
        return $products;
    }

}
