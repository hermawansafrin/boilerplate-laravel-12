<?php

namespace App\Http\Controllers\Web;

class DashboardController extends BaseController
{
    private string $ROUTE_PATH = 'admin.dashboard.';

    private string $BLADE_PATH = 'admin.';

    private string $LANG_PATH = 'admin_dashboard.';

    private ?string $PARENT_PERMISSION_NAME = null;

    private string $PERMISSION_NAME = 'home';

    /**
     * get const datas
     */
    private function getConstDatas(): array
    {
        return [
            'ROUTE_PATH' => $this->ROUTE_PATH,
            'BLADE_PATH' => $this->BLADE_PATH,
            'LANG_PATH' => $this->LANG_PATH,
            'PARENT_PERMISSION_NAME' => $this->PARENT_PERMISSION_NAME,
            'PERMISSION_NAME' => $this->PERMISSION_NAME,
        ];
    }

    /**
     * show index page
     */
    public function index()
    {
        $init = $this->init();
        $dataView = array_merge(
            $init,
            $this->getConstDatas(),
            $this->prepareActiveMenu([$this->PERMISSION_NAME]),
            [
                'title' => __($this->LANG_PATH . 'index.title'),
            ]
        );

        return view($this->BLADE_PATH . 'index', $dataView);
    }
}
