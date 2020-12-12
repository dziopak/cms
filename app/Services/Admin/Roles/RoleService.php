<?php

namespace App\Services\Admin\Roles;

use App\Interfaces\Repositories\RoleRepositoryInterface;
use App\Services\Admin\BaseAdminService;

class RoleService extends BaseAdminService
{
    const ENTITY_SINGULAR = 'role';
    const ENTITY_PLURAL = 'roles';
    const ROUTE = 'admin.users.roles';

    public function __construct(RoleRepositoryInterface $repository)
    {
        parent::__construct($repository);

        $this->queries = [
            'index' => [
                'table' => getData('Admin/Modules/Roles/roles_index_table'),
            ],
            'create' => [
                'form' => getData('Admin/Modules/Roles/roles_form')
            ]
        ];
    }

    public function edit($id, $params = null)
    {
        $this->queries['edit'] = [
            'form' => getData('Admin/Modules/Roles/roles_form'),
            'role' => $this->repository->find($id)->withPermissions()
        ];

        return parent::edit($id, []);
    }

    public function store($request, $params = null)
    {
        $after = function ($item) use ($request) {
            $permissions = [];
            foreach ($request->get('access') as $permission => $value) {
                if ($value == true) $permissions[] = [
                    'role_id' => $item->id,
                    'name' => $permission
                ];
            }
            $item->permissions()->insert($permissions);
        };

        return parent::store($request, [
            'after' => $after
        ]);
    }

    public function update($request, $id, $params = null)
    {
        $after = function () use ($request, $id) {
            $role = $this->repository->find($id);
            $access = $role->permissions()->pluck('name')->toArray();

            foreach ($request->get('access') as $permission => $value) {
                if (!in_array($permission, array_values($access)) && $value == true) {
                    $role->permissions()->create([
                        'name' => $permission,
                    ]);
                } else if (in_array($permission, array_values($access)) && $value == false) {
                    $role->permissions()->where('name', $permission)->delete();
                }
            }
        };

        return parent::update($request, $id, [
            'after' => $after
        ]);
    }
}
