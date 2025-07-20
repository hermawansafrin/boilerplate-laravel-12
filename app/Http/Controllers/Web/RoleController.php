<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Role\DeleteRequest;
use App\Http\Requests\Role\FindOneRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends BaseController
{
    private string $ROUTE_PATH = 'dashboard.settings.roles.';

    private string $BLADE_PATH = 'admin.settings.roles.';

    private string $LANG_PATH = 'admin_setting_roles.';

    private string $PARENT_PERMISSION_NAME = 'settings';

    private string $PERMISSION_NAME = 'settings_role';

    public RoleRepository $repo;

    /**
     * constructor
     */
    public function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * get constant datas for this controller
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
            $this->prepareActiveMenu([$this->PARENT_PERMISSION_NAME, $this->PERMISSION_NAME]),
            [
                'title' => __($this->LANG_PATH . 'title'),
                'subtitle' => __($this->LANG_PATH . 'index.subtitle'),
            ]
        );

        return view($this->BLADE_PATH . 'index', $dataView);
    }

    /**
     * show create page
     */
    public function create()
    {
        $init = $this->init();
        $permissionRepo = app(PermissionRepository::class);
        $permissions = $permissionRepo->get();

        $dataView = array_merge(
            $init,
            $this->getConstDatas(),
            $this->prepareActiveMenu([$this->PARENT_PERMISSION_NAME, $this->PERMISSION_NAME]),
            [
                'title' => __($this->LANG_PATH . 'title'),
                'subtitle' => __($this->LANG_PATH . 'create.subtitle'),
                'permissions' => $permissions,
            ]
        );

        return view($this->BLADE_PATH . 'create', $dataView);
    }

    /**
     * Do storeing role on db
     */
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        DB::beginTransaction();
        try {
            $data = $this->repo->create($input);
            DB::commit();

            return redirect()
                ->route($this->ROUTE_PATH . 'index')
                ->with(
                    'status_success',
                    __('messages.session.success.subtitle', [
                        'action' => __('messages.action_add'),
                    ])
                );

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    /**
     * show edit page
     */
    public function edit(FindOneRequest $request, int $id)
    {
        $init = $this->init();

        $permissionRepo = app(PermissionRepository::class);
        $role = $this->repo->findOne($id, true, false); // with permisison and not flatten

        $editedData = [
            'role' => $role,
            'permission_role_name' => collect($role['permissions'])->pluck('name')->values()->toArray() ?? [],
            'permissions' => $permissionRepo->get(),
        ];

        $dataView = array_merge(
            $init,
            $this->getConstDatas(),
            $this->prepareActiveMenu([
                $this->PARENT_PERMISSION_NAME,
                $this->PERMISSION_NAME,
            ]),
            ['title' => __($this->LANG_PATH . 'title'), 'subtitle' => __($this->LANG_PATH . 'edit.subtitle')],
            ['params' => ['id' => $id]],
            ['editedData' => $editedData],
        );

        return view($this->BLADE_PATH . 'edit', $dataView);
    }

    /**
     * Do updating role on db
     */
    public function update(UpdateRequest $request, int $id)
    {
        $input = $request->validated();

        DB::beginTransaction();
        try {
            $data = $this->repo->update($id, $input);
            DB::commit();

            return redirect()
                ->route($this->ROUTE_PATH . 'index')
                ->with(
                    'status_success',
                    __('messages.session.success.subtitle', ['action' => __('messages.action_edit')])
                );
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    /**
     * Do deleting role on db
     */
    public function destroy(DeleteRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $this->repo->delete($id);
            DB::commit();

            return redirect()
                ->route($this->ROUTE_PATH . 'index')
                ->with(
                    'status_success',
                    __('messages.session.success.subtitle', ['action' => __('messages.action_delete')])
                );
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    /**
     * get data with yajra format
     */
    public function getYajra(Request $request)
    {
        $input = $request->all();
        $input['is_using_yajra'] = 1;

        return $this->repo->get($input);
    }
}
