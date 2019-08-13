<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_Model_Observer {

    public function checkAutocart($observer) {
        $event = $observer->getEvent();
        $quote_item = $event->getQuoteItem();
        $_a = Mage::getSingleton('core/session')->getAutoFree();
        $cartModel = Mage::getModel('checkout/cart');
        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $_catCollection = $quote_item->getProduct()->getCategoryCollection();
        $_autoCartRuleCollection = Mage::getModel('autocart/autocart')->getCollection();

        foreach ($_catCollection as $_category):
            foreach ($_autoCartRuleCollection as $_autocartCol):
                if ($_autocartCol->getIsActive()) {
                    $_autoCat = explode(',', $_autocartCol->getCategoryIds());
                    if (in_array($_category->getId(), $_autoCat)) {
                        $_autoProducts = explode(',', $_autocartCol->getProductIds());
                        for ($i = 0; $i < count($_autoProducts); $i++):
                            if (is_numeric($_autoProducts[$i])) {
                                $_product = Mage::getModel('catalog/product')->load($_autoProducts[$i]);
                                $cartModel->init();
                                $stockItem = $_product->getStockItem();
                                if ($stockItem->getIsInStock()) {
                                    if (!$quote->hasProductId($_autoProducts[$i])) {
                                        $cartModel->addProduct($_product, array('qty' => 1));
                                    }
                                }
                            }
                        endfor;
                    }
                }
            endforeach;
        endforeach;
    }

}
