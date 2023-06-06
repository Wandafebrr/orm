<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

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
                    $mahasiswas = Mahasiswa::all();
                    $mahasiswas = Mahasiswa::orderBy('Nim', 'asc')->paginate(5);
                }
        $i = (request()->input('page', 1) - 1) * 6;
        return view('mahasiswas.index', compact('mahasiswas', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        ;
        //fungsi eloquent untuk menambah data
        Mahasiswa::create(
            $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'ttl' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required'
            ])
        );
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
 $Mahasiswa = Mahasiswa::find($id);
 return view('mahasiswas.detail', compact('Mahasiswa'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($id);
        return view('mahasiswas.edit', compact('Mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $Nim)
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
   //fungsi eloquent untuk mengupdate data inputan kita
    Mahasiswa::find($Nim)->update($request->all());
   //jika data berhasil diupdate, akan kembali ke halaman utama
    return redirect()->route('mahasiswa.index')
    ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        // dd(Mahasiswa::find($id));
        Mahasiswa::find($id)->delete();
        return redirect()->route('mahasiswa.index')-> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    // public function search(Request $request){
    //     $key = $request->input('key');
    //     $mahasiswas = Mahasiswa::where('Nama','LIKE','%'. $key . '%')->get();
    //     return view('mahasiswas.index',compact('Mahasiswa'));
    //     if($request->has('search')){
    //         $mahasiswas = Mahasiswa::where('Nama','Like','%'.$request->search.'%')->paginate(5);
    //     }else{
    //         $mahasiswas = Mahasiswa::all();
    //         $mahasiswas = Mahasiswa::orderBy('Nim', 'desc')->paginate(5);
    //     }

    // }
};
