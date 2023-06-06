<?php
/**
 * @author FYB Romania
 * @copyright Copyright © FYB Romania (https://fyb.ro). All rights reserved.
 */

namespace Fyb\UseDefaultImages\Plugin;

use Fyb\UseDefaultImages\Block\Adminhtml\Product\DefaultImages;
use Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\RequestInterface;

class ProductHelperDefaultGallery
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     */
    public function __construct(
        RequestInterface $request
    ) {
        $this->request = $request;
    }

    /**
     * @param Helper $subject
     * @param Product $result
     * @param Product $product
     *
     * @return Product
     */
    public function afterInitialize(Helper $subject, Product $result, Product $product)
    {
        $useDefaultGallery = ((array)$this->request->getPost('use_default', []));

        if (isset($useDefaultGallery['use_default_gallery']) && $useDefaultGallery['use_default_gallery']) {
            foreach (DefaultImages::IMAGE_ATTRIBUTES as $attribute) {
                $result->setData($attribute, null);
            }

            $result->setClearGallery(true);
        }
        return $result;
    }
}
