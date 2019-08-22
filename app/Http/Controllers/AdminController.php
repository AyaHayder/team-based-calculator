<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

use Session;

class AdminController extends Controller
{
    use SoftDeletes;
    public $station_id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStationId($role)
    {
        switch($role){
            case 'addition user':
                $this->station_id = 1;
                break;
            case 'subtraction user':
                $this->station_id = 2;
                break;
            case 'multiplication user':
                $this->station_id = 3;
                break;
            case 'division user':
                $this->station_id = 4;
                break;
            case 'supervisor':
                $this->station_id =5;
                break;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            $validator = Validator::make($request->all(),[
                'first_name' => 'bail|required',
                'last_name' => 'required',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6',
                'repassword' => 'required|same:password',
                'role' => 'required'
            ]);
            if ($validator->fails()){
                Session::flash('register error','Validation Error');
                return back()->withErrors($validator->errors())->withInput();
            }
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email= $request->email;
            $user->password = bcrypt($request->password);
            $user->role = str_replace("-", " ", $request->role);
            $role = str_replace("-", " ", $request->role);
            $this->getStationId($role);
            $user->station_id = $this->station_id;
            $user->save();
            Session::flash('added','user was added successfully!');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'update_first_name' => 'bail|required',
            'update_last_name' => 'required',
            'update_email' => 'bail|email|required|email',
            'permission' => 'required'
        ]);
        if ($validator->fails()){
            Session::flash('update error','Validation Error');
            return back()->withErrors($validator->errors())->withInput();
        }
        $user = User::find($id);
        $user->first_name = $request->update_first_name;
        $user->last_name = $request->update_last_name;
        $user->email= $request->update_email;
        $role = str_replace("-", " ", $request->permission);
        $user->role = $role;
        $this->getStationId($role);
        $user->station_id = $this->station_id;
        $user->save();
        Session::flash('updated','user was updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('deleted','User was deleted successfully!');
        return redirect('/dashboard');
    }
}
