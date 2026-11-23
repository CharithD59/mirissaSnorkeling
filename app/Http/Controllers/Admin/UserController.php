<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends AdminController
{
    public function index()
    {
        $users = User::orderBy('username')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form', ['user' => new User(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['password'] = Hash::make($request->input('password'));
        $data['role'] = 'admin';
        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Admin user "' . $data['username'] . '" created.');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validated($request, $user);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
        if ($user->id === Auth::id()) {
            $data['is_active'] = true; // you cannot lock yourself out
        }
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Admin user "' . $user->username . '" updated.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }
        if (User::where('is_active', true)->where('id', '!=', $user->id)->count() === 0) {
            return back()->with('error', 'At least one active admin account must remain.');
        }
        $user->delete();

        return back()->with('success', 'Admin user deleted.');
    }

    public function profile()
    {
        return view('admin.users.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'name'             => 'required|string|max:191',
            'email'            => ['required', 'email', 'max:191', Rule::unique('users', 'email')->ignore($user->id)],
            'current_password' => 'nullable|required_with:password|string',
            'password'         => 'nullable|string|min:3|max:191|confirmed',
        ];
        $data = $request->validate($rules);
        $data = array_merge(array_fill_keys(array_keys($rules), null), $data);

        if ($request->filled('password')) {
            if (!Hash::check($data['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Your current password is incorrect.'])->withInput();
            }
            $user->password = Hash::make($data['password']);
        }
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        return back()->with('success', 'Profile updated.');
    }

    protected function validated(Request $request, User $user = null)
    {
        $id = $user ? $user->id : null;
        $rules = [
            'name'     => 'required|string|max:191',
            'username' => ['required', 'alpha_dash', 'min:3', 'max:60', Rule::unique('users', 'username')->ignore($id)],
            'email'    => ['required', 'email', 'max:191', Rule::unique('users', 'email')->ignore($id)],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:3', 'max:191', 'confirmed'],
        ];
        $data = $request->validate($rules);
        $data = array_merge(array_fill_keys(array_keys($rules), null), $data);

        return [
            'name'      => $data['name'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'is_active' => $request->boolean('is_active'),
        ];
    }
}
