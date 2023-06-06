<?php
/**
 * @author FYB Romania
 * @copyright Copyright © FYB Romania (https://fyb.ro). All rights reserved.
 */

namespace Fyb\UseDefaultImages\Plugin;

use Magento\Catalog\Model\Product\Gallery\CreateHandler;
use Magento\Catalog\Model\ResourceModel\Product\Gallery;

class MediaCreateHandler extends CreateHandler
{
    /**
     * @param \Magento\Catalog\Model\Product\Gallery\CreateHandler $mediaGalleryCreateHandler
     * @param \Magento\Catalog\Model\Product $product
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function afterExecute(
        \Magento\Catalog\Model\Product\Gallery\CreateHandler $mediaGalleryCreateHandler,
        \Magento\Catalog\Model\Product $product
    ) {
        $linkField = $this->metadata->getLinkField();
        if ($product->getClearGallery()) {
            $this->clearMediaValues((int)$product->getData($linkField), $product->getStoreId());
            $this->clearVideoValues((int)$product->getData($linkField), $product->getStoreId());
        }

        return $product;
    }

    /**
     * @param int $entityId
     * @param int $storeId
     *
     * @return void
     */
    protected function clearVideoValues($entityId, $storeId)
    {
        $conditions = implode(
            ' AND ',
            [
                $this->resourceModel->getConnection()->quoteInto(
                    'value_id IN (
                        SELECT value_id FROM ' . Gallery::GALLERY_VALUE_TO_ENTITY_TABLE. ' WHERE entity_id = ?
                    )',
                    $entityId
                ),
                $this->resourceModel->getConnection()->quoteInto('store_id = ?', $storeId),
            ]
        );
        $this->resourceModel->getConnection()->delete(
            'catalog_product_entity_media_gallery_value_video',
            $conditions
        );
    }

    /**
     * @param int $entityId
     * @param int $storeId
     *
     * @return void
     */
    protected function clearMediaValues($entityId, $storeId)
    {
        $conditions = implode(
            ' AND ',
            [
                $this->resourceModel->getConnection()->quoteInto($this->metadata->getLinkField() . ' = ?', $entityId),
                $this->resourceModel->getConnection()->quoteInto('store_id = ?', (int)$storeId),
            ]
        );
        $this->resourceModel->getConnection()->delete(
            Gallery::GALLERY_VALUE_TABLE,
            $conditions
        );
    }
}
