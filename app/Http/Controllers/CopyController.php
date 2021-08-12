<?php

namespace App\Http\Controllers;

use App\Copy;
use App\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $copies = Http::get('http://cadenaeditorialservidor.test:8081/copiesServidor');
        $copiesDeCode = json_decode($copies);

        return view('copies.index')->with('copies', $copiesDeCode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $magazines = Http::get('http://cadenaeditorialservidor.test:8081/magazinesServidor');
        $magazinesDeCode = json_decode($magazines);
        return view('copies.create')->with('magazines', $magazinesDeCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $respuesta = Http::asForm()->post('http://cadenaeditorialservidor.test:8081/copiesServidor',
            [
        'numero_registro_id' => $request->get('numero_registro_id'),
        'fecha' => $request->get('fecha'),
        'numero_paginas' => $request->get('numero_paginas'),
        'numero_ejemplares' => $request->get('numero_ejemplares')
            ]
        );
        $respuestaDeCode = json_decode($respuesta);

        return redirect('copies')->with('mensaje', $respuestaDeCode->resultado);
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
        return redirect('copies')->with('mensaje', $respuesta->resultado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $magazines = Http::get('http://cadenaeditorialservidor.test:8081/magazinesServidor');
        $magazinesDeCode = json_decode($magazines);

        $copies = Http::get('http://cadenaeditorialservidor.test:8081/copiesServidor/'.$id);
        $copiesDeCode = json_decode($copies);
        return view('copies.edit')->with('copies', $copiesDeCode)->with('magazines', $magazinesDeCode);
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

        $respuesta = Http::put('http://cadenaeditorialservidor.test:8081/copiesServidor/'.$id,
            [
                'numero_registro_id' => $request->get('numero_registro_id'),
                'fecha' => $request->get('fecha'),
                'numero_paginas' => $request->get('numero_paginas'),
                'numero_ejemplares' => $request->get('numero_ejemplares')
            ]
        );
        $respuestaDeCode = json_decode($respuesta);

        return redirect('copies')->with('mensaje', $respuestaDeCode->resultado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $respuesta = Http::delete('http://cadenaeditorialservidor.test:8081/copiesServidor/' . $id);
        $respuestaDeCode = json_decode($respuesta);

        return redirect('copies')->with('mensaje', $respuestaDeCode->resultado);
    }
}
