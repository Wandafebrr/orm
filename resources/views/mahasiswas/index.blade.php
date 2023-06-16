@extends('mahasiswas.layout')
@section('content')
 <div class="row">
 <div class="col-lg-12 margin-tb">
 <div class="pull-left mt-2">
 <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
 </div>
 <div class="float-right my-2">
 <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
 </div>
 </div>
 </div>

 <form action="{{route('mahasiswa.index')}}" method="GET" role="search">
    <div class="input-group">
        <div class="form-outline">
            <input type="search" class="form-control" name="key" placeholder="Cari Nama Mahasiswa">
        </div>
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-search"></i>
            </button>
    </div>
</form>


 @if ($message = Session::get('success'))
 <div class="alert alert-success">
 <p>{{ $message }}</p>
 </div>
 @endif

 <table class="table table-bordered">
 <tr>
 <th>Nim</th>
 <th>Nama</th>
 <th>Foto</th>
 <th>Tanggal lahir</th>
 <th>Kelas</th>
 <th>Jurusan</th>
 <th>No_Handphone</th>
 <th>Email</th>
 <th width="290px">Action</th>
 </tr>
 @foreach ($paginate as $Mahasiswa)
 <tr>

    <td>{{ $Mahasiswa->Nim }}</td>
    <td>{{ $Mahasiswa->Nama }}</td>
    <td>{{ $Mahasiswa->ttl }}</td>
    <td>{{ $Mahasiswa->Kelas->nama_kelas }}</td>
    <td>{{ $Mahasiswa->Jurusan }}</td>
    <td>{{ $Mahasiswa->No_Handphone}}</td>
    <td>{{ $Mahasiswa->Email }}</td>
    <td>
        <form action="{{ route('mahasiswa.destroy',$Mahasiswa->id) }}" method="POST">
                @csrf
                @method('DELETE')
            <a class="btn btn-info" href="{{ route('mahasiswa.show', $Mahasiswa) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$Mahasiswa->id) }}">Edit</a>
            <button type="submit" class="btn btn-danger">Delete</button>
            <a class="btn btn-warning" href="{{ route('mahasiswa.nilai', $Mahasiswa) }}">Nilai</a>
        </form>
    </td>
 </tr>
 @endforeach
 </table>

 <div class="flex">
    {{$mahasiswas->links()}}
 </div>
@endsection
