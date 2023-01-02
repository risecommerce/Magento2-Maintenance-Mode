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

namespace Risecommerce\MaintenanceMode\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;


class NotifyUser extends AbstractDb
{
    /**
     * Define main table
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('risecommerce_maintenance_mode_notify_user', 'notify_user_id');
    }
}
