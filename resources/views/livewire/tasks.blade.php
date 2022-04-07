<div>
    @include('partials.table')
    <div class="d-flex justify-content-center">
        {{ $tasks->links() }}
    </div>
    @if($showModel)
        @include('partials.form-edit-model')
    @endif
</div>

