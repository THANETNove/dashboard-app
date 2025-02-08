<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Message;
use App\Models\Announce;
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

    /**  
     * !  ส่วนของการ loing หรือ สมัครสมัครชิก 
     */
    // 
    public function index()
    {

        if (Auth::user()->status == 1) {

            $messages = Message::latest()->get();

            return view('home', compact('messages'));
        } else {
            return redirect('/');
        }
    }

    /**  
     * !  ส่วนของสมาชิก
     */
    // เเสดง users ทั้งหมด
    public function users()
    {
        $data = DB::table('users')
            ->where("status", '!=', 1)
            ->get();

        return view('users', compact('data'));
    }


    // ไปหน้าเเก้ไข
    public function edit(string $id)
    {
        $user =  User::find($id);


        return view('edit_user', compact('user'));
    }

    // เเก้ไข  update user
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
    // ลบ user
    public function destroy(string $id)
    {

        $flight =  User::find($id);
        $flight->delete();
        return redirect()->back()->with('message', 'ลบข้อมูลเรียบร้อยแล้ว');
    }


    /**  
     * ! ส่วนของ ตั้งกระทู้ใหม่
     */
    // เพิ่ม  กระทู้
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/')->with('message', 'โพสต์ข้อความสำเร็จ');
    }

    // ลบ กระทู้
    public function destroyMessage(string $id)
    {

        $flight =  Message::find($id);
        $flight->delete();
        return redirect()->back()->with('message', 'ลบข้อมูลเรียบร้อยแล้ว');
    }


    /**  
     * ! ส่วนของประกาศ
     */
    //  เเสดง ประกาศ ทั้งหมด
    public function announces()
    {
        $data = Announce::latest()->get();

        return view('announces', compact('data'));
    }

    // ไปหน้า form ประกาศ
    public function createAnnounces()
    {
        return view('create_announces');
    }


    // เพิ่ม ประกาศ

    public function announcesStore(Request $request)
    {


        $request->validate([
            'declare' => 'required|string',
        ]);

        Announce::create([
            'declare' => $request->declare,
        ]);

        return redirect('announces')->with('message', 'โพสต์ข้อความสำเร็จ');
    }
    // ลบ ประกาศ
    public function deleteDeclare(string $id)
    {


        $flight =  Announce::find($id);
        $flight->delete();
        return redirect()->back()->with('message', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
