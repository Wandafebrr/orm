<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMahasiswaRequest;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\mahasiswaMatakuliah;
use Barryvdh\DomPDF\Facade\PDF;

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
                    $mahasiswas = Mahasiswa::orderBy('id', 'asc')->paginate(5);
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
        $new_image = '';
        if ($request->hasFile('image_profile')) {
            $extension = $request->file('image_profile')->getClientOriginalExtension();
            $request->file('image_profile')->move('storage/images/', $request->get('Nama') . '.' . $extension);
            $new_image =  $request->get('Nama') . '.' . $extension;
        }

        Mahasiswa::create(
            [
            'Nim' => $request->get('Nim'),
            'Nama' => $request->get('Nama'),
            'ttl' => $request->get('ttl'),
            'kelas_id' => $request->get('kelas_id'),
            'Jurusan' =>$request->get('Jurusan') ,
            'No_Handphone' => $request->get('No_Handphone'),
            'image_profile'=> $new_image,
            'Email' =>$request->get('Email')
            ]
        );


        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
      //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa

      return view('mahasiswas.detail', compact('mahasiswa'));

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
   if ($request->hasFile('image_profile')) {
        $extension = $request->file('image_profile')->getClientOriginalExtension();
        $request->file('image_profile')->move('storage/images/', $mahasiswa->Nama . '.' . $extension);
        $mahasiswa->image_profile = $mahasiswa->Nama . '.' . $extension;
    } else {
        $mahasiswa->image_profile = 'default.png';
    }
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
    public function destroy(Mahasiswa $mahasiswa)
    {

        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function nilai(Mahasiswa $mahasiswa)
    {
        return view('mahasiswas.mahasiswa_nilai', compact('mahasiswa'));
    }

    public function cetak($id)
    {
        // $mahasiswa_id = Mahasiswa::where('Nim', $Nim)->pluck('id')->first();
        // $mahasiswa = Mahasiswa::with('kelas', 'mahasiswaMatakuliah.matakuliah')->where('id', $mahasiswa_id)->first();
        // $pdf = PDF::loadView('mahasiswas.mahasiswa_nilai', ['mahasiswa' => $mahasiswa]);
        // return $pdf->stream();
        $mahasiswa = Mahasiswa::findOrFail($id);
        $pdf = PDF::loadView('mahasiswas.cetak_pdf', compact('mahasiswa'));
        return $pdf->stream('document.pdf');
    }
};
