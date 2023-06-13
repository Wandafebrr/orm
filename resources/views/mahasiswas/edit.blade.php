@extends('mahasiswas.layout')

@section('content')

<div class="container mt-5">

 <div class="row justify-content-center align-items-center">
 <div class="card" style="width: 24rem;">
 <div class="card-header">
 Edit Mahasiswa
 </div>
 <div class="card-body">
 @if ($errors->any())
 <div class="alert alert-danger">
 <strong>Whoops!</strong> There were some problems with your input.<br><br>
 <ul>
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif
 <form method="post" action="{{ route('mahasiswa.update', $mahasiswa->id) }}" id="myForm">
 @csrf
 @method('PUT')
 <div class="form-group">
 <label for="Nim">Nim</label>
 <input type="text" name="Nim" class="form-control" id="Nim" value="{{ $mahasiswa->Nim }}" ariadescribedby="Nim" >
 </div>
 <div class="form-group">
 <label for="Nama">Nama</label>
 <input type="text" name="Nama" class="form-control" id="Nama" value="{{ $mahasiswa->Nama }}" ariadescribedby="Nama" >
 </div>
 <div class="form-group">
    <label for="ttl">Tanggal lahir</label>
    <input type="date" name="ttl" class="form-control" id="ttl" value="{{ $mahasiswa->ttl }}" ariadescribedby="ttl" >
    </div>

    <div class="form-group">
        <label for="Kelas">Kelas</label><br>
        <select name="Kelas" id="" class="form-control">
            @foreach($kelas as $kls)
            <option value="{{$kls->id}}"{{$mahasiswa->kelas_id == $kls->id ? 'selected':''}}>{{$kls->nama_kelas}}</option>
            @endforeach
        </select>
    </div>

 <div class="form-group">
 <label for="Jurusan">Jurusan</label>
 <input type="Jurusan" name="Jurusan" class="form-control" id="Jurusan" value="{{ $mahasiswa->Jurusan }}" ariadescribedby="Jurusan" >
 </div>
 <div class="form-group">
 <label for="No_Handphone">No_Handphone</label>
 <input type="No_Handphone" name="No_Handphone" class="form-control" id="No_Handphone" value="{{ $mahasiswa->No_Handphone }}" ariadescribedby="No_Handphone" >
 </div>
 <div class="form-group">
    <label for="Email">Email</label>
    <input type="email" name="Email" class="form-control" id="Email" value="{{ $mahasiswa->Email}}" ariadescribedby="Email" >
    </div>
 <button type="submit" class="btn btn-primary">Submit</button>
 </form>
 </div>
 </div>
 </div>
</div>
@endsection
