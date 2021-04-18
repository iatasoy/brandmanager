<?php

class Configuration
{
    private $messageContainerObj;
    private $routeConfigObj;
    private $baseUrl;

    public function __construct(string $absolutePath)
    {
        $this->absolutePath = $absolutePath;
        $this->baseUrl = ($_SERVER['HTTP_HOST'] == "localhost") ?
            "http://localhost/www.thypax.com/brandmanager/" :
            "http://www.thypax.com/brandmanager/";
    }

    public function GetSlim3ContainerSetting(): array
    {
        return array(
            'settings' => [
                'displayErrorDetails' => ($_SERVER['HTTP_HOST'] == "localhost"),
            ],
        );
    }

    public function GetWebSiteSettingToArray(): array
    {
        return array(
            'INDEX_URL' => $this->baseUrl,
            'CDN_URL' => $this->baseUrl . 'assets/'
        );
    }

    public function Redirect(string $routeUrl = ''): string
    {
        return $this->baseUrl . $routeUrl;
    }

    public function IsUserSessionAvailable(): bool
    {
        if (isset($_SESSION['USEROBJ']) == true) {
            return true;
        }
        return false;
    }

    public function SetRouteConfiguration(RouteConfiguration $routeConfigObj)
    {
        $this->routeConfigObj = $routeConfigObj;
    }
    public function SetMessageContainer(MessageContainer $messageContainerObj)
    {
        $this->messageContainerObj = $messageContainerObj;
    }

    public function GetRouteConfiguration(): RouteConfiguration
    {
        return $this->routeConfigObj;
    }
    public function GetMessageContainer(): MessageContainer
    {
        return $this->messageContainerObj;
    }
}
