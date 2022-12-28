<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Carbon;

class ProcedimientosController extends Controller
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
	    $procedimientos = DB::table('procedimientos')
	                        ->join('areas','areas.id_area','=','procedimientos.id_area')
	                        ->select('procedimientos.*', 'areas.nombre_area')
						    ->where('procedimientos.id_area','=',$id)
						    ->get();

	    $areas = DB::table('areas')
	               ->where('id_area','=',$id)
	               ->first();

	    session(['id_area_global' => $areas->id_area]);

	    return view('documentos.procedimientos.index', ['procedimientos' => $procedimientos , 'areas' => $areas]);
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

	    return view('documentos.procedimientos.create', ['areas' => $areas]);
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
	    $nombre_proc        = $request->input('nombre_proc');
	    $version            = $request->input('version');
	    $fecha_proc         = $request->input('fecha_proc');
	    $id_users           = $request->input('id_users');
		$pdf_proc           = $request->pdf_proc->getClientOriginalName();

	    $request->pdf_proc->storeAs($id_areas.'/pdf_proc/'.$codigo, $pdf_proc);

	    $DeferenceInDays = Carbon::parse(Carbon::now())->diffInDays($fecha_proc);

	    if($DeferenceInDays > 364){
		    $estado = 1;
	    }else{
		    $estado = 0;
	    }

		$data = array('codigo' => $codigo,
		              'id_area' => $id_areas,
		              'nombre_proc' => $nombre_proc,
		              'version' => $version,
		              'fecha_proc' => $fecha_proc,
		              'usuario_creacion' => $id_users,
		              'fecha_creacion' => $this->dateformt,
		              'pdf_proc' => $pdf_proc,
	                  'estado_proc' => $estado);

	    DB::table('procedimientos')->insert($data);
	    return redirect()->route('procedimientosAreas',$id_areas)
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
        $procedimientos = DB::table('procedimientos')->where('id', $id)->first();
        return view('documentos.procedimientos.edit',  ['procedimientos' => $procedimientos, 'areas' => $areas]);
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
	    $nombre_proc        = $request->input('nombre_proc');
	    $version            = $request->input('version');
	    $fecha_proc         = $request->input('fecha_proc');
        $id_users           = $request->input('id_users');
        
        if($request->file('pdf_proc')){
            $pdf_proc = $request->pdf_proc->getClientOriginalName();
            $request->pdf_proc->storeAs($id_areas.'/pdf_proc/'.$codigo, $pdf_proc);
        }else{
            $pdf_proc = $request->input('pdf_proc');
        }

	    $DeferenceInDays = Carbon::parse(Carbon::now())->diffInDays($fecha_proc);

	    if($DeferenceInDays > 364){
		    $estado = 1;
	    }else{
		    $estado = 0;
	    }

		$data = array('codigo' => $codigo,
		              'id_area' => $id_areas,
		              'nombre_proc' => $nombre_proc,
		              'version' => $version,
		              'fecha_proc' => $fecha_proc,
		              'usuario_actualizo' => $id_users,
		              'fecha_actualizo' => $this->dateformt,
		              'pdf_proc' => $pdf_proc,
	                  'estado_proc' => $estado);

	    DB::table('procedimientos')->where('id', $id)->update($data);
	    return redirect()->route('procedimientosAreas',$id_areas)
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
        DB::table('procedimientos')->where('id', $id)->delete();
	    return redirect()->route('procedimientosAreas',Session::get('id_area_global'))
	                     ->with('success', 'Registro eliminado correctamente');
    }

    public function file($id)
    {
		$dl = DB::table('procedimientos')->where('id', $id)->first();
	    return response()->download("../intranet/storage/app/$dl->id_area/pdf_proc/$dl->codigo/$dl->pdf_proc");
    }
}
