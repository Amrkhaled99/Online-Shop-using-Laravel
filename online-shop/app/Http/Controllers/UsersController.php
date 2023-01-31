<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);

        return view("admin.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        
        $user->fill($request->post());
    
        $user['name'] = $request['name'];
        $user['email'] =$request['email'];
        $user['password'] =  Hash::make($request['password']);
        $user['is_admin'] =  1;
        $user['api_token'] = Str::random(40);
        


        $user->save();
        return redirect()->route('users.index');
        }


    public function show($id)
    {
        $user = User::find($id);
      
        return view("admin.users.show")->with("user",$user);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view("admin.users.edit",compact("user"));
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
        $user = User::find($id);
      
        $user['name'] = $request['name'];
        $user['email'] =$request['email'];

        $user['password'] =  Hash::make($request['npassword']);

        $current_password=  Hash::make($request['cpassword']);
         if($current_password==$user['password']){
            $user->save();
            return redirect()->route("users.index");
        } else {
            return redirect()->route("admin.users.edit");

        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('message', 'Record has been deleted successfully!'); 
        return redirect()->route('users.index');

    }
}
