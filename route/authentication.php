<?php

$app->get(
    '/' . ($configObj->GetRouteConfiguration())->ROUTE_URL_LOGIN,
    function (
        $request,
        $response,
        $args
    ) {
        global $configObj;

        return $response->withRedirect($configObj->Redirect());
    }
);

$app->post(
    '/' . ($configObj->GetRouteConfiguration())->ROUTE_URL_LOGIN,
    function (
        $request,
        $response,
        $args
    ) {
        global $configObj;
        global $tbUser;

        if ($configObj->IsUserSessionAvailable()) {
            return $response->withRedirect(
                $configObj->Redirect($configObj->GetRouteConfiguration()->ROUTE_URL_BRAND)
            );
        }

        $baseFacadeObj = new BaseFacade($configObj, $request->getParsedBody());

        $responseArray = $baseFacadeObj->Login($tbUser);

        if ($responseArray['STATUS'] == HttpStatusCodes::OK) {
            return $response->withRedirect(
                $configObj->Redirect(
                    $configObj->GetRouteConfiguration()->ROUTE_URL_BRAND
                )
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
                'POSTRESULTOBJ' => $responseArray,
                'USEROBJ' => $_SESSION['USEROBJ'] ?? []
            ]
        );
    }
);

$app->get(
    '/' . ($configObj->GetRouteConfiguration())->ROUTE_URL_LOGOUT,
    function (
        $request,
        $response,
        $args
    ) {
        global $configObj;

        if (!$configObj->IsUserSessionAvailable()) {
            return $response->withRedirect(
                $configObj->Redirect()
            );
        }

        unset($_SESSION['USEROBJ']);

        return $response->withRedirect($configObj->Redirect());
    }
);
