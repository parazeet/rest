(function () {
    $('#btn_preview').click(function () {
        clear();

        $('#preview_name').text($('#name').val());
        $('#preview_email').text($('#email').val());
        $('#preview_description').text($('#description').val());

        const file = $('#formFile')[0].files[0];
        if (file){
            let reader = new FileReader();
            reader.onload = function(event){
                $('#preview_img').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
        $('#preview_img').attr('src', '/img/tasks_img/default_img.png');

        $('#previewModal').modal('show');
    });

    function clear() {
        $('#preview_name').val('');
        $('#preview_email').val('');
        $('#preview_description').text('');
        $('#preview_img').attr('src', '');
    }

// Реализация сортировки на jQuery+php
    $('#task_table > thead > tr > th').each(function(){
        var me = $(this);
        me.click(function (){
            //sortColumn(me);
        });
    });

    function sortColumn(value) {
        const columnName = value.data('name');
        const url = $('#task_table').data('url');

        send(url, {columnName: columnName}, function (data) {
            if (data.success) {
                // рисуем таблицу
            }
        });
    }

    function send(url,
                  data = {},
                  success = function () {},
    ) {
        $.ajax({
            url: url,
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: success
        })
            .fail (function (data) {
                // alert error
            });
    }
})();

document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('task_table');
    const headers = table.querySelectorAll('th');
    const tableBody = table.querySelector('tbody');
    const rows = tableBody.querySelectorAll('tr');

    const directions = Array.from(headers).map(function(header) {
        return '';
    });

    const transform = function(index, content) {
        const type = headers[index].getAttribute('data-type');
        switch (type) {
            case 'number':
                return parseFloat(content);
            case 'string':
            default:
                return content;
        }
    };

    const sortColumn = function(index) {
        const direction = directions[index] || 'asc';
        const multiplier = (direction === 'asc') ? 1 : -1;
        const newRows = Array.from(rows);

        newRows.sort(function(rowA, rowB) {
            const cellA = rowA.querySelectorAll('td')[index].innerHTML;
            const cellB = rowB.querySelectorAll('td')[index].innerHTML;

            const a = transform(index, cellA);
            const b = transform(index, cellB);

            switch (true) {
                case a > b: return 1 * multiplier;
                case a < b: return -1 * multiplier;
                case a === b: return 0;
            }
        });

        [].forEach.call(rows, function(row) {
            tableBody.removeChild(row);
        });

        directions[index] = direction === 'asc' ? 'desc' : 'asc';

        newRows.forEach(function(newRow) {
            tableBody.appendChild(newRow);
        });
    };

    [].forEach.call(headers, function(header, index) {
        header.addEventListener('click', function() {
            sortColumn(index);
        });
    });
});
