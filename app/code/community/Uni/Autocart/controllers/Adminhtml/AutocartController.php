<?php

/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Adminhtml_AutocartController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout();
        $this->_setActiveMenu('autocart');
        $this->_addBreadcrumb(Mage::helper('autocart')->__('Autocarts'), Mage::helper('autocart')->__('Autocarts'));
    }

    public function indexAction() {
        $this->_initAction();
        $this->renderLayout();
    }

    /**
     * View edit form action
     */
    public function editAction() {
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('autocart/adminhtml_autocart_edit'))->_addLeft($this->getLayout()->createBlock("autocart/adminhtml_autocart_edit_tabs"));
        $this->renderLayout();
    }

    /**
     * View new form action
     */
    public function newAction() {
        $this->_forward('edit');
    }

    /**
     * Save form action
     */
    public function saveAction() {
        if ($this->getRequest()->getPost()) {

            try {

                $data = $this->getRequest()->getPost();
                $model = Mage::getModel('autocart/autocart');
                $products = $this->getRequest()->getPost('products', -1);
                if ($products != -1) {
                    $model->setProductIds(Mage::helper('adminhtml/js')->decodeGridSerializedInput($products));
                }

                $model->setData($data);
                $model->setWebsiteIds(implode(",", $data['website_ids']));
                $model->setCategoryIds(implode(",", $data['category_ids']));
                $model->setCustomerGroupIds(implode(",", $data['customer_group_ids']));
                $model->setProductIds(implode(",", $data['product_ids']));
                $model->setId($this->getRequest()->getParam('id'))->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('autocart')->__('Autocart rule was successfully saved'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        if ($this->getRequest()->getParam('back')) {
            $this->_redirect(
                    '*/*/edit', array(
                'id' => $model->getId(),
                    )
            );
            return;
        }
        $this->_redirect('*/*/');
    }

    /**
     * Delete action
     */
    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('autocart/autocart');
                $model->setId($this->getRequest()->getParam('id'))
                        ->delete();
                if (isset($x)):
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('autocart')->__('Autocart rule was successfully deleted'));
                endif;
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }

        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $entryIds = $this->getRequest()->getParam('id');
        if (!is_array($entryIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('autocart')->__('Please select entries.'));
        } else {
            try {
                $myModel = Mage::getModel('autocart/autocart');
                foreach ($entryIds as $entryId) {
                    $myModel->load($entryId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('autocart')->__(
                                'Total of %d record(s) were deleted.', count($entryIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
    
    public function massStatusAction() {
        $entryIds = $this->getRequest()->getParam('id');
        $isActive = $this->getRequest()->getParam('is_active');
        if (!is_array($entryIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('autocart')->__('Please select entries.'));
        } else {
            try {
                $myModel = Mage::getModel('autocart/autocart');
                foreach ($entryIds as $entryId) {
                    $myModel->load($entryId)->setIsActive($isActive);
                    $myModel->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('autocart')->__(
                                'Total of %d rules(s) were Updated.', count($entryIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('autocart');
    }

    public function productAction() {

        $this->loadLayout();
        $this->getLayout()->getBlock('product.grid')
                ->setProducts($this->getRequest()->getPost('products', null));
        $this->renderLayout();
    }

    public function productGridAction() {

        $this->loadLayout();
        $this->getLayout()->getBlock('product.grid')
                ->setProducts($this->getRequest()->getPost('products', null));
        $this->renderLayout();
    }

}
