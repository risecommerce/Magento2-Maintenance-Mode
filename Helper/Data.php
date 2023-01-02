<?php
/**
 * Class Data Doc Comment
 *
 * PHP version 8
 *
 * @category Risecommerce Technologies
 * @package  Risecommerce_MaintenanceMode
 * @author   Risecommerce <magento@risecommerce.com>
 * @license  https://www.risecommerce.com  Open Software License (OSL 3.0)
 * @link     https://www.risecommerce.com
 */

namespace Risecommerce\MaintenanceMode\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    /**
     * XML_PATH_MAINTENANCEMODE_GENERAL
     */
    const XML_PATH_MAINTENANCEMODE_GENERAL = 'maintenancemode/general/';

    /**
     * StoreManagerInterface
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * ScopeConfigInterface
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * TimezoneInterface
     *
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $date;

    /**
     * NotifyUserFactory
     *
     * @var \Risecommerce\MaintenanceMode\Model\NotifyUserFactory
     */
    protected $notifyUserFactory;

    /**
     * TransportBuilder
     *
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $transportBuilder;

    /**
     * StateInterface
     *
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    protected $inlineTranslation;

    /**
     * Escaper
     *
     * @var \Magento\Framework\Escaper
     */
    protected $escaper;

    /**
     * ConfigWriter
     *
     * @var \Magento\Framework\App\Config\Storage\WriterInterface
     */
    protected $configWriter;

    /**
     * Filter
     *
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filter;

    /**
     * Data constructor.
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scope
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
     * @param \Risecommerce\MaintenanceMode\Model\NotifyUserFactory $notifyUserFactory
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Framework\Escaper $_escaper
     * @param \Magento\Cms\Model\Template\FilterProvider $filter
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scope,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
        \Risecommerce\MaintenanceMode\Model\NotifyUserFactory $notifyUserFactory,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Escaper $_escaper,
        \Magento\Cms\Model\Template\FilterProvider $filter
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scope;
        $this->date =  $date;
        $this->configWriter = $configWriter;
        $this->notifyUserFactory = $notifyUserFactory;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper=$_escaper;
        $this->_filter = $filter;
        parent::__construct($context);
    }

    /**
     * Return Configuration value of given field
     *
     * @param param $field field
     *
     * @return mixed
     */
    public function getConfigValue($field)
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Return Module is enable or not
     *
     * @return mixed
     */
    public function getIsEnable()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'enable'
        );
    }

    /**
     * Return Headline Text
     *
     * @return mixed
     */
    public function getHeadlineText()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'headline_text'
        );
    }

    /**
     * Return Headline Text Color
     *
     * @return mixed
     */
    public function getHeadlineTextColor()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'headline_text_color'
        );
    }

    /**
     * Return Page Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        $content = $this->getConfigValue(self::XML_PATH_MAINTENANCEMODE_GENERAL . 'description');

        return $this->_filter->getPageFilter()->filter($content);
    }

    /**
     * Return Page Description Color
     *
     * @return mixed
     */
    public function getDescriptionColor()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'description_color'
        );
    }

    /**
     * Return Background Image path
     *
     * @return bool|string
     */
    public function getBackgroundImageUrl()
    {
        if ($this->getConfigValue(self::XML_PATH_MAINTENANCEMODE_GENERAL . 'background_image')) {
            return $this->getMediaUrl() . 'risecommerce/maintenance/' . $this
                    ->getConfigValue(self::XML_PATH_MAINTENANCEMODE_GENERAL . 'background_image');
        } else {
            return false;
        }
    }

    /**
     * Return Backgorund color
     *
     * @return mixed
     */
    public function getBackgroundColor()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'background_color'
        );
    }

    /**
     * Return Add newsletter or not
     *
     * @return mixed
     */
    public function getAddNewsletter()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'add_newsletter'
        );
    }

    /**
     * Return Newsletter Text
     *
     * @return mixed
     */
    public function getNewsletterText()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'newsletter_text'
        );
    }

    /**
     * Return Newsletter Text color
     *
     * @return mixed
     */
    public function getNewsletterTextColor()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'newsletter_text_color'
        );
    }

    /**
     * Return Add Contact Us button or not
     *
     * @return mixed
     */
    public function getAddContactUs()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'add_contact_us'
        );
    }

    /**
     * Return Email Id for Contact
     *
     * @return mixed
     */
    public function getContactUsEmail()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'contact_us_email'
        );
    }

    /**
     * Return Add Social button or not
     *
     * @return mixed
     */
    public function getAddSocialButton()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'add_social_button'
        );
    }

    /**
     * Return Facebook link
     *
     * @return mixed
     */
    public function getFacebookLink()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'facebook_link'
        );
    }

    /**
     * Return Twitter link
     *
     * @return mixed
     */
    public function getTwitterLink()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'twitter_link'
        );
    }

    /**
     * Return Pinterest link
     *
     * @return mixed
     */
    public function getPinterestLink()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'pinterest_link'
        );
    }

    /**
     * Return Googleplus link
     *
     * @return mixed
     */
    public function getGooglePlusLink()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'gplus_link'
        );
    }

    /**
     * Return Add Countdown timer or not
     *
     * @return mixed
     */
    public function getAddCountDownClock()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'add_countdown_clock'
        );
    }

    /**
     * Return Timer color
     *
     * @return mixed
     */
    public function getTimerColor()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'timer_color'
        );
    }

    /**
     * Return Start Date of Timer
     *
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'start_date'
        );
    }

    /**
     * Return End Date of Timer
     *
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'end_date'
        );
    }

    /**
     * Return Auto Timer
     *
     * @return mixed
     */
    public function getAutoTimer()
    {
        return $this->getConfigValue(
            self::XML_PATH_MAINTENANCEMODE_GENERAL . 'auto_timer'
        );
    }

    /**
     * Return Current tine and date of current store
     *
     * @return mixed
     */
    public function getStoreDateTime()
    {
        return $this->date->date()->format('Y-m-d H:i:s');
    }

    /**
     * Return Media Url
     *
     * @return mixed
     */
    public function getMediaUrl()
    {
        return $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    /**
     * Return Store Url
     *
     * @return mixed
     */
    public function getStoreUrl()
    {
        $storeId = $this->storeManager->getDefaultStoreView()->getStoreId();
        $url = $this->storeManager->getStore($storeId)->getUrl();
        return $url;
    }

    /**
     * Get Current Time
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\MailException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCurrentTime()
    {
        if ($this->getConfigValue(self::XML_PATH_MAINTENANCEMODE_GENERAL .'auto_timer') == '1') {
            $this->configWriter->save(self::XML_PATH_MAINTENANCEMODE_GENERAL . 'enable', '0', 'default', $scopeId = 0);
        }
    }
}
