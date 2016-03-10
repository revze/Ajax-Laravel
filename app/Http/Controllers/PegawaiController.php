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
      $pegawai = DB::table('pegawai')->orderBy('id','desc')->paginate(10);
      return view('pegawai.index',['no'=>$no,'pegawai'=>$pegawai]);
    }

    public function create()
    {
      return view('pegawai.create');
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
        return response()->json(compact('nama','nip','alamat'));
      }

      else {
        DB::table('pegawai')->insert(['nama'=>$nama,'nip'=>$nip,'alamat'=>$alamat]);
        return 'success';
      }
    }

    public function edit($pegawai)
    {
      $data = DB::table('pegawai')->where('id',$pegawai)->first();
      return view('pegawai.edit',['data'=>$data]);
    }

    public function update(Request $r)
    {
      $data = DB::table('pegawai')->where('id',$pegawai)->first();

      if (count($data)==0) {
        return redirect('pegawai')->with('error','Data pegawai tidak ditemukan');
      }

      else {
        $id = $r->input('id');
        $nama = $r->input('nama');
        $nip = $r->input('nip');
        $alamat = $r->input('alamat');

        $validator = Validator::make($r->all(),[
          'id'  =>  'required',
          'nama'  =>  'required',
          'nip' =>  'required',
          'alamat' => 'required',
        ]);

        $messages = $validator->errors();

        if ($validator->fails()) {
          return redirect('pegawai/create')->with('messages',$messages)->withInput();
        }

        else {
          DB::table('pegawai')->where('id',$pegawai)->update(['nama'=>$nama,'nip'=>$nip,'alamat'=>$alamat]);
          return redirect('pegawai')->with('success','Data pegawai berhasil diubah');
        }
      }
    }

    public function delete($pegawai)
    {
      $data = DB::table('pegawai')->where('id',$pegawai)->first();

      if (count($data)==0) {
        return redirect('pegawai')->with('error','Data pegawai tidak ditemukan');
      }

      else {
        DB::table('pegawai')->where('id',$pegawai)->delete();
        return redirect('pegawai')->with('success','Data pegawai berhasil dihapus');
      }
    }
}
