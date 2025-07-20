<?php

namespace App\Repositories\User;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class Getter
{
    private string $ROUTE_NAME = 'dashboard.settings.users.';

    private string $LANG_PATH = 'admin_setting_users.';

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

        $query = User::select([
            'users.id as id',
            'users.name as name',
            'users.email as email',
            'users.is_active as is_active',
        ])
            ->with('roles');

        if ($input['search_values'] !== null) {
            $searchValues = '%' . $input['search_values'] . '%';
            $query->whereRaw('users.name LIKE ?', [$searchValues]);
        }

        $query->orderBy('users.name', 'ASC');

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
            ->addColumn('email', function ($query) {
                return $query->email ?? '-';
            })
            ->addColumn('role', function ($query) {
                return $query->getRoleNames()[0] ?? '-';
            })
            ->addColumn('active_status', function ($query) {
                return $query->is_active ? __('general.active') : __('general.inactive');
            })
            ->addColumn('action', function ($query) {
                $editLabel = __('button.edit');
                $editUrl = route($this->ROUTE_NAME . 'edit', ['id' => $query->id]);

                $deleteLabel = __('button.delete');
                $deleteUrl = route($this->ROUTE_NAME . 'delete', ['id' => $query->id]);
                $deleteConfirmation = __('messages.confirmation.delete');

                return '
                    <a class="btn btn-sm btn-warning m-1" href="' . $editUrl . '">' . $editLabel . '</a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                        ' . method_field('DELETE') . '
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-sm btn-danger m-1" onclick="return confirm(\'' . $deleteConfirmation . '\')">' . $deleteLabel . '</button>
                    </form>
                ';
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
        $data = User::select([
            'users.id as id',
            'users.name as name',
            'users.email as email',
            'users.is_active as is_active',
        ])->find($id);

        if ($data === null) {
            return null;
        }

        return $data->toArray();
    }

    /**
     * Find one user by id
     */
    public function findOne(int $id): ?array
    {
        $data = User::select([
            'users.id as id',
            'users.name as name',
            'users.email as email',
            'users.is_active as is_active',
        ])->find($id);

        if ($data === null) {
            return null;
        }

        $data['role'] = $data->roles()->get()[0] ?? null;
        if ($data['role'] !== null) {
            $data['role'] = $data['role']->toArray();
        }

        return $data->toArray();
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
