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

namespace Risecommerce\MaintenanceMode\Controller\Index;

use Risecommerce\MaintenanceMode\Model\NotifyUserFactory;


class Save extends \Magento\Framework\App\Action\Action
{

    /**
     * Pagefactory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $pageFactory;

    /**
     * NotifyUserFactory
     *
     * @var NotifyUserFactory
     */
    protected $notifyUserFactory;

    /**
     * JsonFactory
     *
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * Save constructor.
     *
     * @param \Magento\Framework\App\Action\Context            $context           context
     * @param \Magento\Framework\View\Result\PageFactory       $pageFactory       pageFactory
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory resultJsonFactory
     * @param NotifyUserFactory                                $notifyUserFactory notifyUserFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        NotifyUserFactory $notifyUserFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->notifyUserFactory = $notifyUserFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        return parent::__construct($context);
    }

    /**
     * Email Id validation
     *
     * @param param $email email-id
     *
     * @return bool
     */
    protected function validateEmailFormat($email)
    {
        if (!\Zend_Validate::is($email, \Magento\Framework\Validator\EmailAddress::class)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Save Action
     *
     * @return mixed
     */
    public function execute()
    {
        $jsonResult = $this->resultJsonFactory->create();
        try {
            $data = $this->getRequest()->getPost();

            $email = trim($data['email']);
            if ($email == '' || $email == null) {
                $json_encode = json_encode(
                    ['success' => 0,
                        'validate' => 0,
                        'message' => 'Please enter email address.']
                );
            } elseif (!$this->validateEmailFormat($email)) {
                $json_encode = json_encode(
                    ['success' => 0,
                        'validate' => 0,
                        'message' => 'Please enter valid email address.']
                );
            } else {
                $notifyUserModel = $this->notifyUserFactory->create();
                $collection = $notifyUserModel->getCollection()
                    ->addFieldToFilter('email', $email)->addFieldToFilter('is_notified', 0);
                if (count($collection) > 0) {
                    foreach ($collection as $data) {
                        $json_encode = json_encode(
                            ['success' => 0,
                                'validate' => 1,
                                'message' => 'Your email is already subscribed.']
                        );
                    }
                } else {
                    $notifyUserModel->setEmail($email);
                    $notifyUserModel->save();
                    $json_encode = json_encode(
                        ['success' => 1,
                            'validate' => 1,
                            'message' => 'Email saved successfully.']
                    );
                }
            }
        } catch (\Exception $e) {
            $json_encode = json_encode(
                ['success' => 0,
                    'validate' => 1,
                    'message' => 'Something went wrong.Pease try again later.']
            );
        }
        $jsonResult->setData($json_encode);
        return $jsonResult;
    }
}
