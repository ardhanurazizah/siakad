<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Mahasiswa_MataKuliah;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $paginate = Mahasiswa::where('nim', 'like', '%' . request('search') . '%')
                                    ->orwhere('nama', 'like', '%' . request('search') . '%')
                                    ->orwhere('kelas', 'like', '%' . request('search') . '%')
                                    ->orwhere('jurusan', 'like', '%' . request('search') . '%')
                                    ->orwhere('jeniskelamin', 'like', '%' . request('search') . '%')
                                    ->orwhere('email', 'like', '%' . request('search') . '%')
                                    ->orwhere('alamat', 'like', '%' . request('search') . '%')
                                    ->orwhere('tanggallahir', 'like', '%' . request('search') . '%')->paginate(5); // Mengambil semua isi tabel
                                    return view('mahasiswa.index', ['paginate'=>$paginate]);
        }else{
            //fungsi eloquent menampilkan data menggunakan pagination
            // $mahasiswa = Mahasiswa::all(); // Mengambil semua isi tabel
            // $paginate = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(5);
            // return view('mahasiswa.index', ['mahasiswa' => $mahasiswa,'paginate'=>$paginate]);
            $mahasiswa = Mahasiswa::with('kelas')->get();
            $paginate = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(3);
            return view('mahasiswa.index', ['mahasiswa' => $mahasiswa,'paginate'=>$paginate]);


        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas =Kelas::all(); // mendapatkan data dari tabel kelas
	    return view('mahasiswa.create',['kelas' => $kelas]);
        // return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'jeniskelamin' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'tanggallahir' => 'required',
        ]);
        // //fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->jeniskelamin = $request->get('jeniskelamin');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->tanggallahir = $request->get('tanggallahir');
        
    
    
        $kelas = Kelas::find($request->get('Kelas'));
        //fungsi eloquent untuk menambah data dengan relasi belongsTo

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
    
                     // Mahasiswa::create($request->all());
    
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        // //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        // $Mahasiswa = Mahasiswa::where('nim', $nim)->first(); 
        // return view('mahasiswa.detail', compact('Mahasiswa'));

        //code sebelum dibuat relasi --> $mahasiswa = Mahasiswa::find($Nim)
        $mahasiswa = Mahasiswa::with('Kelas')->where('nim', $nim)->first();
		return view('mahasiswa.detail', ['Mahasiswa' => $mahasiswa]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        // $Mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first(); 
        // return view('mahasiswa.edit', compact('Mahasiswa'));

        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
		$kelas = Kelas::all(); //mendapatkan data dari tabel kelas
		return view('mahasiswa.edit', compact('mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'jeniskelamin' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'tanggallahir' => 'required',
        ]);
        // //fungsi eloquent untuk mengupdate data inputan kita 
        // Mahasiswa::where('nim', $nim)
        //   ->update([
        //       'nim'=>$request->Nim,
        //       'nama'=>$request->Nama,
        //       'kelas'=>$request->Kelas,
        //       'jurusan'=>$request->Jurusan,
        //       'jeniskelamin'=>$request->JenisKelamin,
        //       'email'=>$request->Email,
        //       'alamat'=>$request->Alamat,
        //       'tanggallahir'=>$request->TanggalLahir,
        //     ]);

        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
		$mahasiswa->nim = $request->get('Nim');
		$mahasiswa->nama = $request->get('Nama');
		$mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->jeniskelamin = $request->get('jeniskelamin');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->tanggallahir = $request->get('tanggallahir');
		$mahasiswa->save();
		

		$kelas = Kelas::find($request->get('Kelas'));
		
        //fungsi eloquent untuk mengupdate data dengan relasi belongsTo
		$mahasiswa->kelas()->associate($kelas);
		$mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama 
        return redirect()->route('mahasiswa.index')
           ->with('success', 'Mahasiswa Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data 
        Mahasiswa::where('nim', $nim)->delete();
        return redirect()->route('mahasiswa.index')
          -> with('success', 'Mahasiswa Berhasil Dihapus');
    }
    public function Mahasiswa_MataKuliah($Nim)
    {
        $mahasiswa = Mahasiswa_MataKuliah::with('matakuliah')->where('mahasiswa_id', $Nim)->get();
        $mahasiswa->mahasiswa = Mahasiswa::with('kelas')->where('id_mahasiswa', $Nim)->first();
        return view('mahasiswa.nilai', ['mahasiswa' => $mahasiswa]);
    }
}
