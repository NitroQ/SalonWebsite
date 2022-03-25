<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use Session;
use Validator;
use Hash;
use Log;
use DB;

class UserController extends Controller
{
    //
    protected function login() {
		if (!Auth::check())
			return view('login');
		elseif(Auth::check())
			return redirect('admin/dashboard');
		else
			return redirect()->back();
	}
    protected function create(Request $req) {
		return view('admin.users.create');
	}

	public function authenticate()
    {
        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password'),
        ];
        
        if(!Auth::attempt($credentials))
        {
            auth()->logout();
            Session::flash('flash_error','Wrong username/password!');

            return redirect()->back();
        }

        $user = Auth::user();
        
        Session::flash('flash_message','Logged in!');

        return redirect()
            ->route('admin.dashboard')
            ->with('flash_message', 'Logged in!');
    }

	

	protected function logout() {
		if (Auth::check()) {
			auth()->logout();
			return redirect('/logout')->with('flash_success', 'Logged out!');
		}
		return redirect('/')->with('flash_error', 'Something went wrong, please try again.');
	}

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function index(Request $req) {
		$users = User::query();

		if ($req->has('search')) {
			$search = $req->search;
			$s = '%'.$search.'%';

			$users = $users->where('users.username', 'LIKE', $s)
				->orWhere('users.id', 'LIKE', $s)
				->orWhere('users.first_name', 'LIKE', $s)
				->orWhere('users.last_name', 'LIKE', $s)
				->orWhere('users.email', 'LIKE', $s)
				->orWhere('users.type', 'LIKE', $s);
		}

		return view('admin.users.index', [
			'search' => $req->search,
			'users' => $users->get()
		]);
	}

    protected function store(Request $req) {
		$validator = Validator::make($req->all(), [
			'first_name' => 'required|min:2',
			'last_name' => 'required|min:2',
			'username' => 'required|min:2',
			'email' => 'required|email|unique:users,email',
          	'password' => array('required','min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*()-=_+\\|;:\'",.\/?]).*$/'),
			'rep_password' => 'required|same:password',
			'user_type' => array('required', 'regex:/(^admin$|^manager$)/'),
		], [
			'first_name.required' => 'First Name is required.',
			'first_name.min' => 'Please provide a proper name.',
			'last_name.required' => 'Last Name is required.',
			'last_name.min' => 'Please provide a proper name.',
			'username.required' => 'Username is required',
			'username.min' => 'Username is short',
			'email.required' => 'E-mail is required.',
			'email.unique' => 'Your email is already in the database.',
			'email.email' => 'E-mail provided is not a valid e-mail.',
          'password.required' => 'Password is required.',
			'password.min' => 'Password should be minimum of 8 characters, with at least one capitalized letter, a number and a special character.',
			'password.regex' => 'Password should be minimum of 8 characters, with at least one capitalized letter, a number and a special character.',
			'rep_password.required' => 'Please repeat your password.',
			'rep_password.same' => 'Repeated password should be the same as the password.',
			'user_type.required' => 'User type is required.',
			'user_type.regex' => 'Please refrain from modifying the page.',
		]);
		if ($validator->fails()){
			return redirect()
				->back()
				->withErrors($validator)
				->withInput();
        }
		try {
			DB::beginTransaction();

			$user = User::create([
				'first_name' => $req->first_name,
				'last_name' => $req->last_name,
				'username' => $req->username,
				'email' => $req->email,
                'password' => Hash::make($req->password),
				'type' => $req->user_type,
			]);

			DB::commit();
		
		} catch (\Exception $e) {
			Log::error($e);
			DB::rollback();

			return redirect()
				->back()
				->with('flash_error', 'Something went wrong, please try again later.')
				->withInput();
		}

		return redirect()
			->route('admin.users.index')
			->with('flash_success', 'Successfully added "' . $req->first_name . ' ' . $req->last_name . '."');
	}

	protected function edit($id) {
		$user = User::find($id);
		return view('admin.users.edit', [
			'user' => $user
		]);
	}

	protected function update(Request $req, $id) {
		$validator = Validator::make($req->all(), [
		
			'first_name' => 'required|min:2',
			'last_name' => 'required|min:2',
			'username' => 'required|min:2',
			'email' => 'required|email',

			'user_type' => array('required', 'regex:/(^admin$|^manager$)/'),
		], [
			'first_name.required' => 'First Name is required.',
			'first_name.min' => 'Please provide a proper name.',
			'last_name.required' => 'Last Name is required.',
			'last_name.min' => 'Please provide a proper name.',
			'username.required' => 'Username is required',
			'username.min' => 'Username is short',
			'email.required' => 'E-mail is required.',
			'email.email' => 'E-mail provided is not a valid e-mail.',
    		'user_type.required' => 'User type is required.',
			'user_type.regex' => 'Please refrain from modifying the page.',
		]);

		if ($validator->fails())

			return redirect()
				->back()
				->withErrors($validator)
				->withInput();

		try {
			DB::beginTransaction();

			$user = User::find($id);
			$user->first_name = $req->first_name;
			$user->last_name = $req->last_name;
			$user->username = $req->username;
			$user->email = $req->email;
			$user->password = Hash::make($req->password);
			$user->type = $req->user_type;
			$user->save();

			DB::commit();
		} catch (\Exception $e) {
			Log::error($e);
			DB::rollback();

			return redirect()
				->back()
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()
			->route('admin.users.index')
			->with('flash_success', 'Successfully updated "' . $user->first_name . ' ' . $user->last_name . '."');
	}

	public function destroy($id)
    {
        $po = User::find($id);

		if ($po == null)
			return redirect()
				->route('admin.users.index')
				->with('flash_info', 'User doesn\'t exists! Please try to refresh the page.');

		try {
			DB::beginTransaction();

			$po->delete();

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return redirect()
				->route('admin.users.index')
				->with('flash_error', 'Something went wrong, please try again later.');
		}
		return redirect()
			->back()
			->with('flash_success', 'Successfully removed user.');
    
    }
}
