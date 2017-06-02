@extends('layouts.app')

@section('content')

<div class="container">
	<button-toolbar :notes="notes" :note="note" @noteget="retrieveNote" @notenew="createNote" @notedelete="deleteNote"></button-toolbar>
	<note :notes="notes" :note="note" @noteput="putNote" @notesave="saveNote"></note>
</div>
@endsection