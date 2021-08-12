<?php

namespace App\Http\Controllers;

use App\Magazine;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = Http::get('http://cadenaeditorialservidor.test:8081/sectionsServidor');
        $sectionDeCode = json_decode($section);
        return view('sections.index')->with('sections', $sectionDeCode);
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
        return view('sections.create')->with('magazines', $magazinesDeCode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $respuesta = Http::asForm()->post('http://cadenaeditorialservidor.test:8081/sectionsServidor',
            [
                'numero_registro_id' => $request->get('numero_registro_id'),
                'titulo' => $request->get('titulo'),
                'extension' => $request->get('extension')
            ]
        );
        $respuestaDeCode = json_decode($respuesta);

        return redirect('sections')->with('mensaje', $respuestaDeCode->resultado);

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
        return redirect('copies')->with('sections', $respuesta->resultado);
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

        $section = Http::get('http://cadenaeditorialservidor.test:8081/sectionsServidor/'.$id);
        $sectionDeCode = json_decode($section);
        return view('sections.edit')->with('sections', $sectionDeCode)->with('magazines', $magazinesDeCode);
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
        $respuesta = Http::put('http://cadenaeditorialservidor.test:8081/sectionsServidor/'.$id,
            [
                'numero_registro_id' => $request->get('numero_registro_id'),
                'titulo' => $request->get('titulo'),
                'extension' => $request->get('extension')
            ]
        );
        $respuestaDeCode = json_decode($respuesta);

        return redirect('sections')->with('mensaje', $respuestaDeCode->resultado);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $respuesta = Http::delete('http://cadenaeditorialservidor.test:8081/sectionsServidor/' . $id);
        $respuestaDeCode = json_decode($respuesta);

        return redirect('sections')->with('mensaje', $respuestaDeCode->resultado);
    }
}
