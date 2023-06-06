<?php
/**
 * @author FYB Romania
 * @copyright Copyright © FYB Romania (https://fyb.ro). All rights reserved.
 */

namespace Fyb\UseDefaultImages\Block\Adminhtml\Product\Helper\Form;

class Gallery extends \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery
{
    /**
     * @inheritdoc
     */
    public function getContentHtml()
    {
        $html = parent::getContentHtml();

        $useDefault = $this->getLayout()
            ->createBlock(\Fyb\UseDefaultImages\Block\Adminhtml\Product\DefaultImages::class)
            ->setTemplate('Fyb_UseDefaultImages::product/use_default_images.phtml');
        $useDefault->setId($this->getHtmlId() . '2_content')->setElement($this);
        $useDefault->setFormName($this->formName);

        return $useDefault->toHtml() . $html;
    }
}
