<?php

namespace App\Repositories\Role;

use App\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class Getter
{
    private string $ROUTE_NAME = 'dashboard.settings.roles.';

    private string $LANG_PATH = 'admin_setting_roles.';

    private array $input = [];

    /**
     * function for prepare input
     */
    public function prepare(array $request): self
    {
        $this->input = $this->formatInput($request);

        return $this;
    }

    /**
     * Melakukan eksekusi proses pengambilan data logs
     */
    public function execute(): mixed
    {
        $input = $this->input;

        $query = Role::select([
            'roles.id as id', 'roles.name as name',
        ]);

        if ($input['search_values'] !== null) {
            $searchValues = '%' . $input['search_values'] . '%';
            $query->whereRaw('roles.name LIKE ?', [$searchValues]);
        }

        $query->orderBy('roles.id', 'ASC');

        if ($input['is_using_yajra'] == 1) {
            return $this->getYajra($query);
        }

        if ($input['is_paginate']) {
            return $query->paginate($input['per_page'])->toArray();
        } else {
            return $query->get()->toArray();
        }
    }

    /**
     * Format get data untuk kebutuhan yajra
     */
    public function getYajra($query)
    {
        return DataTables::of($query)
            ->addIndexColumn()// nomor urut
            ->addColumn('name', function ($query) {
                return $query->name ?? '-';
            })
            ->addColumn('action', function ($query) {
                $editLabel = __('button.edit');
                $editUrl = route($this->ROUTE_NAME . 'edit', ['id' => $query->id]);

                $deleteLabel = __('button.delete');
                $deleteUrl = route($this->ROUTE_NAME . 'delete', ['id' => $query->id]);
                $deleteConfirmation = __('messages.confirmation.delete');

                if (in_array($query->id, Role::IDS_CANNOT_EDIT_OR_DELETE)) {
                    return __('messages.cannot_editable_or_deletable');
                } else {
                    return '
                        <a class="btn btn-sm btn-warning m-1" href="' . $editUrl . '">' . $editLabel . '</a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . method_field('DELETE') . '
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-sm btn-danger m-1" onclick="return confirm(\'' . $deleteConfirmation . '\')">' . $deleteLabel . '</button>
                        </form>
                    ';
                }
            })
            ->rawColumns([])
            ->make(true);
    }

    /**
     * Get one data by id
     *
     * @param array|null
     */
    public function simpleFindOne(int $id): ?array
    {
        $data = Role::select([
            'roles.id as id',
            'roles.name as name',
        ])->find($id);

        if ($data === null) {
            return null;
        }

        return $data->toArray();
    }

    /**
     * Get one data by id with specific option
     */
    public function findOne(int $id, bool $withPermission, bool $isTree): ?array
    {
        $role = Role::findOrFail($id);

        if ($withPermission) {
            $permissionRole = $role->permissions;
            $role['permissions'] = $permissionRole->toArray();
        }

        return $role->toArray();
    }

    /**
     * Melakukan proses formatting input
     */
    private function formatInput(array $request): array
    {
        $input = [
            'is_paginate' => $request['is_paginate'] ?? true,
            'per_page' => $request['per_page'] ?? config('values.default_per_page'),
            'is_using_yajra' => $request['is_using_yajra'] ?? 1,
            'page' => $request['page'] ?? 1,
            'search_values' => $request['search_values'] ?? null,
        ];

        return $input;
    }
}
