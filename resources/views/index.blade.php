@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            @include('partials.form-add')
            @include('partials.table')
            <div class="d-flex justify-content-center">
            {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('js/my.js') }}"></script>
@endpush
