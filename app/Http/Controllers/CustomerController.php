<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PaketPenjualan;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        //

        return view('dashboard-sales');
    }

    public function get_paket(){
        return PaketPenjualan::get();
    }
    public function data(){
        return DB::table('customers')
        ->leftJoin('paket_penjualans','customers.paket_penjualan_id','paket_penjualans.id')
        ->select('paket_penjualans.*','customers.*')
        ->orderBy('customers.id','desc')->get();
    }

    public function stores(Request $request){
        $req = $request->all();
   


        $tujuan_upload = public_path('foto_ktp');
        $tujuan_upload2 = public_path('foto_rumah');

        if ($request->file('foto_ktp')) {

            $file = $request->file('foto_ktp');
            $namaFile = Carbon::now()->format('YmdHs') . $file->getClientOriginalName();
            $file->move($tujuan_upload, $namaFile);
            $req['foto_ktp'] = $namaFile;
        }


        if ($request->file('foto_rumah')) {

            $file2 = $request->file('foto_rumah');
            $namaFile2 = Carbon::now()->format('YmdHs') . $file2->getClientOriginalName();
            $file2->move($tujuan_upload2, $namaFile2);
            $req['foto_rumah'] = $namaFile2;
        }
     

        Customer::create($req);
       
    }

    public function getid($id)
    {
        return DB::table('customers')
        ->leftJoin('paket_penjualans','customers.paket_penjualan_id','paket_penjualans.id')
        ->select('paket_penjualans.*','customers.*')
        ->orderBy('customers.id','desc')->where('customers.id',$id)->first();
    }
    public function update_customer(Request $request,$id){

        $req = $request->all();
   

        $tujuan_upload = public_path('foto_ktp');
        $tujuan_upload2 = public_path('foto_rumah');

        if ($request->file('foto_ktp')) {

            $file = $request->file('foto_ktp');
            $namaFile = Carbon::now()->format('YmdHs') . $file->getClientOriginalName();
            $file->move($tujuan_upload, $namaFile);
            $req['foto_ktp'] = $namaFile;
        }


        if ($request->file('foto_rumah')) {

            $file2 = $request->file('foto_rumah');
            $namaFile2 = Carbon::now()->format('YmdHs') . $file2->getClientOriginalName();
            $file2->move($tujuan_upload2, $namaFile2);
            $req['foto_rumah'] = $namaFile2;
        }
        if (!$request->hasFile('foto_ktp') && !$request->hasFile('foto_rumah')) {
            unset($req['foto_ktp']);
            unset($req['foto_rumah']);
        }

        Customer::where('id',$id)->update($req);
       
    }


    public function hapus($id){
        Customer::where('id',$id)->delete();

    }


}
