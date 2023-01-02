<?php
/**
 * Class Timereload Doc Comment
 *
 * PHP version 8
 *
 * @category Risecommerce Technologies
 * @package  Risecommerce_MaintenanceMode
 * @author   Risecommerce <magento@risecommerce.com>
 * @license  https://www.risecommerce.com  Open Software License (OSL 3.0)
 * @link     https://www.risecommerce.com
 */

namespace Risecommerce\MaintenanceMode\Controller\Index;

class Timereload extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Risecommerce\MaintenanceMode\Helper\Data
     */
    protected $helperData;

    /**
     * CacheTypelist
     *
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    protected $cacheTypeList;

    /**
     * Cachepool
     *
     * @var \Magento\Framework\App\Cache\Frontend\Pool
     */
    protected $cacheFrontendPool;

    /**
     * Timereload constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
     * @param \Risecommerce\MaintenanceMode\Helper\Data $helperData
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        \Risecommerce\MaintenanceMode\Helper\Data $helperData
    ) {
        $this->helperData = $helperData;
        $this->cacheTypeList = $cacheTypeList;
        $this->cacheFrontendPool = $cacheFrontendPool;
        return parent::__construct($context);
    }

    /**
     * Timereload Action
     *
     * @return mixed
     */
    public function execute()
    {
        $this->helperData->getCurrentTime();
        $types = [
                    'config',
                    'layout',
                    'block_html',
                    'collections',
                    'reflection',
                    'db_ddl',
                    'eav',
                    'config_integration',
                    'config_integration_api',
                    'full_page',
                    'translate',
                    'config_webservice'
                ];
        foreach ($types as $type) {
            $this->cacheTypeList->cleanType($type);
        }
        foreach ($this->cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
        $this->_redirect('');
    }
}
