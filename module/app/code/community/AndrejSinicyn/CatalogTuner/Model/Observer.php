<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category    AndrejSinicyn
 * @package     AndrejSinicyn_CatalogTuner
 * @copyright   Copyright (c) 2014 Andrej Sinicyn
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AndrejSinicyn_CatalogTuner_Model_Observer
{
    const XML_PATH_ADD_BREADCRUMBS   = 'catalog/tuning/add_catalog_breadcrumbs_to_product';

    public function onCatalogControllerProductInit(Varien_Event_Observer $observer)
    {
        if (Mage::getStoreConfig(self::XML_PATH_ADD_BREADCRUMBS) && !Mage::registry('current_category') && ($product = Mage::registry('current_product'))) {
            $productCategories = $product->getCategoryIds();
            if (count($productCategories) > 0) {
                // Assigning the first product category as current category if no category was set previously.
                $category = Mage::getModel('catalog/category')->load($productCategories[0]);
                $product->setCategory($category);
                Mage::register('current_category', $category);
            }
        }
    }
}
