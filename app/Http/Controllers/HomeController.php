<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Auth::user()->status == 1) {
            return view('home');
        } else {
            return redirect('/');
        }
    }
    public function users()
    {
        $data = DB::table('users')->get();

        return view('users', compact('data'));
    }

    public function edit(string $id)
    {
        $user =  User::find($id);


        return view('edit_user', compact('user'));
    }
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id); // ถ้าไม่พบ User ให้แจ้ง Error 404

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // ถ้ามีการเปลี่ยนรหัสผ่านให้ทำการ Hash แล้วอัปเดต
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']); // ถ้าไม่กรอกรหัสผ่าน ให้ใช้ Password เดิม
        }

        // อัปเดตข้อมูล User
        $user->update($validatedData);

        return redirect('users')->with('message', "แก้ไขข้อมูลเรียบร้อยแล้ว");
    }


    public function destroy(string $id)
    {

        $flight =  User::find($id);
        $flight->delete();
        return redirect()->back()->with('message', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}