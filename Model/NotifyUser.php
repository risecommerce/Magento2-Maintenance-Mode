<?php
/**
 * Class NotifyUser Doc Comment
 *
 * PHP version 8
 *
 * @category Risecommerce Technologies
 * @package  Risecommerce_MaintenanceMode
 * @author   Risecommerce <magento@risecommerce.com>
 * @license  https://www.risecommerce.com  Open Software License (OSL 3.0)
 * @link     https://www.risecommerce.com
 */

namespace Risecommerce\MaintenanceMode\Model;

use Magento\Framework\Model\AbstractModel;


class NotifyUser extends AbstractModel
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Risecommerce\MaintenanceMode\Model\ResourceModel\NotifyUser::class);
    }
}
