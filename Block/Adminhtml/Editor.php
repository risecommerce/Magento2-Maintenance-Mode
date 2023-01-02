<?php
/**
 * Class Editor Doc Comment
 *
 * PHP version 8
 *
 * @category Risecommerce Technologies
 * @package  Risecommerce_MaintenanceMode
 * @author   Risecommerce <magento@risecommerce.com>
 * @license  https://www.risecommerce.com  Open Software License (OSL 3.0)
 * @link     https://www.risecommerce.com
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
