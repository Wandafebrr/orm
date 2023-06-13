@extends('mahasiswa.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
                <h3>KARTU HASIL STUDI (KHS)</h3>
            </div>
        </div>
        <div class="text-left">
            <p><b>Nama : </b>{{ $Mahasiswa->Nama }}</p>
            <p><b>Nim  : </b>{{ $Mahasiswa->Nim }}</p>
            <p><b>Kelas: </b>{{ $Mahasiswa->Kelas->nama_kelas }}</p>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Nilai</th>
            </tr>
            @foreach ($Mahasiswa->Mahasiswa_MataKuliah as $nilai)
                <tr>
                    <td>{{ $nilai->matakuliah->nama_matkul }}</td>
                    <td>{{ $nilai->matakuliah->sks }}</td>
                    <td>{{ $nilai->matakuliah->semester }}</td>
                    <td>{{ $nilai->nilai }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
