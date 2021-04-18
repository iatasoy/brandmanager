<?php

$app->get(
    '/',
    function (
        $request,
        $response,
        $args
    ) {
        global $configObj;
       
        if ($configObj->IsUserSessionAvailable()) {
            return $response->withRedirect(
                $configObj->Redirect($configObj->GetRouteConfiguration()->ROUTE_URL_BRAND)
            );
        }
                
        return $this->view->render(
            $response,
            ($configObj->GetRouteConfiguration())->GetHtmlTemplateName(
                    ($configObj->GetRouteConfiguration())->TEMPLATE_BASE_URL
                ),
            [
                'WEBSITEOBJ' => $configObj->GetWebSiteSettingToArray(),
                'ROUTEOBJ' => ($configObj->GetRouteConfiguration())->toArray(),
                'LANGUAGEOBJ' => ($configObj->GetMessageContainer())->toArray(),
                'USEROBJ' => $_SESSION['USEROBJ'] ?? []
            ]
        );
    }
);
