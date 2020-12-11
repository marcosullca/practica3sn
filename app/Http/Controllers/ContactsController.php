<?php

namespace App\Http\Controllers;
// use Storage;

use Illuminate\Http\Request;
use App\Contactos;
use Illuminate\Support\Facades\Storage;
class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts=Contactos::all();
        return view('contacts.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nombres'=>'required',
            'apellidos'=>'required',
            'correo'=>'required',
            'telefono'=>'required',
            'file'=>'required'
        ]);


        $file=$request->file('file');   
        // $name=$file->getClientOriginalName();
        // $key='imagenes/'.$name;
        $dato=Storage::disk('s3')->put('imagenes/' . $file->getClientOriginalName(),file_get_contents($file));
        $url=Storage::disk('s3')->url('imagenes/'.$file->getClientOriginalName());

        
        $contact=new Contactos([
            'nombres'=>$request->get('nombres'),
            'apellidos'=>$request->get('apellidos'),
            'correo'=>$request->get('correo'),
            'telefono'=>$request->get('telefono'),
            'preview_url'=>$url
        ]);
        $contact->save();
        return redirect('/contacts')->with('success','Contacto registrado');
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
        $contact=Contactos::find($id);
        return view('contacts.edit',compact('contact'));
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
        $request->validate([
            'nombres'=>'required',
            'apellidos'=>'required',
            'correo'=> 'required',
            'telefono'=>'required'
        ]);
        $contact= Contactos::find($id);
        $contact->nombres=$request->get('nombres');
        $contact->apellidos=$request->get('apellidos');
        $contact->correo=$request->get('correo');
        $contact->telefono=$request->get('telefono');
        $contact->save();
        return redirect('/contacts')->with('success','Contacto Actualizado');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact=Contactos::find($id);
        $contact->delete();
        return redirect('/contacts')->with('success','Contacto Eliminado');
    }
}
