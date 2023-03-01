@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 p-2 d-flex justify-content-end">
            <a href="{{route('projects.create')}}" class="btn btn-sm bg-primary text-light">
                Nuovo progetto +
            </a>
        </div>
    </div>
    <table>
        <thead>
            <tr class="bg-dark text-light">
                <th class="p-2 text-center">ID</th>
                <th class="p-2 text-center">Nome del progetto</th>
                <th class="p-2 text-center">Descrizione</th>
                <th class="p-2 text-center">Data di inizio</th>
                <th class="p-2 text-center">Data di fine</th>
                <th class="p-2 text-center">URL dell'immagine</th>
                <th class="p-2 text-center">Nome dello sviluppatore</th>
                <th class="p-2 text-center"><i class="fa-solid fa-arrow-down-long"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project) 
            <tr class="border-bottom border-2 border-dark">
                <th class="p-2 text-center">{{$project->id}}</th>
                <td class="p-2 text-center">{{$project->Nome_progetto}}</td>
                <td class="p-2 text-justify">{{$project->Descrizione_progetto}}</td>
                <td class="p-2 text-center">{{$project->Data_inizio_progetto}}</td>
                <td class="p-2 text-center">{{$project->Data_fine_progetto}}</td>
                <td class="p-2 text-center">
                    <img class="size-image-index" src="{{asset('storage/' . $project->Immagine)}}" alt="">
                </td>
                <td class="p-2 text-center">{{$project->Nome_sviluppatore}}</td>
                <td class="text-center p-3">
                    <a href={{route('projects.show', $project->id)}} class="mb-2 btn bg-dark text-light btn-sm btn-light">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{route('projects.edit', $project->id)}}" class="mb-2 btn bg-dark text-light btn-sm btn-light">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{route('projects.destroy', $project->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection