<?php

namespace App\Http\Controllers;

use App\Models\PaketPenjualan;
use Illuminate\Http\Request;

class PaketPenjualanController extends Controller
{
   public function dashboard_paket(){
    return view('dashboard-paket');
   }

   public function data(){
    return PaketPenjualan::orderBy('id','desc')->get();
}

public function stores(Request $request){
    
    $req = $request->all();
    PaketPenjualan::create($req);
    return $request->all();
}

public function getid($id)
{
    return PaketPenjualan::where('id',$id)->first();
}
public function update_paket(Request $request,$id){

    return  PaketPenjualan::where('id',$id)->first()->update($request->all());
}

public function hapus($id){
    PaketPenjualan::where('id',$id)->delete();

}
}
