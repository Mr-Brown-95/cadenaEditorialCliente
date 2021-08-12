<?php

namespace App\Http\Controllers;

use App\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use voku\helper\ASCII;

class MagazineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $magazines = Http::get('http://cadenaeditorialservidor.test:8081/magazinesServidor');
        $magazinesDeCode = json_decode($magazines);
        return view('magazines.index')->with('magazines', $magazinesDeCode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('magazines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $respuesta = Http::asForm()->post('http://cadenaeditorialservidor.test:8081/magazinesServidor',
            [
                'titulo' => $request->get('titulo'),
                'periodicidad' => $request->get('periodicidad'),
                'tipo' => $request->get('tipo'),
            ]
        );

        $respuestaDeCode = json_decode($respuesta);
        return redirect('/magazines')->with('mensaje', $respuestaDeCode->resultado);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $respuesta=$this->destroy($id);
        return redirect('magazines')->with('mensaje',$respuesta->resultado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $magazine = Http::get('http://cadenaeditorialservidor.test:8081/magazinesServidor/'.$id);
        $magazineDeCode = json_decode($magazine);

        return view('magazines.edit')->with("magazines",$magazineDeCode);
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
        $respuesta = Http::put('http://cadenaeditorialservidor.test:8081/magazinesServidor/'.$id,
            [
                'titulo' => $request->get('titulo'),
                'periodicidad' => $request->get('periodicidad'),
                'tipo' => $request->get('tipo'),
            ]
        );

        $respuestaDeCode = json_decode($respuesta);
        return redirect('magazines')->with('mensaje', $respuestaDeCode->resultado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $respuesta = Http::delete('http://cadenaeditorialservidor.test:8081/magazinesServidor/'.$id);
        $respuestaDeCode =json_decode($respuesta);

        return redirect('/magazines')->with('mensaje',$respuestaDeCode->resultado);


    }
}
