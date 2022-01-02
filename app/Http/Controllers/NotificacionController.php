<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Notificacion;
use App\Models\Usuario;
use App\Models\usuario_empresa;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $notificaciones = Notificacion::all();
            $usuario_empresa = usuario_empresa::where('usr',session('LoggedUser'))->first();
            $empresas = Empresa::all();
            $data = ['LoggedUserInfo'=>Usuario::where('id','=', session('LoggedUser'))->first(),'notificaciones'=>$notificaciones,'usuario_empresa'=>$usuario_empresa,'empresas'=>$empresas];
            


            return view('notificaciones.index', $data) ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    function mensajitos(){
        $notificaciones = Notificacion::all();
        $usuario_empresa = usuario_empresa::where('usr',session('LoggedUser'))->first();
        $empresas = Empresa::all();
        $data = ['LoggedUserInfo'=>Usuario::where('id','=', session('LoggedUser'))->first(),'notificaciones'=>$notificaciones,'usuario_empresa'=>$usuario_empresa,'empresas'=>$empresas];
        


        return view('/docente/notificaciones', $data) ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notificaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //$usuario = Usuario::where('id','=', session('LoggedUser'));
        $usuario_empresa = usuario_empresa::where('usr',session('LoggedUser'))->first();
        $obj_merged = array_merge(['id_empresa'=>$usuario_empresa->emp], $request->all());
    
        Notificacion::create($obj_merged);

        return redirect()->route('notificaciones.index')
            ->with('success', 'Mensaje enviado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Notificacion $notificacion)
    {
        return view('notificaciones.show', compact('notificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Notificacion $notificacion)
    {
        return view('notificaciones.edit', compact('notificacion'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notificacion $notificacion)
    {
        $request->validate([
            'mensaje_notificacion' => 'required'
            /*'seleccionar el usuario' => 'required',
            'seleccionar el usuario2' => 'required'*/
            
            
        ]);
        $usuario_empresa = usuario_empresa::where('usr',session('LoggedUser'))->first();
        $obj_merged = array_merge(['id_empresa'=>$usuario_empresa->emp], $request->all());

        $notificacion->update($obj_merged);

        return redirect()->route('notificaciones.index')
            ->with('success', 'mensaje actualizado');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notificacion $notificacion)
    {
        $notificacion->delete();

        return redirect()->route('notificaciones.index')
            ->with('success', 'Mensaje eliminado');
    }
}
