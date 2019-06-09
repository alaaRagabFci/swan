<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Services\UserService;
use App\User;
use Auth;
use Hash;

class AdminController extends AbstractController {

    public function __construct(UserService $userService)
	{
		$this->middleware('auth');
		$this->userService = $userService;
	}

//dashboard
	public function dashboard(Request $request)
	{
        return view('dashboard')
		     ->with('modal','noModal');
	}

//profile info
    public function profile(Request $request)
    {
        $user = $this->userService->getAdmin(Auth::user()->id);
        return view('profile')
            ->with('modal','noModal')
            ->with('flag',0)
            ->with('info',$user);
    }
//set personal info
    public function updateUser(Request $request)
    {
        $this->validate($request,
            [
                'name' =>'required',
                'email'=>'required',
            ]);

        $user = $this->userService->updateUser(Auth::user()->id, $request->all());
        return Redirect::back()
            ->with('msg', 'تم التحديث بنجاح')
            ->with('flag',1);
    }
//set Avatar
    public function updateAdminImage(Request $request)
    {
        $this->validate($request,
            [
                'profile_image' =>'required|max:1024',
            ]);

        if(Input::hasFile('profile_image')){
            $allowedExts = array("jpeg", "jpg", "png", "gif");
            $file = Input::file('profile_image');
            $ext  = pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION);

            if(in_array($ext,$allowedExts)){
                $filename =Auth::id().".png";
                $file->move('admin_ui', $filename);
                $msg = 'تم التحديث بنجاح';
            }
            else{
                $msg = 'يجب اختيار صوره من هذه الأنواع "jpeg", "jpg", "png", "gif"';
            }
        }

        return Redirect::back()
            ->with('msg', $msg)
            ->with('flag',1);
    }
//set Password
    public function set_password(Request $request)
    {

        $info = User::find(Auth::user()->id);

        if(Hash::check($request->old_pass, Auth::user()->password)){
            $info->password = bcrypt($request->new_pass);
            $info->save();

            $msg="تم التحديث بنجاح";
        }
        else{
            $msg="الرقم السري القديم خطأ";
        }
        return Redirect::back()
            ->with('msg', $msg)
            ->with('flag',1);
    }

    static function hashSSHA_password($password) {
        $encrypted = base64_encode(sha1($password , true));
        $hash = array("encrypted" => $encrypted);
        return $hash;
    }

    static function hashSSHA_token($x,$y,$z) {
        $encrypted = base64_encode(sha1($x . $y . $z, true));
        $encrypted = str_replace("/","",$encrypted);
        $hash = array("encrypted_token" => $encrypted);
        return $hash;
    }

}
