<?php

class MessageContainer
{
    private $language;
    private $messages;

    public function __construct($language)
    {
        if (strlen($language) == 0) {
            $language = "en";
        }
        $this->language = $language;

        $this->messages = array(
            "tr" => array(
                //GENERIC LABELS
                'HTML_TITLE' => 'Thypax.com Marka Yöneticis',
                'LOGO_ALT' => 'thypax.com yazılım geliştirme',
                'HOMEPAGE' => 'Ana Sayfa',
                'LOGIN' => 'Giriş',
                'LOGOUT' => 'Çıkış',
                'EMAILADDRESS' => 'EPosta Adresi',
                'PASSWORD' => 'Şifre',
                'BRAND_LIST_ACTION' => 'Marka Listesi',
                'BRAND_LIST_HEADER_NAME' => 'Marka Adı',
                'BRAND_LIST_HEADER_EXPIRE_DATE' => 'Kalan Gün Sayısı',
                'BRAND_LIST_HEADER_BRAND_STATUS' => 'Durumu',
                'SERVICE_LIST_ACTION' => 'servisleri',
                'SERVICE_LIST_HEADER_SERVICE_NAME' => 'Servis Adı',
                'SERVICE_LIST_HEADER_SERVICE_VENDOR_TYPE_NAME' => 'Servis Türü',
                'SERVICE_LIST_HEADER_SERVICE_VENDOR_NAME' => 'Servis Sağlayıcı',
                'SERVICE_LIST_HEADER_EXPIRE_DATE' => 'İptal Zamanı',
                'SERVICE_LIST_HEADER_SERVICE_STATUS' => 'Durumu',
                'SERVICE_LIST_HEADER_EXPIRE_DATE_DAY_COUNT'=>'Kalan Gün',
                'SERVICE_LIST_VENDOR_TYPE_DOMAIN' => 'Domain',
                'SERVICE_LIST_VENDOR_TYPE_WEB_HOSTING' => 'Web Hosting',
                'SERVICE_LIST_VENDOR_TYPE_SSL_SERVICE' => 'SSL hizmeti',
                'SERVICE_LIST_VENDOR_TYPE_CLOUD_SERVICE' => 'Bulut hizmeti',
                'SERVICE_LIST_VENDOR_TYPE_VPS' => 'VPS',
                'SERVICE_LIST_VENDOR_TYPE_DEDICATED_SERVER' => 'Sunucu',
                'SERVICE_LIST_VENDOR_TYPE_CDN_SERVICE' => 'Cdn',
                'SERVICE_LIST_VENDOR_TYPE_EMAIL_SERVICE' => 'EPosta',
                'SERVICE_LIST_VENDOR_TYPE_SMS_SERVICE' => 'Sms',
                'GLOBAL_LABEL_EXPIRE_DATE_STATUS_NONE' => '-',
                'GLOBAL_LABEL_EXPIRE_DATE_STATUS_OK' => 'Sorun Yok',
                'GLOBAL_LABEL_EXPIRE_DATE_STATUS_TROUBLE' => 'Sorun Olabilir',
                "GLOBAL_LABEL_OPERATION_SUCCESFULLY" => "İşleminiz başarılı bir şekilde gerçekleştirildi.",
                "GLOBAL_LABEL_OPERATION_FAILED" => "İşleminiz sırasında hata oluştu.",
                "GLOBAL_LABEL_INVALID_USER" => "Geçersiz Kullanıcı veya Şifre.Lütfen kontrol edip tekrar deneyiniz.",
            ),
            "en" => array(
                //GENERIC LABELS
                'HTML_TITLE' => 'Thypax.com Brand Manager',
                'LOGO_ALT' => 'thypax.com software',
                'HOMEPAGE' => 'Home Page',
                'LOGIN' => 'Login',
                'LOGOUT' => 'Logout',
                'EMAILADDRESS' => 'Email Address',
                'PASSWORD' => 'Password',
                'BRAND_LIST_ACTION' => 'Brand List',
                'BRAND_LIST_HEADER_EXPIRE_DATE' => 'Brand Name',
                'BRAND_LIST_HEADER_EXPIRE_DATE' => 'Expired Service Day',
                'BRAND_LIST_HEADER_BRAND_STATUS' => 'Status',
                'SERVICE_LIST_ACTION' => 'services',
                'SERVICE_LIST_HEADER_SERVICE_NAME' => 'Service Name',
                'SERVICE_LIST_HEADER_SERVICE_VENDOR_TYPE_NAME' => 'Vendor Type',
                'SERVICE_LIST_HEADER_SERVICE_VENDOR_NAME' => 'Vendor Name',
                'SERVICE_LIST_HEADER_EXPIRE_DATE' => 'Expire Date',
                'SERVICE_LIST_HEADER_SERVICE_STATUS' => 'Status',
                'SERVICE_LIST_VENDOR_TYPE_DOMAIN' => 'Domain',
                'SERVICE_LIST_HEADER_EXPIRE_DATE_DAY_COUNT'=>'Day Count',
                'SERVICE_LIST_VENDOR_TYPE_WEB_HOSTING' => 'Web Hosting',
                'SERVICE_LIST_VENDOR_TYPE_SSL_SERVICE' => 'SSL',
                'SERVICE_LIST_VENDOR_TYPE_CLOUD_SERVICE' => 'Cloud Service',
                'SERVICE_LIST_VENDOR_TYPE_VPS' => 'VPS',
                'SERVICE_LIST_VENDOR_TYPE_DEDICATED_SERVER' => 'Decicated Server',
                'SERVICE_LIST_VENDOR_TYPE_CDN_SERVICE' => 'CDN',
                'SERVICE_LIST_VENDOR_TYPE_EMAIL_SERVICE' => 'Email',
                'SERVICE_LIST_VENDOR_TYPE_SMS_SERVICE' => 'SMS',
                'GLOBAL_LABEL_EXPIRE_DATE_STATUS_NONE' => '-',
                'GLOBAL_LABEL_EXPIRE_DATE_STATUS_OK' => 'Ok',
                'GLOBAL_LABEL_EXPIRE_DATE_STATUS_TROUBLE' => 'Check',
                "GLOBAL_LABEL_OPERATION_SUCCESFULLY" => "Your request successfully processed.",
                "GLOBAL_LABEL_OPERATION_FAILED" => "Your request failed",
                "GLOBAL_LABEL_INVALID_USER" => "Invalid User or Password.Please Try Again.",
            ),
        );
    }

    public function toArray(): array
    {
        if ($this->language === "tr") {
            return $this->messages["tr"];
        }
        return $this->messages["en"];
    }

    public function SetLanguage($language)
    {
        if (!isset($language)) {
            $this->language = "tr";
        } else {
            switch ($language) {
                case "en":
                    $this->language = $language;
                    break;
                case "tr":
                    $this->language = $language;
                    break;
                default:
                    $this->language = "tr";
            }
        }
    }

    public function GetLanguage()
    {
        return $this->language;
    }

    public  function GLOBAL_LABEL_OPERATION_FAILED(): string
    {
        return $this->messages[$this->language]["GLOBAL_LABEL_OPERATION_FAILED"];
    }

    public  function GLOBAL_LABEL_INVALID_USER(): string
    {
        return $this->messages[$this->language]["GLOBAL_LABEL_INVALID_USER"];
    }

    public  function GLOBAL_LABEL_EXPIRE_DATE_STATUS_NONE(): string
    {
        return $this->messages[$this->language]["GLOBAL_LABEL_EXPIRE_DATE_STATUS_NONE"];
    }
    public  function GLOBAL_LABEL_EXPIRE_DATE_STATUS_OK(): string
    {
        return $this->messages[$this->language]["GLOBAL_LABEL_EXPIRE_DATE_STATUS_OK"];
    }
    public  function GLOBAL_LABEL_EXPIRE_DATE_STATUS_TROUBLE(): string
    {
        return $this->messages[$this->language]["GLOBAL_LABEL_EXPIRE_DATE_STATUS_TROUBLE"];
    }

    public  function SERVICE_LIST_VENDOR_TYPE_DOMAIN(): string
    {
        return $this->messages[$this->language]["SERVICE_LIST_VENDOR_TYPE_DOMAIN"];
    }

    public  function SERVICE_LIST_VENDOR_TYPE_WEB_HOSTING(): string
    {
        return $this->messages[$this->language]["SERVICE_LIST_VENDOR_TYPE_WEB_HOSTING"];
    }

    public  function SERVICE_LIST_VENDOR_TYPE_SSL_SERVICE(): string
    {
        return $this->messages[$this->language]["SERVICE_LIST_VENDOR_TYPE_SSL_SERVICE"];
    }

    public  function SERVICE_LIST_VENDOR_TYPE_CLOUD_SERVICE(): string
    {
        return $this->messages[$this->language]["SERVICE_LIST_VENDOR_TYPE_CLOUD_SERVICE"];
    }

    public  function SERVICE_LIST_VENDOR_TYPE_VPS(): string
    {
        return $this->messages[$this->language]["SERVICE_LIST_VENDOR_TYPE_VPS"];
    }

    public  function SERVICE_LIST_VENDOR_TYPE_DEDICATED_SERVER(): string
    {
        return $this->messages[$this->language]["SERVICE_LIST_VENDOR_TYPE_DEDICATED_SERVER"];
    }    

    public  function SERVICE_LIST_VENDOR_TYPE_CDN_SERVICE(): string
    {
        return $this->messages[$this->language]["SERVICE_LIST_VENDOR_TYPE_CDN_SERVICE"];
    }

    public  function SERVICE_LIST_VENDOR_TYPE_EMAIL_SERVICE(): string
    {
        return $this->messages[$this->language]["SERVICE_LIST_VENDOR_TYPE_EMAIL_SERVICE"];
    }

    public  function SERVICE_LIST_VENDOR_TYPE_SMS_SERVICE(): string
    {
        return $this->messages[$this->language]["SERVICE_LIST_VENDOR_TYPE_SMS_SERVICE"];
    }
}
