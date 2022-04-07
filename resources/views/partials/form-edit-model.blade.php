<!-- Modal -->
<div class="modal fade show" style="display: block" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Редактирование</h5>
                <button wire:click="close()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="update({{ $task }})">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="comment" class="visually-hidden">Текст задачи</label>
                        <textarea wire:model.defer="task.description" class="form-control" id="description" rows="3" name="description" placeholder="Текст задачи">
                                    {{ $task->description }}
                                </textarea>
                    </div>
                    @error('task.description') <span class="alert-danger">{{ $message }}</span> @enderror
                    <div class="form-check mb-3">
                        <input wire:model.defer="task.status" class="form-check-input" type="checkbox" id="status" name="status"
                               @if($task->status) checked @endif>
                        <label class="form-check-label" for="status">
                            Задача выполнена
                        </label>
                    </div>
                    @error('task.status') <span class="alert-danger">{{ $message }}</span> @enderror
                </div>
                <div class="modal-footer">
                    <button wire:click="close()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
