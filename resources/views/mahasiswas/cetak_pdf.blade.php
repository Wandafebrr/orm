<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
                <h3>KARTU HASIL STUDI (KHS)</h3>
            </div>
        </div>
        <div class="text-left">
            <p><b>Nama : </b>{{ $mahasiswa->Nama }}</p>
            <p><b>Nim  : </b>{{ $mahasiswa->Nim }}</p>
            <p><b>Kelas: </b>{{ $mahasiswa->kelas->nama_kelas }}</p>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Nilai</th>
            </tr>
            @foreach ($mahasiswa->mahasiswaMatakuliah as $item)
                <tr>
                    <td>{{ $item->matakuliah->nama_matkul}}</td>
                    <td>{{ $item->matakuliah->sks }}</td>
                    <td>{{ $item->matakuliah->semester }}</td>
                    <td>{{ $item->nilai }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
