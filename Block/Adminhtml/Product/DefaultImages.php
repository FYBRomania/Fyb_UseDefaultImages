<?php
/**
 * @author FYB Romania
 * @copyright Copyright © FYB Romania (https://fyb.ro). All rights reserved.
 */

namespace Fyb\UseDefaultImages\Block\Adminhtml\Product;

use Magento\Backend\Block\DataProviders\ImageUploadConfig as ImageUploadConfigDataProvider;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\MediaStorage\Helper\File\Storage\Database;

class DefaultImages extends \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery\Content
{
    /**
     * @var array
     */
    CONST IMAGE_ATTRIBUTES = [
        "image",
        "thumbnail",
        "small_image",
        "swatch_image",
        "second_thumb",
        "thumbnail_label",
        "image_label",
        "small_image_label",
        "media_gallery"
    ];

    /**
     * @var \Magento\Catalog\Model\Attribute\ScopeOverriddenValue
     */
    protected $scopeOverriddenValue;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Catalog\Model\Product\Media\Config $mediaConfig
     * @param \Magento\Catalog\Model\Attribute\ScopeOverriddenValue $scopeOverriddenValue
     * @param array $data
     * @param \Magento\Backend\Block\DataProviders\ImageUploadConfig|null $imageUploadConfigDataProvider
     * @param \Magento\MediaStorage\Helper\File\Storage\Database|null $fileStorageDatabase
     * @param null|\Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Catalog\Model\Product\Media\Config $mediaConfig,
        \Magento\Catalog\Model\Attribute\ScopeOverriddenValue $scopeOverriddenValue,
        array $data = [],
        ImageUploadConfigDataProvider $imageUploadConfigDataProvider = null,
        Database $fileStorageDatabase = null,
        ?JsonHelper $jsonHelper = null
    ) {
        $this->scopeOverriddenValue = $scopeOverriddenValue;
        parent::__construct(
            $context,
            $jsonEncoder,
            $mediaConfig,
            $data,
            $imageUploadConfigDataProvider,
            $fileStorageDatabase,
            $jsonHelper
        );
    }

    /**
     * @return bool
     */
    public function getIsDefault()
    {
        $isDefault = true;
        $storeId = $this->getStoreId();
        foreach (self::IMAGE_ATTRIBUTES as $attr) {
            $isOverridden = $this->scopeOverriddenValue->containsValue(
                \Magento\Catalog\Api\Data\ProductInterface::class,
                $this->getElement()->getDataObject(),
                $attr,
                $storeId
            );
            if ($isOverridden) {
                $isDefault = false;
                break;
            }
        }

        return $isDefault;
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return (int)$this->getRequest()->getParam('store', 0);
    }
}
