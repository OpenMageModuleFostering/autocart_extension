<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Block_Adminhtml_Autocart_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('autocartGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $this->setCollection(Mage::getModel('autocart/autocart')->getCollection());

        return parent::_prepareCollection();
    }
 /**
  * 
  * @return type
  */
    protected function _prepareColumns() {

        $this->addColumn('id', array(
            'header' => Mage::helper('autocart')->__('Id'),
            'align' => 'left',
            'index' => 'id',
        ));

        $this->addColumn('rule_name', array(
            'header' => Mage::helper('autocart')->__('Rule Name'),
            'align' => 'left',
            'index' => 'rule_name',
        ));
        $this->addColumn('is_active', array(
            'header' => Mage::helper('autocart')->__('Status'),
            'align' => 'left',
            'type' => 'options',
            'options' => array(
                0 => 'Inactive',
                1 => 'Active',
            ),
            'index' => 'is_active',
        ));
        $this->addColumn('update_time', array(
            'header' => Mage::helper('autocart')->__('Last Updated'),
            'align' => 'left',
            'index' => 'update_time',
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('autocart')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('autocart')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('autocart')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('autocart')->__('Are you sure?')
        ));

        $statuses = array(
                0 => 'Inactive',
                1 => 'Active'
            );

        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('autocart')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'is_active',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('autocart')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }
}
