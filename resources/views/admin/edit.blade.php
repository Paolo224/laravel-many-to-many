@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <a class="btn btn-sm btn-outline-primary mb-2" href={{route('projects.index')}}>
                Torna alla lista
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div id="popup_message" class="d-none" data-type="warning" data-message="Check errors"></div>
            @endif
        </div>
    </div>
    <form action="{{route('projects.update', $project->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">
                Tipo
            </label>
            <select class="form-control" name="type_id">
                @foreach ($types as $type)                  
                    <option value="{{$type->id}}" {{($type->id == old('type_id', $project->type_id)) ? 'selected' : ''}} >{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 d-flex justify-content-between">
            @foreach ($technologies as $technology)
            <div>
                <input type="checkbox" class="form-check-input" name="technologies[]" value="{{$technology->id}}"
                {{$project->technologies->contains($technology->id) ? 'checked' : ''}}>
                <label class="form-check-label">{{$technology->name}}</label>
            </div>                  
            @endforeach
        </div>
        <div class="mb-3">
            <label class="form-label">
                Nome progetto
            </label>
            <input type="text" class="form-control @error('Nome_progetto') is-invalid @enderror" name="Nome_progetto" value="{{old('Nome_progetto') ?? $project->Nome_progetto}}">
            @error('Nome_progetto') 
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                Descrizione
            </label>
            <textarea class="form-control @error('Descrizione_progetto') is-invalid @enderror" name="Descrizione_progetto" cols="30" rows="10">{{old('Descrizione_progetto') ?? $project->Descrizione_progetto}}</textarea>
            @error('Descrizione_progetto') 
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                Data di inizio
            </label>
            <input type="date" class="form-control @error('Data_inizio_progetto') is-invalid @enderror" name="Data_inizio_progetto" value="{{old('Data_inizio_progetto') ?? $project->Data_inizio_progetto}}">
            @error('Data_inizio_progetto') 
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                Data di fine
            </label>
            <input type="date" class="form-control @error('Data_fine_progetto') is-invalid @enderror" name="Data_fine_progetto" value="{{old('Data_fine_progetto') ?? $project->Data_fine_progetto}}">
            @error('Data_fine_progetto') 
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                URL immagine
            </label>
            <input type="file" class="form-control @error('Immagine') is-invalid @enderror" name="Immagine" value="{{old('Immagine') ?? $project->Immagine}}">
            @error('Immagine') 
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                Nome sviluppatore
            </label>
            <input type="text" class="form-control @error('Nome_sviluppatore') is-invalid @enderror" name="Nome_sviluppatore" value="{{old('Nome_sviluppatore') ?? $project->Nome_sviluppatore}}">
            @error('Nome_sviluppatore') 
                <div class="invalid-feedback">
                    {{$message}}
                </div> 
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection