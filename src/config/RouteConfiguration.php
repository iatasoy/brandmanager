<?php

class RouteConfiguration
{
    public $ROUTE_URL_BASE = '/';
    public $ROUTE_URL_LOGIN = 'login';
    public $ROUTE_URL_LOGOUT = 'logout';
    public $ROUTE_URL_SERVICE_BASE = 'service';
    public $ROUTE_URL_SERVICE = 'service/{name}/{brandid}';
    public $ROUTE_URL_BRAND = 'brand';


    public $TEMPLATE_BASE_URL = '/';
    public $TEMPLATE_ROUTE_URL_NOTFOUND = 'notfound';
    public $TEMPLATE_ROUTE_URL_SERVICE = 'service';
    public $TEMPLATE_ROUTE_URL_BRAND = 'brand';

    public function GetHtmlTemplateName(
        string $routeName
    ): string {

        $htmlTemplateArray = array(
            $this->TEMPLATE_BASE_URL => "index.html",
            $this->TEMPLATE_ROUTE_URL_NOTFOUND => "index/notfound.html",
            $this->TEMPLATE_ROUTE_URL_BRAND => "user/brand.html",
            $this->TEMPLATE_ROUTE_URL_SERVICE => "user/service.html"
        );

        if (array_key_exists(strtolower($routeName), $htmlTemplateArray)) {
            return $htmlTemplateArray[strtolower($routeName)];
        } else {
            return $htmlTemplateArray[$this->TEMPLATE_ROUTE_URL_NOTFOUND];
        }
    }

    public function toArray(): array
    {
        return array(
            'LOGIN_URL' => $this->ROUTE_URL_LOGIN,
            'LOGOUT_URL' => $this->ROUTE_URL_LOGOUT,
            'SERVICE_BASE_URL' => $this->ROUTE_URL_SERVICE_BASE,
            'SERVICE_URL' => $this->ROUTE_URL_SERVICE
        );
    }
}
