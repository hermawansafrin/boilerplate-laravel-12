<?php

namespace App\Helpers;

use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

/**
 * Class for prepareing data menu based on permission
 */
class MenuHelper
{
    private static array $translates = [];

    /**
     * Get menus data by logged in user
     */
    public static function getMenus(bool $onlyAllowedPermissions): array
    {
        $menus = [];
        $authRepo = app(AuthRepository::class);

        /** if there is no logged in user, return empty menus */
        if (! $authRepo->isLogin()) {
            return $menus;
        }

        // TODO: CACHE PER USER
        self::$translates = self::getTranslates();

        $fileName = 'menu.json';
        $path = resource_path("menu/{$fileName}");
        $menus = self::menuMultiLanguage(
            json_decode(file_get_contents($path), true),
        );

        if ($onlyAllowedPermissions) {
            $allowedMenus = [];

            $user = Auth::user();
            /** get all permission logged in user */
            $allPermissionUser = $user->getAllPermissions()->pluck('name')->values()->toArray();
            array_unshift($allPermissionUser, 'home'); // add home for default route pages

            $index = 0;
            foreach ($menus as $key => $menu) {
                if (in_array($menu['permission'], $allPermissionUser)) {
                    /** if there is no sub menu, force attach */
                    $allowedMenus[$index] = $menu;
                    if (isset($menu['sub'])) {
                        /** if there is sub, must check first */
                        foreach ($menu['sub'] as $keySub => $sub) {
                            if (! in_array($sub['permission'], $allPermissionUser)) {
                                unset($allowedMenus[$index]['sub'][$keySub]);
                            }
                        }
                    }
                    $index++;
                }
            }

            /** if you want to hide permission menu temporary, enable this */
            $hiddenPermissionMenus = [
                // 'some_permission_name',
            ];

            if (count($hiddenPermissionMenus) > 0) {
                /** lakukan hide */
                foreach ($allowedMenus as $key => $allowedMenus) {
                    if (in_array($allowedMenus['permission'], $hiddenPermissionMenus)) {
                        unset($allowedMenus[$key]);

                        continue;
                    }

                    if (isset($allowedMenus['sub']) && count($allowedMenus['sub']) > 0) {
                        foreach ($allowedMenus['sub'] as $subKey => $subAllowedMenu) {
                            if (in_array($subAllowedMenu['permisison'], $hiddenPermissionMenus)) {
                                unset($allowedMenus[$key]['sub'][$subKey]);
                            }
                        }
                    }

                    return array_values($allowedMenus);
                }
            }

            return $allowedMenus;
        }

        return $menus;
    }

    /**
     * Get menus data by multi language
     */
    private static function menuMultiLanguage(array $lang): array
    {
        $lang = collect($lang)->map(function ($item, $key) {
            if (! empty($item['title'])) {
                $name = $item['title'];
                $item['title'] = self::$translates[$name];
                $item['name'] = $name;
            }

            if (isset($item['sub'])) {
                foreach ($item['sub'] as $key => $value) {
                    $name = $value['title'];
                    $item['sub'][$key]['title'] = self::$translates[$name];
                    $item['sub'][$key]['name'] = $name;
                }
            }

            return $item;
        })->all();

        return $lang ?? [];
    }

    /**
     * Get all translates from menu file
     */
    private static function getTranslates(): array
    {
        $file = 'menu';
        $langs = Lang::get($file);

        $translations = [];

        foreach ($langs as $name => $value) {
            $translations[$name] = $value;
        }

        return $translations;
    }
}
