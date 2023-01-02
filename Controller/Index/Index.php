<?php
/**
 * Class Index Doc Comment
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

use Magento\Framework\HTTP\PhpEnvironment\Request;


class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * MaintenanceRedirect Block
     *
     * @var \Risecommerce\MaintenanceMode\Block\MaintenanceRedirect
     */
    protected $blockData;

    /**
     * PageFactory $_pageFactory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * TimezoneInterface
     *
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $date;
    /**
     * @var
     */
    private $request;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Risecommerce\MaintenanceMode\Block\MaintenanceRedirect $block
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Risecommerce\MaintenanceMode\Block\MaintenanceRedirect $block,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        Request $request
    ) {
        $this->blockData = $block;
        $this->_pageFactory = $pageFactory;
        $this->date = $date;
        $this->request = $request;
        return parent::__construct($context);
    }

    /**
     * Index Action
     *
     * @return void
     */
    public function execute()
    {
        $currentUrl = $this->blockData->getCurrentUrl();

        $isMaintenanceModeEnabled = $this->blockData->getConfigData('enable');
        $exemptMaintenanceModeIps = $this->blockData->getConfigData('allow_ips');
        $maintenanceModeStartDateTime = $this->blockData->getConfigData('start_date');
        $maintenanceModeEndDateTime = $this->blockData->getConfigData('end_date');
        $storeDateTime = $this->date->date()->format('Y-m-d H:i:s');

        $pageTitle = $this->blockData->getConfigData('page_title');

        $exemptMaintenanceModeIpsArray = explode(',', trim((string)$exemptMaintenanceModeIps));

        $userIPAddresses = '';

        if (!empty($this->request->getServerValue('HTTP_CLIENT_IP'))) {
            $userIPAddresses = $this->request->getServerValue('HTTP_CLIENT_IP');
        } elseif (!empty($this->request->getServerValue('HTTP_X_FORWARDED_FOR'))) {
            $userIPAddresses = $this->request->getServerValue('HTTP_X_FORWARDED_FOR');
        } else {
            $userIPAddresses = $this->request->getServerValue('REMOTE_ADDR');
        }

        $userIPAddressesArray = array_map('trim', explode(',', $userIPAddresses));

        if ($isMaintenanceModeEnabled && (!$maintenanceModeStartDateTime || strtotime($storeDateTime) >= strtotime($maintenanceModeStartDateTime)) && (!$maintenanceModeEndDateTime || strtotime($storeDateTime) <= strtotime($maintenanceModeEndDateTime)) && !array_intersect($userIPAddressesArray, $exemptMaintenanceModeIpsArray)) {
            $this->resultPage = $this->_pageFactory->create();
            $this->resultPage->getConfig()->getTitle()->set($pageTitle);
            return $this->resultPage;
        } else {
            $this->_redirect('');
        }
    }
}
