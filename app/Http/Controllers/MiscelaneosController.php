<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Carbon;

class   MiscelaneosController extends Controller
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

    public function index($id)
    {
        $miscelaneos = DB::table('miscelaneos')
                         ->join('areas','areas.id_area', '=', 'miscelaneos.id_area')
	                     ->select('miscelaneos.*', 'areas.nombre_area')
						 ->where('miscelaneos.id_area','=',$id)
						 ->get();

        $areas = DB::table('areas')
	               ->where('id_area','=',$id)
	               ->first();

	    session(['id_area_global' => $areas->id_area]);

	    return view('documentos.miscelaneos.index', ['miscelaneos' => $miscelaneos , 'areas' => $areas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
	    $areas = DB::table('areas')
	               ->where('id_area','=',$id)
	               ->get();

	    return view('documentos.miscelaneos.create', ['areas' => $areas]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $codigo             = $request->input('codigo');
	    $id_areas           = $request->input('id_areas');
	    $nombre_documento   = $request->input('nombre_documento');
	    $version            = $request->input('version');
	    $fecha_proc         = $request->input('fecha_proc');
	    $id_users           = $request->input('id_users');
	    $archivo_documento  = $request->archivo_documento->getClientOriginalName();

	    $request->archivo_documento->storeAs($id_areas.'/archivo_documento/'.$codigo, $archivo_documento);

	    //Storage::putFile('app/'.$id_areas.'/archivo_documento/'.$codigo,$request->file('archivo_documento'));
	    $DeferenceInDays = Carbon::parse(Carbon::now())->diffInDays($fecha_proc);

	    if($DeferenceInDays > 364){
		    $estado = 1;
	    }else{
		    $estado = 0;
	    }

	    $data = array('codigo' => $codigo,
	                  'id_area' => $id_areas,
	                  'nombre_documento' => $nombre_documento,
	                  'version' => $version,
	                  'fecha_proc' => $fecha_proc,
	                  'usuario_creacion' => $id_users,
	                  'fecha_creacion' => $this->dateformt,
	                  'archivo_documento' => $archivo_documento,
	                  'estado_documento' => $estado);

	    //dd($data);
	    DB::table('miscelaneos')->insert($data);

	    return redirect()->route('miscelaneosAreas',$id_areas)
	                     ->with('success', 'Registro Exitoso');
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
	    $areas = DB::table('areas')->get();
	    $miscelaneos = DB::table('miscelaneos')->where('id', $id)->first();
	    return view('documentos.miscelaneos.edit',  ['miscelaneos' => $miscelaneos, 'areas' => $areas]);
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

	    $codigo             = $request->input('codigo');
	    $id_areas           = $request->input('id_areas');
	    $nombre_documento   = $request->input('nombre_documento');
	    $version            = $request->input('version');
	    $fecha_proc         = $request->input('fecha_proc');
	    $id_users           = $request->input('id_users');

	    if($request->file('archivo_documento')){
		    $archivo_documento  = $request->archivo_documento->getClientOriginalName();
		    $request->archivo_documento->storeAs($id_areas.'/archivo_documento/'.$codigo, $archivo_documento);
	    }else{
		    $archivo_documento = $request->input('archivo_documento');
	    }

	    $DeferenceInDays = Carbon::parse(Carbon::now())->diffInDays($fecha_proc);

	    if($DeferenceInDays > 364){
		    $estado = 1;
	    }else{
		    $estado = 0;
	    }

	    $data = array('codigo' => $codigo,
	                  'id_area' => $id_areas,
	                  'nombre_documento' => $nombre_documento,
	                  'version' => $version,
	                  'fecha_proc' => $fecha_proc,
	                  'usuario_actualizo' => $id_users,
	                  'fecha_actualizo' =>  $this->dateformt,
	                  'archivo_documento' => $archivo_documento,
		              'estado_documento' => $estado);

	    DB::table('miscelaneos')->where('id', $id)->update($data);
	    return redirect()->route('miscelaneosAreas', $id_areas)
	                     ->with('success', 'Registro editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    DB::table('miscelaneos')->where('id', $id)->delete();
	    return redirect()->route('miscelaneosAreas',Session::get('id_area_global'))
	                     ->with('success', 'Registro eliminado correctamente');
    }

	public function file($id)
	{
		$dl = DB::table('miscelaneos')->where('id', $id)->first();
		return response()->download("../intranet/storage/app/$dl->id_area/archivo_documento/$dl->codigo/$dl->archivo_documento");
	}


}
