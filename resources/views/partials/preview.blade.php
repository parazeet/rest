<!-- Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Имя пользователя</th>
                        <th scope="col">е-mail</th>
                        <th scope="col">Текст задачи</th>
                        <th scope="col">Картинка</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="preview_name"></td>
                            <td id="preview_email"></td>
                            <td id="preview_description"></td>
                            <td>
                                <img id="preview_img" src="" width="60">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
