<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SmsHelper;
use App\Model\UserStatusActivity;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $user = User::find(Auth::id());
        if (!$user) {
            return response()->json('User not found', 404);
        }

        Log::info("User changing status:", json_decode(json_encode($user), true));

        $number = $user->phone;
        $doctor_id = $user->id;
        $newStatus = $request->status; // 0 or 1
        $apiStatus = $newStatus == 0 ? 1 : 0; // API expects the inverse
        $expectedResponse = $newStatus == 0 ? 'Sucessfully Added' : 'Sucessfully Removed';

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'http://192.168.1.46:80/afyacall.php', [
                'verify' => false,
                'query' => [
                    'phone' => $number,
                    'status' => $apiStatus,
                    'doctor_id' => $doctor_id
                ]
            ]);

            $responseBody = trim($response->getBody()->getContents());
            Log::info("AFYACALL API RESPONSE:", json_decode(json_encode([
                'phone' => $number,
                'status_sent_to_api' => $apiStatus,
                'expected_response' => $expectedResponse,
                'api_response' => $responseBody
            ]), true));

            if ($responseBody === $expectedResponse) {
                $user->status = $newStatus;
                $user->save();
                $this->logStatusActivity($user, (int) $newStatus, 'self');

                $this->sendnotification($number);

                return response()->json("success {$newStatus}");
            } else {
                Log::warning("AFYACALL API RESPONSE MISMATCH:", json_decode(json_encode([
                    'expected' => $expectedResponse,
                    'received' => $responseBody,
                    'user_id' => $user->id
                ]), true));
                return response()->json("API response mismatch. Status not updated.", 422);
            }

        } catch (\Throwable $th) {
            Log::error("AFYACALL API ERROR:", json_decode(json_encode([
                'message' => $th->getMessage(),
                'user_id' => $user->id,
                'doctor_id' => $doctor_id
            ]), true));
            return response()->json("API error: " . $th->getMessage(), 500);
        }
    }


    public function adminChangeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'status' => 'required|in:0,1',
        ]);

        $user = User::find($request->id);
        $number = $user->phone;
        $doctor_id = $user->id;
        if ($request->status == 0) {
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'http://192.168.1.46:80/afyacall.php', [
                    'query' => [
                        'phone' => $number,
                        'status' => 1,
                        'doctor_id' => $doctor_id,
                    ]
                ]);

                $responseBody = $response->getBody()->getContents();
                Log::info("AFYACALL API RESPONSE for {$number}: " . $responseBody);
            
                //update user status
                $user->status = 0;
                $user->save();
                $this->logStatusActivity($user, 0, 'admin');

                $this->sendnotification($number);

                return response()->json('success 0');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        } else if ($request->status == 1) {
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'http://192.168.1.46:80/afyacall.php', [

                    'query' => [
                        'phone' => $number,
                        'status' => 0,
                        'doctor_id' => $doctor_id,
                    ]
                ]);

                $responseBody = $response->getBody()->getContents();
                Log::info("AFYACALL API RESPONSE for {$number}: " . $responseBody);
                
                //update user status
                $user->status = 1;
                $user->save();
                $this->logStatusActivity($user, 1, 'admin');

                //send notification
                $this->sendnotification($number);

                return response()->json('success 1');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
    }

    protected function logStatusActivity(User $user, $status, $source = null)
    {
        try {
            UserStatusActivity::create([
                'user_id' => $user->id,
                'new_status' => (int) $status,
                'activity' => ((int) $status) === 0 ? 'login' : 'logout',
                'changed_by' => Auth::id(),
                'source' => $source,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        } catch (\Throwable $th) {
            Log::error('Failed to store user status activity log', [
                'message' => $th->getMessage(),
                'user_id' => $user->id,
                'status' => $status,
            ]);
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
	     Log::error($th->getMessage());
            return false;
        }
    }
}
