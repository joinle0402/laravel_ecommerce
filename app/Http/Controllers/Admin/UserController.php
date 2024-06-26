<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\User;
use App\Services\Interfaces\ProvinceService;
use App\Services\Interfaces\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected ProvinceService $provinceService
    ) {}

    public function index(Request $request): View
    {
        $perPage = $request->integer('per_page', 10);
        $users = $this->userService->paginate($perPage, $request->all());
        return view('admin.pages.users.index', compact('users'));
    }

    public function create(): View
    {
        $provinces = $this->provinceService->all();
        return view('admin.pages.users.create', compact('provinces'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = $request->validated();
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $user['avatar'] = Storage::disk('public')->put('images/users/avatar', request()->file('avatar'));
        }
        $this->userService->create($user);
        return redirect()->route('admin.users.index')->with('success', 'Tạo người dùng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('admin.pages.users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    public function destroy(int $id): RedirectResponse
    {
        if (auth()->id() === $id) {
            return back()->with('error', 'Không thể xóa chính người thao tác!');
        } else {
            if (empty($this->userService->deleteById($id))) {
                return back()->with('error', 'Người dùng này không tồn tại!');
            } else {
                return back()->with('success', 'Xóa người dùng thành công!');
            }
        }
    }

    public function deleteMany(Request $request): RedirectResponse
    {
        $deletedIds = $request->get('checkedRows', []);
        if (in_array(auth()->id(), $deletedIds)) {
            return back()->with('error', 'Không thể xóa chính người thao tác!');
        } else {
            if (empty($this->userService->deleteByIds($deletedIds))) {
                return back()->with('error', 'Người dùng này không tồn tại!');
            } else {
                return back()->with('success', 'Xóa người dùng thành công!');
            }
        }
    }
}
