<?php

namespace Fyb\UseDefaultImages\Plugin;

use Fyb\UseDefaultImages\Block\Adminhtml\Product\DefaultImages;
use Magento\Catalog\Model\Product;

class ProductSave
{
    /**
     * @param Product $product
     *
     * @return void
     */
    public function afterBeforeSave(Product $product): void
    {
        if ($product->getCopyFromView()) {
            foreach (DefaultImages::IMAGE_ATTRIBUTES as $attribute) {
                $product->setData($attribute, null);
            }

            $product->setClearGallery(true);
        }
    }
}
