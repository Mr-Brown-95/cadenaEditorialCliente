<?php

namespace App\Http\Controllers;

use App\Journalist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JournalistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journalists = Http::get('http://cadenaeditorialservidor.test:8081/journalistsServidor');
        $journalistsDeCode = json_decode($journalists);
        return view('journalists.index')->with('journalists', $journalistsDeCode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('journalists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $respuesta = Http::asForm()->post('http://cadenaeditorialservidor.test:8081/journalistsServidor',
            [
                'nombre' => $request->get('nombre'),
                'apellido1' => $request->get('apellido1'),
                'apellido2' => $request->get('apellido2'),
                'telefono' => $request->get('telefono'),
                'especialidad' => $request->get('especialidad')
            ]
        );
        $respuestaDeCode =json_decode($respuesta);
        return redirect('/journalists')->with('mensaje',$respuestaDeCode->resultado);
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
        return redirect('journalists')->with('mensaje',$respuesta->resultado);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $journalist = Http::get('http://cadenaeditorialservidor.test:8081/journalistsServidor/'.$id);
        $journalistDeCode = json_decode($journalist);

        return view('journalists.edit')->with("journalists",$journalistDeCode);
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
        $respuesta = Http::put('http://cadenaeditorialservidor.test:8081/journalistsServidor/'.$id,
            [
                'nombre' => $request->get('nombre'),
                'apellido1' => $request->get('apellido1'),
                'apellido2' => $request->get('apellido2'),
                'telefono' => $request->get('telefono'),
                'especialidad' => $request->get('especialidad')
            ]
        );
        $respuestaDeCode =json_decode($respuesta);
        return  redirect('journalists')->with('mensaje',$respuestaDeCode->resultado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $respuesta = Http::delete('http://cadenaeditorialservidor.test:8081/journalistsServidor/'.$id);
        $respuestaDeCode =json_decode($respuesta);

        return redirect('/journalists')->with('mensaje',$respuestaDeCode->resultado);
    }
}
