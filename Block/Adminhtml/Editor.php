<?php
/**
 * RiseCore Technologies Pvt Ltd, Lucknow, India
 *
 * Copyright © Risecommerce. All rights reserved.
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer version in the future.
 * If you wish to customise this module for your needs.
 * Please contact us https://risecommerce.com/contact
 *
 * @category    Risecommerce
 * @package     Risecommerce_MaintenanceMode
 * @developer   Amarjeet Prajapati (amarjeet.wdev@gmail.com)
 * @copyright   Copyright (c) Risecommerce (https://www.risecommerce.com/)
 * @license     https://www.risecommerce.com/LICENSE.txt
 */

namespace Risecommerce\MaintenanceMode\Block\Adminhtml;

use Magento\Backend\Block\Template\Context;
use Magento\Cms\Model\Wysiwyg\Config as WysiwygConfig;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Editor extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * Editor constructor.
     *
     * @param Context       $context       context
     * @param WysiwygConfig $wysiwygConfig WysiwygConfig
     * @param array         $data          data
     */
    public function __construct(
        Context $context,
        WysiwygConfig $wysiwygConfig,
        array $data = []
    ) {
         $this->_wysiwygConfig = $wysiwygConfig;
         parent::__construct($context, $data);
    }

    /**
     * Attach the Editor.
     *
     * @param AbstractElement $element element
     *
     * @return mixed
     */
    protected function _getElementHtml(AbstractElement $element)
    {
         // set wysiwyg for element
         $element->setWysiwyg(true);
         // set configuration values
         $element->setConfig($this->_wysiwygConfig->getConfig($element));
         return parent::_getElementHtml($element);
    }
}
