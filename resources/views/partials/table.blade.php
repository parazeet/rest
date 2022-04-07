@push('css')
    <link href="{{ asset('css/my.css') }}" rel="stylesheet" />
@endpush
<table class="table table-striped" id="task_table" data-url="">
    <thead>
        <tr>
            <th wire:click.prevent="sortBy('name')" data-name="name" scope="col">Имя пользователя</th>
            <th wire:click.prevent="sortBy('email')" data-name="email" scope="col">е-mail</th>
            <th scope="col">Текст задачи</th>
            <th scope="col">Картинка</th>
            <th wire:click.prevent="sortBy('status')" data-name="status" scope="col">Статус</th>
            @can('is_admin')
            @if(auth()->check() && Route::currentRouteName() !== "index") {{-- Кастыль, так как реализовывал работу разными способами (штатными и Livewire) --}}
            <th scope="col">Действия</th>
            @endif
            @endcan
        </tr>
    </thead>
    <tbody>
    @forelse($tasks ?? [] as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->description }}</td>
            <td>
                <img class="img_preview" src="{{ $item->getImg() }}" width="60" data-bs-toggle="modal" data-bs-target="#lightbox_{{ $item->id }}">
                @include('partials.lightbox', $item)
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="flexCheckDisabled" disabled @if($item->status) checked @endif>
                </div>
            </td>
            @can('is_admin')
            @if(auth()->check() && Route::currentRouteName() !== "index") {{-- Кастыль, так как реализовывал работу разными способами (штатными и Livewire) --}}
            <td>
                <a wire:click="show({{ $item }})" class="btn btn-sm btn-primary">Редактировать</a>
                <a wire:click="delete({{ $item }})" class="btn btn-sm btn-danger">Удалить</a>
            </td>
            @endif
            @endcan
        </tr>
    @empty
        <tr>
            <td class="text-center" colspan="@if(auth()->check() && Route::currentRouteName() !== "index") 6 @else 5 @endif">Задач нет</td>
        </tr>
    @endforelse
    </tbody>
</table>
