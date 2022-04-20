@extends('mahasiswa.layout') @section('content')
<div class="container mt-5">

    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
        <div class="card-header"> Edit Mahasiswa
        </div>
        <div class="card-body"> @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li> @endforeach
                </ul>
            </div> @endif
            <form method="post" action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" id="myForm"> @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="Nim">Nim</label>
                    <input type="text" name="Nim" class="form-control" id="Nim" value="{{ $mahasiswa->nim }}" aria-describedby="Nim" >
                </div>
                <div class="form-group">
                    <label for="Nama">Nama</label>
                    <input type="text" name="Nama" class="form-control" id="Nama" value="{{ $mahasiswa->nama }}" aria-describedby="Nama" >
                </div>
                <div class="form-group">
                    <!-- <label for="Kelas">Kelas</label>
                    <input type="Kelas" name="Kelas" class="form-control" id="Kelas" value="{{ $mahasiswa->kelas }}" aria-describedby="Kelas" > -->
                    <label form="Kelas">Kelas</label>
                    <select name="Kelas" class="form-control">
                        @foreach($kelas as $kls)
                        <option value="{{$kls->id}}"{{$mahasiswa->kelas_id == $kls->id ? 'selected' : ''}}>{{$kls->nama_kelas}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="Jurusan">Jurusan</label>
                    <input type="Jurusan" name="Jurusan" class="form-control" id="Jurusan" value="{{ $mahasiswa->jurusan }}" aria-describedby="Jurusan" >
                </div>
                <div class="form-group">
                    <label for="jeniskelamin">Jenis Kelamin</label>
                    <input type="jeniskelamin" name="jeniskelamin" class="form-control" id="jeniskelamin" value="{{ $mahasiswa->jeniskelamin }}" aria-describedby="jeniskelamin" >
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="Email" name="Email" class="form-control" id="Email" value="{{ $mahasiswa->email }}" aria-describedby="Email" >
                </div>
                <div class="form-group">
                    <label for="Alamat">Alamat</label>
                    <input type="Alamat" name="Alamat" class="form-control" id="Alamat" value="{{ $mahasiswa->alamat }}" aria-describedby="Alamat" >
                </div>
                <div class="form-group">
                    <label for="tanggallahir">Tanggal Lahir</label>
                    <input type="tanggallahir" name="tanggallahir" class="form-control" id="tanggallahir" value="{{ $mahasiswa->tanggallahir }}" aria-describedby="tanggallahir" >
                </div>
                <div class="form-group">
            <label for="featured_image">Foto</label>
            <input type="file" name="featured_image" class="form-control" value="{{ $mahasiswa->featured_image}}" id="featured_image" ariadescribedby="featured_image" >
            <img style="width: 100%" src="{{ asset('./storage/'. $mahasiswa->featured_image) }}" alt="">
          </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div> @endsection
