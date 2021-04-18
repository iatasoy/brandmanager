<?php

$app->get(
    '/' . $configObj->GetRouteConfiguration()->ROUTE_URL_BRAND,
    function (
        $request,
        $response,
        $args
    ) {
        global $configObj;
        global $tbBrand;
        global $tbService;

        if (!$configObj->IsUserSessionAvailable()) {
            return $response->withRedirect(
                $configObj->Redirect($configObj->GetRouteConfiguration()->ROUTE_URL_BASE)
            );
        }

        $baseFacadeObj = new BaseFacade(
            $configObj,
            $request->getParsedBody()
        );

        $userBrandList = $baseFacadeObj->GetUserBrand(
            $tbBrand,
            $tbService
        );

        return $this->view->render(
            $response,
            ($configObj->GetRouteConfiguration())->GetHtmlTemplateName(
                ($configObj->GetRouteConfiguration())->TEMPLATE_ROUTE_URL_BRAND
            ),
            [
                'WEBSITEOBJ' => $configObj->GetWebSiteSettingToArray(),
                'ROUTEOBJ' => ($configObj->GetRouteConfiguration())->toArray(),
                'LANGUAGEOBJ' => ($configObj->GetMessageContainer())->toArray(),
                'BRAND_LIST' => $userBrandList ?? []
            ]
        );
    }
);

$app->get(
    '/' . $configObj->GetRouteConfiguration()->ROUTE_URL_SERVICE,
    function (
        $request,
        $response,
        $args
    ) {
        global $configObj;
        global $tbService;

        if (!$configObj->IsUserSessionAvailable()) {
            return $response->withRedirect(
                $configObj->Redirect($configObj->GetRouteConfiguration()->ROUTE_URL_BASE)
            );
        }

        $baseFacadeObj = new BaseFacade(
            $configObj,
            $request->getParsedBody()
        );

        $userServiceList = $baseFacadeObj->GetUserServiceByName(
            $args['brandid'],
            $tbService
        );

        return $this->view->render(
            $response,
            ($configObj->GetRouteConfiguration())->GetHtmlTemplateName(
                ($configObj->GetRouteConfiguration())->TEMPLATE_ROUTE_URL_SERVICE
            ),
            [
                'WEBSITEOBJ' => $configObj->GetWebSiteSettingToArray(),
                'ROUTEOBJ' => ($configObj->GetRouteConfiguration())->toArray(),
                'LANGUAGEOBJ' => ($configObj->GetMessageContainer())->toArray(),
                'SERVICE_NAME' => $args['name'] ?? '',
                'SERVICE_LIST' => $userServiceList ?? []
            ]
        );
    }
);
