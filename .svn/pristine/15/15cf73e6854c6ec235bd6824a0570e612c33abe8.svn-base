# BrandManager
Simple Web application manage and estimate your brand status easly.No database access use local php db table arrays.

# Run and Access
This application written from PHP 7.0 and upper version.Core framework is slim3.

Demo Username and Password
username : iskenderatasoy@gmail.com
password : 12345678

# Language 
Currently 2 language support.Turkish and English.

index.php file below constant store language
define("DEFAULT_LANGUAGE",'tr');

if you want to add your languge you can easly add from src/config/MessageContainer.php add your language setting  inside to   
$this->messages = array()

# Database
Database files contains  from src/localdb directory.

## step 1
tbUser.php file store your users list.Password must md5 value and  you can use  http://www.md5.cz/ .

## step 2
tbBrand.php file store your brand list.

## step 3
tbService.php file store your service list.

//Service types
define("DOMAIN", "1");
define("WEB_HOSTING", "2");
define("SSL_SERVICE", "3");
define("CLOUD_SERVICE", "4");
define("VPS", "5");
define("DEDICATED_SERVER", "6");
define("CDN_SERVICE", "7");
define("EMAIL_SERVICE", "8");
define("SMS_SERVICE", "9");

sample service list

$tbService = array(
    //brandId 1
    array(
        'serviceid' => $serviceid,
        'brandid' => $brandId,
        'userid' => $userId,
        'vendor_type' => DOMAIN,--1 or DOMAIN constant
        'vendor_name' => 'google.com',
        'vendor_expire_date' => '2030-01-01',
        'vendor_status' => '',
        'status' => STATUS_ACTIVE,
    )
);