<?php

namespace App\Http\Controllers;
use App\Models\Sucursal;
use App\Models\Farmacia;
use Illuminate\Http\Request;


class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_usuario = auth()->user()->id_usuario; 
        $arrayFarmacias = Farmacia::where('id_usuario', "=" , $id_usuario)->get();
    
        return view('farmaceutico.cargarSucursal' , ['arrayFarmacias' => $arrayFarmacias ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //Valida los campos 
        Request()->validate(([
            
            'id_farmacia' => 'required',
            'cufe_sucursal' => 'required',
            'email_sucursal' => 'required | email',
            'telefono_sucursal' => 'required',
            ]));
    
            // Crear una nueva instacia de Farmacia y la guarda en la DB
            $habilitada = 0; // FLAG deshabilitada por defecto
            $sucursal = new Sucursal();
            $sucursal->id_farmacia = $request->id_farmacia;

            if($request->descripcion_sucursal != NULL){
                $sucursal->descripcion_sucursal = $request->descripcion_sucursal;
            }
           
            $sucursal->cufe_sucursal = $request->cufe_sucursal;
            $sucursal->email_sucursal = $request->email_sucursal;
            $sucursal->telefono_sucursal  = $request->telefono_sucursal;
            $sucursal->habilitado = $habilitada;
            $sucursal->save();
    
            return redirect(route('farmacia.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal $sucursal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        //
    }

    public function buscarFarmaciaSucursal(Request $request ){

        //$farmacia = Farmacia::where("id_farmacia", "=" , $request->id_farmacia)->get();
        $farmacia = Farmacia::find($request->id_farmacia);
        $arraySucursales = Sucursal::where("id_farmacia", "=" , $request->id_farmacia)->get();
        return view('farmacia.verFarmaciaySucursal' , [
                'arraySucursales' => $arraySucursales,
                 'farmacia' => $farmacia,
                 ]);
        
        
    }


    /**
     * 
     */
    public function farmaciaSucursal(Request $request){

        $farmacia = $request->id_farmacia;
        $farmacia = Farmacia::find($farmacia);
        $arraySucursales = Sucursal::where("id_farmacia", "=" , $farmacia->id_farmacia)->get();

        return view('farmacia.verFarmaciaySucursal' , [
                 'arraySucursales' => $arraySucursales,
                 'farmacia' => $farmacia,
                 ]); 
    }



  public function listarFarmaciaSucursales()
  {
    $id_usuario = auth()->user()->id_usuario;
    $arraySucursales = Farmacia::find($id_usuario)->getSucursales();
  }

}
