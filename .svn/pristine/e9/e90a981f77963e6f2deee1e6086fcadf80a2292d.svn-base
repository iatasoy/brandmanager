<?php

use Respect\Validation\Rules\Exists;

class BaseFacade
{
    var $request;
    var $configObj;
    var $messageContainerObj;
    var $userId;

    function __construct(
        $configObj,
        $request
    ) {
        $this->configObj = $configObj;
        $this->request = $request;
        $this->messageContainerObj = $configObj->GetMessageContainer();
        $this->userId = $_SESSION['USEROBJ']['userid'] ?? 0;
    }

    private function GetLoginArray(
        $status = HttpStatusCodes::OK,
        $errorMessage = '',
        $emailAddress = '',
        $password = ''
    ): array {
        return array(
            'STATUS' => $status,
            'ERROR_MESSAGE' => $errorMessage,
            'EMAILADDRESS_VALUE' => $emailAddress,
            'PASSWORD_VALUE' => $password,
        );
    }

    private function GetExpiredDateArray($expireDateDayCount)
    {
        $expireDateArray = array();

        if ($expireDateDayCount == PHP_INT_MIN) {
            $expireDateArray['expire_date_day_count'] = '-';
            $expireDateArray['expire_date_status'] = '-';
            $expireDateArray['expire_date_status_detail'] = $this->messageContainerObj->GLOBAL_LABEL_EXPIRE_DATE_STATUS_NONE();
        } else {
            $expireDateArray['expire_date_day_count'] = $expireDateDayCount;

            if ($expireDateDayCount > EXPIRE_DAY_COUNT) {
                $expireDateArray['expire_date_status'] = 'brandOk';
                $expireDateArray['expire_date_status_detail'] = $this->messageContainerObj->GLOBAL_LABEL_EXPIRE_DATE_STATUS_OK();
            } else {
                $expireDateArray['expire_date_status'] = 'brandInTrouble';
                $expireDateArray['expire_date_status_detail'] = $this->messageContainerObj->GLOBAL_LABEL_EXPIRE_DATE_STATUS_TROUBLE();
            }
        }

        return $expireDateArray;
    }

    private function GetVendorType($vendorTypeId): string
    {
        $vendorTypeName = '';

        switch ($vendorTypeId) {
            case DOMAIN:
                $vendorTypeName = $this->messageContainerObj->SERVICE_LIST_VENDOR_TYPE_DOMAIN();
                break;
            case WEB_HOSTING:
                $vendorTypeName = $this->messageContainerObj->SERVICE_LIST_VENDOR_TYPE_WEB_HOSTING();
                break;
            case SSL_SERVICE:
                $vendorTypeName = $this->messageContainerObj->SERVICE_LIST_VENDOR_TYPE_SSL_SERVICE();
                break;
            case CLOUD_SERVICE:
                $vendorTypeName = $this->messageContainerObj->SERVICE_LIST_VENDOR_TYPE_CLOUD_SERVICE();
                break;
            case VPS:
                $vendorTypeName = $this->messageContainerObj->SERVICE_LIST_VENDOR_TYPE_VPS();
                break;
            case DEDICATED_SERVER:
                $vendorTypeName = $this->messageContainerObj->SERVICE_LIST_VENDOR_TYPE_DEDICATED_SERVER();
                break;
            case CDN_SERVICE:
                $vendorTypeName = $this->messageContainerObj->SERVICE_LIST_VENDOR_TYPE_CDN_SERVICE();
                break;
            case EMAIL_SERVICE:
                $vendorTypeName = $this->messageContainerObj->SERVICE_LIST_VENDOR_TYPE_EMAIL_SERVICE();
                break;
            case SMS_SERVICE:
                $vendorTypeName = $this->messageContainerObj->SERVICE_LIST_VENDOR_TYPE_SMS_SERVICE();
                break;
            default:
                $vendorTypeName = $this->messageContainerObj->GLOBAL_LABEL_BRAND_STATUS_NONE();
                break;
        }

        return $vendorTypeName;
    }

    public function Login(
        $tbUser
    ): array {
        $inputEmailAddress = $this->request['EmailAddress'] ?? '';
        $inputPassword = $this->request['Password'] ?? '';

        try {
            foreach ($tbUser as $userObj) {
                if (
                    $userObj['emailaddress'] == $inputEmailAddress &&
                    $userObj['password'] == md5($inputPassword) &&
                    $userObj['status'] == STATUS_ACTIVE
                ) {
                    $_SESSION['USEROBJ'] = $userObj;
                    return $this->GetLoginArray(
                        HttpStatusCodes::OK,
                        '',
                        '',
                        ''
                    );
                }
            }
        } catch (Exception $e) {
        }
        return $this->GetLoginArray(
            HttpStatusCodes::BAD_REQUEST,
            $this->messageContainerObj->GLOBAL_LABEL_INVALID_USER(),
            $inputEmailAddress,
            $inputPassword
        );
    }
    public function GetUserBrand(
        $tbBrand,
        $tbService
    ): array {
        try {
            if ($this->userId > 0) {
                $userServiceList = array();

                foreach ($tbBrand as $brandObj) {
                    if (
                        $brandObj['userid'] == $this->userId
                        &&
                        $brandObj['status'] == STATUS_ACTIVE
                    ) {
                        $firstExpiredServiceDayCount = $this->GetFirstExpiredService(
                            $brandObj['brandid'],
                            $tbService
                        );

                        $expireDateArray = $this->GetExpiredDateArray($firstExpiredServiceDayCount);

                        $brandObj['brand_expire_date_count'] = $firstExpiredServiceDayCount;
                        $brandObj['brand_status'] = $expireDateArray['expire_date_status'];
                        $brandObj['brand_status_detail'] =  $expireDateArray['expire_date_status_detail'];

                        array_push($userServiceList, $brandObj);
                    }
                }

                return $userServiceList;
            }
        } catch (Exception $e) {
        }
        return [];
    }

    private function GetDateDiff($expireDateValue): int
    {
        $dateTimeNow = new DateTime("now");

        $expireDate = new DateTime(date('Y-m-d', strtotime($expireDateValue)));

        $dayExpired = 1;

        if ($dateTimeNow > $expireDate) {
            $dayExpired = -1;
        }

        return ($dateTimeNow->diff($expireDate)->days) * $dayExpired;
    }

    private function GetFirstExpiredService(
        $brandId,
        $tbService
    ): int {
        $firstExpiredServiceDayCount = PHP_INT_MAX;

        try {
            if ($this->userId > 0) {
                foreach ($tbService as $serviceObj) {
                    if (
                        $serviceObj['userid'] == $this->userId
                        &&
                        $serviceObj['brandid'] == $brandId
                        &&
                        $serviceObj['status'] == STATUS_ACTIVE
                        &&
                        $serviceObj['vendor_expire_date'] != ''
                    ) {
                        $dayCount = $this->GetDateDiff(
                            $serviceObj['vendor_expire_date']
                        );

                        if ($dayCount < $firstExpiredServiceDayCount) {
                            $firstExpiredServiceDayCount = $dayCount;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $firstExpiredServiceDayCount = PHP_INT_MIN;
        }

        return $firstExpiredServiceDayCount;
    }

    public function GetUserServiceByName($brandId, $tbService): array
    {
        try {
            if ($this->userId > 0) {
                $userServiceList = array();

                foreach ($tbService as $serviceObj) {
                    if (
                        $serviceObj['userid'] == $this->userId
                        &&
                        $serviceObj['brandid'] == $brandId
                    ) {
                        $serviceObj['vendor_type_name'] = $this->GetVendorType(
                            $serviceObj['vendor_type']
                        );

                        $expireDateDayCount = PHP_INT_MIN;

                        if ($serviceObj['vendor_expire_date'] != STRING_EMPTY) {
                            $expireDateDayCount = $this->GetDateDiff($serviceObj['vendor_expire_date']);
                        }

                        $expireDateArray = $this->GetExpiredDateArray($expireDateDayCount);

                        $serviceObj['vendor_expire_date_day_count'] = $expireDateArray['expire_date_day_count'];
                        $serviceObj['vendor_status'] = $expireDateArray['expire_date_status'];
                        $serviceObj['vendor_status_detail'] =  $expireDateArray['expire_date_status_detail'];



                        array_push($userServiceList, $serviceObj);
                    }
                }

                return $userServiceList;
            }
        } catch (Exception $e) {
        }
        return [];
    }
}
