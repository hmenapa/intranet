<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Carbon;

class PlantillasController extends Controller
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
    	$plantillas = DB::table('plantillas')
	                    ->join('areas','areas.id_area','=','plantillas.id_area')
	                    ->select('plantillas.*', 'areas.nombre_area')
		                ->where('plantillas.id_area','=',$id)
	                    ->get();

    	$areas = DB::table('areas')
		             ->where('id_area','=',$id)
		             ->first();

	    session(['id_area_global' => $areas->id_area]);


	    return view('documentos.plantillas.index',  ['plantillas' => $plantillas , 'areas' => $areas]);
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
	    return view('documentos.plantillas.create', ['areas' => $areas]);
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
	    $nombre_plantiLla   = $request->input('nombre_plantilla');
	    $version            = $request->input('version');
	    $fecha_proc         = $request->input('fecha_proc');
	    $id_users           = $request->input('id_users');
		$archivo_plantilla  = $request->archivo_plantilla->getClientOriginalName();

	    $request->archivo_plantilla->storeAs($id_areas.'/archivo_plantilla/'.$codigo, $archivo_plantilla);

	    $DeferenceInDays = Carbon::parse(Carbon::now())->diffInDays($fecha_proc);

	    if($DeferenceInDays > 364){
	    	$estado = 1;
	    }else{
	    	$estado = 0;
	    }

	    $data = array('codigo' => $codigo,
		              'id_area' => $id_areas,
		              'nombre_plantilla' => $nombre_plantiLla,
		              'version' => $version,
		              'fecha_proc' => $fecha_proc,
		              'usuario_creacion' => $id_users,
		              'fecha_creacion' => $this->dateformt,
		              'archivo_plantilla' => $archivo_plantilla,
	                  'estado_plantilla' => $estado);

	    DB::table('plantillas')->insert($data);


	    return redirect()->route('plantillasAreas',$id_areas)
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
	    $areas = DB::table('areas')->get();
	    $plantillas = DB::table('plantillas')->where('id', $id)->first();
	    return view('documentos.plantillas.detail',  ['plantillas' => $plantillas, 'areas' => $areas]);
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
        $plantillas = DB::table('plantillas')->where('id', $id)->first();
        return view('documentos.plantillas.edit',  ['plantillas' => $plantillas, 'areas' => $areas]);
    }
    public function file($id)
    {
		$dl = DB::table('plantillas')->where('id', $id)->first();
	    return response()->download("../intranet/storage/app/$dl->id_area/archivo_plantilla/$dl->codigo/$dl->archivo_plantilla");
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
	    $nombre_plantiLla   = $request->input('nombre_plantilla');
	    $version            = $request->input('version');
	    $fecha_proc         = $request->input('fecha_proc');
        $id_users           = $request->input('id_users');
        
        if($request->file('archivo_plantilla')){
            $archivo_plantilla  = $request->archivo_plantilla->getClientOriginalName();
	        $request->archivo_plantilla->storeAs($id_areas.'/archivo_plantilla/'.$codigo, $archivo_plantilla);
        }else{
            $archivo_plantilla = $request->input('archivo_plantilla');
        }

	    $DeferenceInDays = Carbon::parse(Carbon::now())->diffInDays($fecha_proc);

	    if($DeferenceInDays > 364){
		    $estado = 1;
	    }else{
		    $estado = 0;
	    }
		

		$data = array('codigo' => $codigo,
		              'id_area' => $id_areas,
		              'nombre_plantilla' => $nombre_plantiLla,
		              'version' => $version,
		              'fecha_proc' => $fecha_proc,
		              'usuario_actualizo' => $id_users,
		              'fecha_actualizo' =>  $this->dateformt,
		              'archivo_plantilla' => $archivo_plantilla,
					  'estado_plantilla' => $estado);
		              
        DB::table('plantillas')->where('id', $id)->update($data);
        return redirect()->route('plantillasAreas',$id_areas)
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
    	DB::table('plantillas')->where('id', $id)->delete();
	    return redirect()->route('plantillasAreas',Session::get('id_area_global'))
                         ->with('success', 'Registro eliminado correctamente');
    }
}
