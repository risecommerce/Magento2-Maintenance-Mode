# Maintenance Mode Extension  

The [Maintenance Mode Extension for Magento 2](https://risecommerce.com/store/magento2-maintenance-mode.html) by Risecommerce is perfect for putting your Magento storefront into maintenance mode for a few minutes, hours, or days while updating your site. Showing a blank or low-quality maintenance page leaves a negative impression on customers. With this extension, you can customize maintenance pages as per your requirements and include features such as newsletters, countdown timers, social links, and contact information to keep your customers engaged and updated.  

For more details about the extension, visit the [Maintenance Mode Extension for Magento 2](https://risecommerce.com/store/magento2-maintenance-mode.html).

If you're looking to enhance your Magento store further, consider hiring a [dedicated Magento developer](https://risecommerce.com/hire-dedicated-magento-developer.html).

For support or inquiries, please visit our [contact page](https://risecommerce.com/contact).

## Support  
- **Magento versions:** 2.3.x, 2.4.x  

## How to Install the Extension  

### Method I: Manual Installation  

1. Download the archive file.  
2. Unzip the file.  
3. Create a folder at `[Magento_Root]/app/code/Risecommerce/MaintenanceMode`.  
4. Move the unzipped files to the directory `[Magento_Root]/app/code/Risecommerce/MaintenanceMode`.  

### Method II: Using Composer  

Run the following command:  

composer require risecommerce/magento2-maintenance-mode-extension

#Enable Extension:
- php bin/magento module:enable Risecommerce_MaintenanceMode
- php bin/magento setup:upgrade
- php bin/magento setup:di:compile
- php bin/magento setup:static-content:deploy
- php bin/magento cache:flush

#Disable Extension:
- php bin/magento module:disable Risecommerce_MaintenanceMode
- php bin/magento setup:upgrade
- php bin/magento setup:di:compile
- php bin/magento setup:static-content:deploy
- php bin/magento cache:flush
