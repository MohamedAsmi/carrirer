<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Service\UserService;
use App\Http\Requests\StoreuserRequest;
use App\Http\Requests\UpdateuserRequest;
use App\Models\role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('admin.user.index');
    }

    public function list()
    {
        $UserListDatatable = $this->userService->UserListDatatable();
        return $UserListDatatable;
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(StoreuserRequest $request)
    {
        $isAdmin = ($request->has('is_admin')) ? User::USER_ADMIN : User::USER_USER;
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->image =  $imageName ?? '';
        $user->is_admin = $isAdmin;
        $user->save();

        return self::response('success', 'Successfully User Created!');
    }

    public function show($id)
    {
        $user = user::findById($id);
        return view('admin.modals.show_user_modal', compact('user'));
    }

    public function edit($id)
    {
        $user = user::findById($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(StoreuserRequest $request, $id)
    {
        $isAdmin = ($request->has('is_admin')) ? User::USER_ADMIN : User::USER_USER;
        $user = user::findById($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if ($request->has('password'))
            $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image =  $imageName;
        }
        $user->is_admin = $isAdmin;
        $user->save();
        return self::response('success', 'Successfully User Updated!');
    }

    public function delete($id)
    {
        $user = user::findById($id);
        $user->delete();
        return self::response('success', 'Deleted!');
    }
    public function destroy($id)
    {
        //
    }
}
