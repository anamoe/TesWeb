<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        //

        return view('dashboard');
    }


    public function data(){
        return User::where('role','sales')->orderBy('id','desc')->get();
    }

    public function stores(Request $request){
        
        $req = $request->all();
        $req['password'] = bcrypt($request->password);
        $req['role'] ='sales';
        $req['email'] = $request->email;
        User::create($req);
        return $request->all();
    }

    public function getid($id)
    {
        return User::where('role','sales')->where('id',$id)->first();
    }
    public function update_sales(Request $request,$id){

        return  User::where('role','sales')->where('id',$id)->first()->update([
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'no_induk_pegawai'=>$request->no_induk_pegawai
        ]);
    }

    public function hapus($id){
        User::where('id',$id)->delete();

    }


}
