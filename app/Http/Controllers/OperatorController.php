<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Akses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator.operator', [
            "title"         => "Operator",
            "active"        => "operator",
            "active2"       => "operator",
            "operator"      => User::all(),
            "akses"         => Akses::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operator.create', [
            "title"         => "Tambah Operator",
            "active"        => "operator",
            "active2"        => "operator",
            "akses"         => Akses::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "name"      => ['required', 'min:5', 'max:255', 'unique:users'],
            "username"  => ['required', 'min:5', 'max:255', 'unique:users'],
            "email"     => ['required', 'email:dns', 'unique:users'],
            "id_akses"  => ['required'],
            "password"  => ['required', 'min:5', 'max:15'],
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        session()->flash('berhasil', 'Registrasi berhasil dilakukan !!');

        return redirect('/operator');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('operator.edit', [
            "title"         => "Edit Operator",
            "active"        => "operator",
            "active2"       => "operator",
            "operator"      => User::find($id),
            "akses"         => Akses::get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            "name"      => 'required|min:5|max:255',
            "username"  => 'required|min:5|max:255',
            "email"     => 'required|email:dns',
            "id_akses"  => 'required',
            "password"  => 'nullable',
        ]);

        // $validateData['password'] = Hash::make($validateData['password']);
        User::where('id', $id)->update($validateData);

        return redirect('/operator')->with('update', 'Data Operator Berhasil di Update');
    }

    public function changepass(Request $request, $id)
    {
        $validatepass = $request->validate([
            "password" => ['required', 'confirmed', 'min:5']
        ]);

        $validatepass['password'] = Hash::make($validatepass['password']);
        $name = User::where('id', $id)->first();
        $name->update($validatepass);
        $namestr = str($name->id);

        return redirect('/operator/' . $namestr . '/edit')->with('changepass', 'Password berhasil diubah');
    }
    public function changepassindex($id)
    {
        return view('operator.changepassindex', [
            "title"         => "Edit Operator",
            "active"        => "operator",
            "active2"       => "operator",
            "operator"      => User::find($id),
            "akses"         => Akses::get(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return back()->with('hapus', 'Data Operator Berhasil di Hapus');
    }
}
