<?php
/**
 * Class Index Comment
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

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Risecommerce\MaintenanceMode\Helper\Data;


class Index extends Template
{
    /**
     * MaintenanceMode Helper
     *
     * @var \Risecommerce\MaintenanceMode\Helper\Data
     */
    protected $helperData;

    /**
     * Index constructor.
     * @param Context $context
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        Data $helperData
    ) {
        $this->helperData = $helperData;
        parent::__construct($context);
    }

    /**
     * Return Headline Text
     *
     * @return mixed
     */
    public function getHeadlineText()
    {
        return $this->helperData->getHeadlineText();
    }

    /**
     * Return Headline Text Color
     *
     * @return mixed
     */
    public function getHeadlineTextColor()
    {
        return $this->helperData->getHeadlineTextColor();
    }

    /**
     * Return Page Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->helperData->getDescription();
    }

    /**
     * Return Page Description Color
     *
     * @return mixed
     */
    public function getDescriptionColor()
    {
        return $this->helperData->getDescriptionColor();
    }

    /**
     * Return Background Image path
     *
     * @return bool|string
     */
    public function getBackgroundImageUrl()
    {
        return $this->helperData->getBackgroundImageUrl();
    }

    /**
     * Return Backgorund color
     *
     * @return mixed
     */
    public function getBackgroundColor()
    {
        return $this->helperData->getBackgroundColor();
    }

    /**
     * Return Add newsletter or not
     *
     * @return mixed
     */
    public function getAddNewsletter()
    {
        return $this->helperData->getAddNewsletter();
    }

    /**
     * Return Newsletter Text
     *
     * @return mixed
     */
    public function getNewsletterText()
    {
        return $this->helperData->getNewsletterText();
    }

    /**
     * Return Newsletter Text color
     *
     * @return mixed
     */
    public function getNewsletterTextColor()
    {
        return $this->helperData->getNewsletterTextColor();
    }

    /**
     * Return Add Contact Us button or not
     *
     * @return mixed
     */
    public function getAddContactUs()
    {
        return $this->helperData->getAddContactUs();
    }

    /**
     * Return Email Id for Contact
     *
     * @return mixed
     */
    public function getContactUsEmail()
    {
        return $this->helperData->getContactUsEmail();
    }

    /**
     * Return Add Social button or not
     *
     * @return mixed
     */
    public function getAddSocialButton()
    {
        return $this->helperData->getAddSocialButton();
    }

    /**
     * Return Facebook link
     *
     * @return mixed
     */
    public function getFacebookLink()
    {
        return $this->helperData->getFacebookLink();
    }

    /**
     * Return Twitter link
     *
     * @return mixed
     */
    public function getTwitterLink()
    {
        return $this->helperData->getTwitterLink();
    }

    /**
     * Return Pinterest link
     *
     * @return mixed
     */
    public function getPinterestLink()
    {
        return $this->helperData->getPinterestLink();
    }

    /**
     * Return Googleplus link
     *
     * @return mixed
     */
    public function getGooglePlusLink()
    {
        return $this->helperData->getGooglePlusLink();
    }

    /**
     * Return Add Countdown timer or not
     *
     * @return mixed
     */
    public function getAddCountDownClock()
    {
        return $this->helperData->getAddCountDownClock();
    }

    /**
     * Return Timer color
     *
     * @return mixed
     */
    public function getTimerColor()
    {
        return $this->helperData->getTimerColor();
    }

    /**
     * Return Start Date of Timer
     *
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->helperData->getStartDate();
    }

    /**
     * Return End Date of Timer
     *
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->helperData->getEndDate();
    }

    /**
     * Return Current tine and date of current store
     *
     * @return mixed
     */
    public function getStoreDateTime()
    {
        return $this->helperData->getStoreDateTime();
    }

    /**
     * Return auto timer
     *
     * @return mixed
     */
    public function getAutoTimer()
    {
        return $this->helperData->getAutoTimer();
    }
}
