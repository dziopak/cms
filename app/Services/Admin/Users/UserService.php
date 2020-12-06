<?php

namespace App\Services\Admin\Users;

use App\Events\Users\UserBlockEvent;
use App\Events\Users\UserNewPasswordEvent;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Services\Admin\BaseAdminService;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserService extends BaseAdminService
{
    const ENTITY_SINGULAR = 'user';
    const ENTITY_PLURAL = 'users';
    const ROUTE = 'admin.users';

    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function index($request, $params = null)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        $users = $this->repository->getModel()->with('role', 'photo');

        return view('admin.users.index', [
            'users' => $users->filter($request)->paginate(15)
        ]);
    }


    public function store($request, $params = null)
    {
        $this->getAccess('create');

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $this->repository->store($data);

        return redirect(route('admin.users.index'));
    }


    public function update($request, $id, $params = null)
    {
        if ($request->get('request') === 'photo') {
            return $this->updateThumbnail($id, $request->get('file'));
        }
        return parent::update($request, $id);
    }


    public function setUserPassword($request, $id)
    {
        $this->getAccess('edit');

        $item = $this->repository->find($id);
        $item->fire_events = false;
        $item->update(['password' => Hash::make($request->password)]);

        event(new UserNewPasswordEvent($item));

        return $this->redirect('index', 'crud', 'Successfully updated user\'s password');
    }


    public function disable($id)
    {
        $this->getAccess('edit');

        return view('admin.users.disable', [
            'user' => $this->repository->find($id)
        ]);
    }


    public function block($id)
    {
        $this->getAccess('edit');

        $item = $this->repository->find($id);
        $item->update(['is_active' => !$item->is_active]);
        event(new UserBlockEvent($item));

        return $this->redirect('index', 'crud', 'Successfully user\'s account status');
    }


    public function updateThumbnail($user_id, $file_id)
    {
        $this->getAccess('edit');
        $user = $this->repository->find($user_id);
        $user->fire_events = false;

        $user->update(['avatar' => $file_id]);
        $path = \App\Entities\File::select('path')->find($file_id)->path;

        return response()->json([
            'message' => __('admin/messages.users.update.thumbnail.success'),
            'file' => $file_id,
            'path' => $path ?? 'assets/no-thumbnail.png'
        ]);
    }
}
