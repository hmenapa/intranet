<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Mail\Notificacion;

class NotificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dateformt;

	public function __construct(){
		$this->dateformt = date('Y-m-d');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
    	$usuarios = DB::table('users')->get();
    	$temporales = DB::table('temporales')->where('id_temporal',$id)->first();
    	return view('notificaciones.create', ['usuarios' => $usuarios, 'temporales' => $temporales]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_temporal        = $request->input('id_temporal');
		$usuario_carga      = $request->input('id_user');
        $responsables       = $request->input('usuario_id');
        $comentarios        = $request->input('comentarios');
        $usuario_creacion   = $request->input('id_user');

        $asunto = 'Notificaciones';


        foreach ($responsables as $responsable){
			$data[] = array('id_temporal' => $id_temporal,
			                'id_user' => $usuario_carga,
			                'responsable' => $responsable,
			                'comentarios' => $comentarios,
			                'usuario_creacion' => $usuario_creacion,
			                'fecha_creacion' => $this->dateformt);

			$user = DB::table('users')->where('id',$responsable)->first();

	        Mail::to($user->email)->send(new Notificacion($asunto,$comentarios));
        }
		//dd($data);
        DB::table('notificaciones')->insert($data);

        DB::table('temporales')->where('id_temporal', $id_temporal)->update(['notificacion' => 1]);


		return redirect()->route('temporales.index')
		                 ->with('success', 'Notificacion Registrada y enviada a su Bandeja de Correo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    	$notificacion =  DB::table('notificaciones')->where('id_temporal',$id)->first();

	    $usuario_carga = DB::table('users')->where('id', $notificacion->id_user)->first();

    	$responsables = DB::table('notificaciones')->where('id_temporal',$id)->get();

    	foreach ($responsables as $responsable) {
    		$correos[] = DB::table('users')->where('id', $responsable->responsable)->first();
	    }

	   	return view('notificaciones.detail', [ 'notificaciones' => $notificacion, 'usuario_carga' => $usuario_carga, 'responsables' => $correos]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	public function notificaciones(Request $request) {
		if($request->ajax()){
			$notificaciones = DB::table('notificaciones')
			                         ->where('responsable', $request->usuario)
			                         ->leftJoin('users', 'notificaciones.responsable','=','users.id')
			                         ->select('notificaciones.*','users.firstname','users.lastname')->get();
			$data = view('proyectos.temporales.ajax' ,compact('notificaciones'))->render();
			//dd($notificaciones);
			return response()->json(['notificaciones'=>$data]);
		}
	}
}
