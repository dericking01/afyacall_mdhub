<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SmsHelper;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $user = User::create($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }

        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5',
            'new_password' => 'required|min:5',
            'confirm' => 'required|same:new_password'
        ]);
        if (Hash::check($request->get('password'), auth()->user()->password)) {
            $user = User::find(auth()->user()->id);
            $user->password = Hash::make($request->get('new_password'));
            if ($user->save()) {
                return response()->json('Ok', 200);
            }
        } else {
            return response()->json('Ok', 500);
        }
    }

    public function userChangeStatus(Request $request)
    {

        $user = User::find(Auth::id());
        $number = $user->phone;
        $doctor_id = $user->id;
        if ($request->status == 0) {
            try {
                $client = new \GuzzleHttp\Client();
                $client->request('GET', 'http://192.168.1.4/afyacall.php', [
                    'query' => [
                        'phone' => $number,
                        'status' => 1,
                        'doctor_id' => $doctor_id

                    ]
                ]);
                //update user status
                $user->status = 0;
                $user->save();

                $this->sendnotification($number);

                return response()->json('success 0');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        } else if ($request->status == 1) {
            try {
                $client = new \GuzzleHttp\Client();
                $client->request('GET', 'http://192.168.1.4/afyacall.php', [
                    'query' => [
                        'phone' => $number,
                        'status' => 0,
                        'doctor_id' => $doctor_id
                    ]
                ]);

                //update user status
                $user->status = 1;
                $user->save();

                $this->sendnotification($number);

                return response()->json('success 1');
            } catch (\Throwable $th) {
            }
        }
    }

    public function adminChangeStatus(Request $request)
    {
        $user = User::find($request->id);
        $number = $user->phone;
        $doctor_id = $user->id;
        if ($request->status == 0) {
            try {
                $client = new \GuzzleHttp\Client();
                $client->request('GET', 'http://192.168.1.4/afyacall.php', [
                    'query' => [
                        'phone' => $number,
                        'status' => 1,
                        'doctor_id' => $doctor_id,
                    ]
                ]);
                //update user status
                $user->status = 0;
                $user->save();

                $this->sendnotification($number);

                return response()->json('success 0');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        } else if ($request->status == 1) {
            try {
                $client = new \GuzzleHttp\Client();
                $client->request('GET', 'http://192.168.1.4/afyacall.php', [
                    'query' => [
                        'phone' => $number,
                        'status' => 0,
                        'doctor_id' => $doctor_id,
                    ]
                ]);
                //update user status
                $user->status = 1;
                $user->save();

                //send notification
                $this->sendnotification($number);

                return response()->json('success 1');
            } catch (\Throwable $th) {
            }
        }
    }

    //send a confirmation message to a doctor on entering and leaving queue
    public function sendnotification($doctor_number)
    {
        try {
            $messagesent = "You have successfully change your receiving calls status";
            $contactfilter = str_pad(substr($doctor_number, 1), 12, "255", STR_PAD_LEFT);
            $smsHelper = new SmsHelper();
            $smsHelper->sendSms($contactfilter, $messagesent);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
