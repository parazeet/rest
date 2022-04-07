@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                @livewire('tasks')
            </div>
        </div>
    </div>
@endsection
