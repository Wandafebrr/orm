<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMahasiswaRequest;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //search
        if($request->has('key')){
                    $mahasiswas = Mahasiswa::where('Nama','Like','%'.$request->key.'%')->paginate(5);

                }else{
                    //yang semua Mahasiswa::all, diubah menjadi with() yang menyatakan relasi
                    $mahasiswas = Mahasiswa::with('kelas')->paginate(2);
                    $mahasiswas = Mahasiswa::orderBy('Nim', 'asc')->paginate(5);
                }
        // $i = (request()->input('page', 1) - 1) * 6;
        return view('mahasiswas.index', ['mahasiswas'=>$mahasiswas,'paginate'=>$mahasiswas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswas.create',['kelas'=>$kelas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMahasiswaRequest $request)
    {
        Mahasiswa::create($request->validated());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($Nim)
    {
       //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
     $Mahasiswa = Mahasiswa::find($Nim);
    return view('mahasiswas.detail', ['Mahasiswa'=>$Mahasiswa]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
      $mahasiswa = Mahasiswa::with('kelas')->where('id',$id)->first();
      $kelas = Kelas::all();
      return view('mahasiswas.edit', compact('mahasiswa', 'kelas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //melakukan validasi data
 $request->validate([
    'Nim' => 'required',
            'Nama' => 'required',
            'ttl' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required'
    ]);

    $mahasiswa = Mahasiswa::with('kelas')->where('id', $id)->first();
    $mahasiswa->Nim = $request->get('Nim');
    $mahasiswa->Nama = $request->get('Nama');
    $mahasiswa->Jurusan = $request->get('Jurusan');
    $mahasiswa->No_Handphone = $request->get('No_Handphone');
    $mahasiswa->ttl = $request->get('ttl');
    $mahasiswa->Email = $request->get('Email');

    $mahasiswa->save();

    $kelas = new Kelas;
    $kelas->id = $request->get('Kelas');

    $mahasiswa->kelas()->associate($kelas);
    $mahasiswa->save();

   //fungsi eloquent untuk mengupdate data inputan kita
    // Mahasiswa::find($Nim)->update($request->all());
   //jika data berhasil diupdate, akan kembali ke halaman utama
    return redirect()->route('mahasiswa.index')
    ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        // dd(Mahasiswa::find($id));
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')-> with('success', 'Mahasiswa Berhasil Dihapus');
    }
    public function nilai($Nim)
    {
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
            return view('mahasiswas.mahasiswa_nilai', ['Mahasiswa' => $Mahasiswa]);
    }
};
