<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;

class PegawaiController extends Controller
{
    public function index()
    {
      $no = 1;
      $pegawai = DB::table('pegawai')->orderBy('id','desc')->paginate(5);
      return view('pegawai.index',['no'=>$no,'pegawai'=>$pegawai]);
    }

    public function show($id)
    {
      $pegawai = DB::table('pegawai')->where('id',$id)->first();
      return response()->json(compact('pegawai'));
    }

    public function store(Request $r)
    {
      $nama = $r->input('nama');
      $nip = $r->input('nip');
      $alamat = $r->input('alamat');

      $validator = Validator::make($r->all(),[
        'nama'  =>  'required',
        'nip' =>  'required|integer',
        'alamat' => 'required',
      ]);

      if ($validator->fails()) {
        $nama = $validator->errors()->first('nama');
        $nip = $validator->errors()->first('nip');
        $alamat = $validator->errors()->first('alamat');
        $sukses = false;
        return response()->json(compact('nama','nip','alamat','sukses'));
      }

      else {
        $sukses = true;
        DB::table('pegawai')->insert(['nama'=>$nama,'nip'=>$nip,'alamat'=>$alamat]);
        return response()->json(compact('sukses'));
      }
    }

     public function update(Request $r)
    {
      $id = $r->input('id');
      $data = DB::table('pegawai')->where('id',$id)->count();

      if ($data==0) {
        $sukses = false;
        return response()->json(compact('sukses'));
      }

       else {
        $nama = $r->input('nama');
        $nip = $r->input('nip');
        $alamat = $r->input('alamat');

        $validator = Validator::make($r->all(),[
          'id'  =>  'required',
          'nama'  =>  'required',
          'nip' =>  'required|integer',
          'alamat' => 'required',
        ]);

         if ($validator->fails()) {
          $id = $validator->errors()->first('id');
          $nama = $validator->errors()->first('nama');
          $nip = $validator->errors()->first('nip');
          $alamat = $validator->errors()->first('alamat');
          $sukses = false;
          return response()->json(compact('id','nama','nip','alamat','sukses'));
        }

        else {
          $sukses = true;
          DB::table('pegawai')->where('id',$id)->update(['nama'=>$nama,'nip'=>$nip,'alamat'=>$alamat]);
          return response()->json(compact('sukses'));
        }
      }
    }

    public function destroy(Request $r)
    {
      $id = $r->input('id');
      $data = DB::table('pegawai')->where('id',$id)->first();

      if (count($data)==0) {
        $sukses = false;
        return response()->json(compact('sukses'));
      }

      else {
        DB::table('pegawai')->where('id',$id)->delete();
        $sukses = true;
        return response()->json(compact('sukses'));
      }
    }
}
