<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        //dd($projects);
        return view('admin.indexProjects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate(
            [
                'type_id' => 'required',
                'Nome_progetto' => 'required|string|min:2|max:150',
                'Descrizione_progetto' => 'required|string|min:10',
                'Data_inizio_progetto' => 'required',
                'Data_fine_progetto' => 'required',
                'Immagine' => 'image',
                'Nome_sviluppatore' => 'string|required|min:2|max:100',
            ],
            [
                'Nome_progetto.required' => 'Il titolo è obbligatorio!!!',
                'Nome_progetto.string' => 'Il titolo non può essere solo numerico!!!',
                'Nome_progetto.min' => 'Il titolo è troppo breve, minimo 2 caratteri!!!',
                'Nome_progetto.max' => 'Il titolo è troppo lungo, massimo 150 caratteri!!!',
                'Descrizione_progetto.required' => 'La descrizione è obbligatoria!!!',
                'Descrizione_progetto.string' => 'La descrizione non può essere solo numerica!!!',
                'Descrizione_progetto.min' => 'La descrizione è troppo breve, minimo 10 caratteri!!!',
                'Data_inizio_progetto.required' => 'La data è obbligatoria!!!',
                'Data_fine_progetto.required' => 'La data è obbligatoria!!!',
                'Immagine.image' => 'Immagine non valida!!!',
                'Nome_sviluppatore.required' => 'Il nome è obbligatorio!!!',
                'Nome_sviluppatore.string' => 'Il nome non può essere di tipo numerico!!!',
                'Nome_sviluppatore.min' => 'Il nome è troppo breve, minimo 2 caratteri!!!',
                'Nome_sviluppatore.max' => 'Il nome è troppo lungo, massimo 100 caratteri!!!',
            ]
        );

        $newProject = new Project();
        $newProject->type_id = $data['type_id'];
        $newProject->Nome_progetto = $data['Nome_progetto'];
        $newProject->Descrizione_progetto = $data['Descrizione_progetto'];
        $newProject->Data_inizio_progetto = $data['Data_inizio_progetto'];
        $newProject->Data_fine_progetto = $data['Data_fine_progetto'];
        if ($request->hasFile('Immagine')) {
            $newProject->Immagine = Storage::put('uploads', $data['Immagine']);
        } else {
            $newProject->Immagine = 'default-image.jpg';
        }
        $newProject->Nome_sviluppatore = $data['Nome_sviluppatore'];
        $newProject->save();


        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        //dd($project);
        return view('admin.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $types = Type::all();
        return view('admin.edit', compact('project', 'types'));
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
        $data = $request->all();

        $request->validate(
            [
                'type_id' => 'required',
                'Nome_progetto' => 'required|string|min:2|max:150',
                'Descrizione_progetto' => 'required|string|min:10',
                'Data_inizio_progetto' => 'required',
                'Data_fine_progetto' => 'required',
                'Immagine' => 'image',
                'Nome_sviluppatore' => 'string|required|min:2|max:100',
            ],
            [
                'Nome_progetto.required' => 'Il titolo è obbligatorio!!!',
                'Nome_progetto.string' => 'Il titolo non può essere solo numerico!!!',
                'Nome_progetto.min' => 'Il titolo è troppo breve, minimo 2 caratteri!!!',
                'Nome_progetto.max' => 'Il titolo è troppo lungo, massimo 150 caratteri!!!',
                'Descrizione_progetto.required' => 'La descrizione è obbligatoria!!!',
                'Descrizione_progetto.string' => 'La descrizione non può essere solo numerica!!!',
                'Descrizione_progetto.min' => 'La descrizione è troppo breve, minimo 10 caratteri!!!',
                'Data_inizio_progetto.required' => 'La data è obbligatoria!!!',
                'Data_fine_progetto.required' => 'La data è obbligatoria!!!',
                'Immagine.image' => 'Immagine non valida!!!',
                'Nome_sviluppatore.required' => 'Il nome è obbligatorio!!!',
                'Nome_sviluppatore.string' => 'Il nome non può essere di tipo numerico!!!',
                'Nome_sviluppatore.min' => 'Il nome è troppo breve, minimo 2 caratteri!!!',
                'Nome_sviluppatore.max' => 'Il nome è troppo lungo, massimo 100 caratteri!!!',
            ]
        );

        $newProject = Project::findOrFail($id); //Dato prima di essere aggiornato
        $newProject->type_id = $data['type_id'];
        $newProject->Nome_progetto = $data['Nome_progetto'];
        $newProject->Descrizione_progetto = $data['Descrizione_progetto'];
        $newProject->Data_inizio_progetto = $data['Data_inizio_progetto'];
        $newProject->Data_fine_progetto = $data['Data_fine_progetto'];
        if ($request->hasFile('Immagine')) {
            Storage::delete($request->Immagine);
            $newProject->Immagine = Storage::put('uploads', $data['Immagine']);
        }
        $newProject->Nome_sviluppatore = $data['Nome_sviluppatore'];
        $newProject->save();

        return redirect()->route('projects.show', $newProject->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('projects.index');
    }
}
