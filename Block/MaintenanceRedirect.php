<?php
/**
 * Class MaintenanceRedirect Doc Comment
 *
 * PHP version 8
 *
 * @category Risecommerce Technologies
 * @package  Risecommerce_MaintenanceMode
 * @author   Risecommerce <magento@risecommerce.com>
 * @license  https://www.risecommerce.com  Open Software License (OSL 3.0)
 * @link     https://www.risecommerce.com
 */

namespace Risecommerce\MaintenanceMode\Block;

class MaintenanceRedirect extends \Magento\Framework\View\Element\Template
{
    /**
     * ScopeConfigInterface
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * StoreManagerInterface
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * PATH_MAINTENANCE_DEFAULT
     */
    const PATH_MAINTENANCE_DEFAULT = 'maintenancemode/general/';

    /**
     * TimezoneInterface
     *
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $date;

    /**
     * MaintenanceRedirect constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->date =  $date;
        parent::__construct($context);
    }

    /**
     * Return Configuration value of given path
     *
     * @param param $path path
     *
     * @return mixed
     */
    public function getConfigData($path)
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

        return $this->scopeConfig->getValue(
            self::PATH_MAINTENANCE_DEFAULT.$path,
            $storeScope
        );
    }

    /**
     * Return Current url
     *
     * @return mixed
     */
    public function getCurrentUrl()
    {
        return $this->storeManager->getStore()->getCurrentUrl();
    }
}
