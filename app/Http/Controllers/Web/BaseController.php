<?php

namespace App\Http\Controllers\Web;

use App\Helpers\MenuHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Initialize the controller for access controller page
     */
    protected function init(): array
    {
        $menus = MenuHelper::getMenus(true);
        $user = UserHelper::getUserData();

        return [
            'menus' => $menus,
            'user' => $user,
        ];
    }

    /**
     * Prepare active menu
     */
    protected function prepareActiveMenu(array $datas): array
    {
        $maxDepth = 2; // for now max dept only 2
        /** @var array $results */
        $results = [];

        for ($i = 0; $i < 2; $i++) {
            $prefixKey = 'isActive';
            $currentLevel = $i + 1;
            $currentKey = "{$prefixKey}{$currentLevel}";

            $results[$currentKey] = null; // default
            /** if there is index related, then fill as value isActive */
            if (isset($datas[$i])) {
                $results[$currentKey] = $datas[$i];
            }
        }

        return $results;
    }
}
