<?php

namespace App\Http\Controllers;

use App\Branche;
use App\Employ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $employs = Http::get('http://cadenaeditorialservidor.test:8081/employsServidor');
        $employsDeCode = json_decode($employs);

        return view('employs.index')->with('employs', $employsDeCode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Http::get('http://cadenaeditorialservidor.test:8081/branchesServidor');
        $branchesDeCode = json_decode($branches);
        return view('employs.create')->with('branches', $branchesDeCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $respuesta = Http::asForm()->post('http://cadenaeditorialservidor.test:8081/employsServidor',
            [
                'codigoSucursal_id' => $request->get('codigoSucursal_id'),
                'nif' => $request->get('nif'),
                'nombre' => $request->get('nombre'),
                'apellido1' => $request->get('apellido1'),
                'apellido2' => $request->get('apellido2'),
                'telefono' => $request->get('telefono')
            ]
        );
        $respuestaDeCode = json_decode($respuesta);

        return redirect('employs')->with('mensaje', $respuestaDeCode->resultado);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $respuesta = $this->destroy($id);
        return redirect('employs')->with('mensaje', $respuesta->resultado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employ = Http::get('http://cadenaeditorialservidor.test:8081/employsServidor/'.$id);
        $employDeCode = json_decode($employ);

        $branches = Http::get('http://cadenaeditorialservidor.test:8081/branchesServidor');
        $branchesDeCode = json_decode($branches);

         return view('employs.edit')->with("employs",$employDeCode)->with('branches', $branchesDeCode);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $respuesta = Http::put('http://cadenaeditorialservidor.test:8081/employsServidor/'.$id,
            [
                'codigoSucursal_id' => $request->get('codigoSucursal_id'),
                'nif' => $request->get('nif'),
                'nombre' => $request->get('nombre'),
                'apellido1' => $request->get('apellido1'),
                'apellido2' => $request->get('apellido2'),
                'telefono' => $request->get('telefono')
            ]
        );
        $respuestaDeCode = json_decode($respuesta);

        return redirect('employs')->with('mensaje', $respuestaDeCode->resultado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $respuesta = Http::delete('http://cadenaeditorialservidor.test:8081/employsServidor/' . $id);
        $respuestaDeCode = json_decode($respuesta);

        return redirect('employs')->with('mensaje', $respuestaDeCode->resultado);
    }
}
