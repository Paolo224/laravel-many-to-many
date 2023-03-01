@extends('layouts.app')
@section('content')

<div class="container post">
    @foreach ($projects as $project)    
    <div class="box" style="
    background: url({{asset('storage/' . $project->Immagine)}});
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    ">
        <div class="contenuto d-flex">
            <div class="info">
                <div class="titolo mb-2">
                    <h3 class="p-2 m-0">
                        {{$project->Nome_progetto}}
                    </h3>
                </div>
                <div class="date">
                    <p class="p-2 m-0">
                        {{$project->Data_inizio_progetto}} - {{$project->Data_fine_progetto}}
                    </p>
                </div>
            </div>
            <div class="descrizione p-3">
                {{$project->Descrizione_progetto}}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
