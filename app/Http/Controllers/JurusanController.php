<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all data
        return view('jurusan.index',['jurusan'=>Jurusan::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show add jurusan
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //batasi akses untuk proses store
        $this->authorize('create',Jurusan::class);

        $validateData=$request->validate([
            'nama_jurusan'=>'required', 
            'nama_dekan'=>'required',
            'jumlah_mahasiswa'=>'required|min:10|integer',
        ]);
        Jurusan::create($validateData);
        return redirect('/')->with('pesan',"Jurusan $request->nama_jurusan berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //tampilkan jurusan
        return view('jurusan.show',compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        //tampilkan data edit
        return view('jurusan.edit',compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
      //update data
      $validateData=$request->validate([
        'nama_jurusan'=>'required',
        'nama_dekan'=>'required',
        'jumlah_mahasiswa'=>'required|min:10|integer',
    ]);
    $jurusan->update($validateData);
    return redirect('/jurusans/'.$jurusan->id)->with('pesan',"Jurusan $jurusan->nama_jurusan berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        //delete
        $this->authorize('delete',$jurusan);
        $jurusan->delete();
        return redirect('/')
        ->with('pesan',"Jurusan $jurusan->nama_jurusan Berhasil Dihapus");
    }
}
