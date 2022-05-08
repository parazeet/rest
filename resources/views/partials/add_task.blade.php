<form class="row gx-3 gy-2 align-items-center mt-3" method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-sm-3">
        <label for="sum" class="visually-hidden">Тег</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" placeholder="Название тега" required>
    </div>
    <div class="col-sm-3">
        <label for="sum" class="visually-hidden">е-mail</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" name="email" placeholder="е-mail" required>
    </div>
    <div class="col-sm-3">
        <label for="description" class="visually-hidden">Текст задачи</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="1" name="description" placeholder="Текст задачи">{{ old('description') }}</textarea>
    </div>
    <div class="col-sm-3">
        <label for="formFile" class="visually-hidden">Картинка</label>
        <input class="form-control @error('img') is-invalid @enderror" accept="image/png, image/gif, image/jpeg, image/jpg" type="file" name="img" id="formFile">
    </div>
    <div class="col-12 text-end my-3">
        <button type="button" class="btn btn-secondary" id="btn_preview">Preview</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

