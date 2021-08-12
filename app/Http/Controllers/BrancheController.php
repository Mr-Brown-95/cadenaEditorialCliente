<?php

namespace App\Http\Controllers;

use App\Branche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Http::get('http://cadenaeditorialservidor.test:8081/branchesServidor');
        $branchesDeCode = json_decode($branches);
        return view('branches.index')->with('branches', $branchesDeCode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $respuesta = Http::asForm()->post('http://cadenaeditorialservidor.test:8081/branchesServidor',
            [
                'direccion' => $request->get('direccion'),
                'ciudad' => $request->get('ciudad'),
                'provincia' => $request->get('provincia'),
                'telefono' => $request->get('telefono'),
                //$branches->imagen = $request->get('imagen');
                'imagen' => 'fhg64']
        );
        $respuestaDeCode = json_decode($respuesta);
        return redirect('branches')->with('mensaje', $respuestaDeCode->resultado);
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
        return redirect('branches')->with('mensaje', $respuesta->resultado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $branche = Http::get('http://cadenaeditorialservidor.test:8081/branchesServidor/' . $id);
        $brancheDeCode = json_decode($branche);

        return view('branches.edit')->with("branches", $brancheDeCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {             //= Http::put('http://cadenaeditorialservidor.test:8081/journalistsServidor/'.$id,
        $respuesta = Http::put('http://cadenaeditorialservidor.test:8081/branchesServidor/' . $id,
            [
                'direccion' => $request->get('direccion'),
                'ciudad' => $request->get('ciudad'),
                'provincia' => $request->get('provincia'),
                'telefono' => $request->get('telefono'),
                //$branches->imagen = $request->get('imagen');
                'imagen' => 'fhg64']
        );
        $respuestaDeCode = json_decode($respuesta);
        return redirect('branches')->with('mensaje', $respuestaDeCode->resultado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $respuesta = Http::delete('http://cadenaeditorialservidor.test:8081/branchesServidor/' . $id);
        $respuestaDeCode = json_decode($respuesta);

        return redirect('/branches')->with('mensaje', $respuestaDeCode->resultado);
    }
}
