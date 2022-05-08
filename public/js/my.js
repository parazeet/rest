(function () {
    function send(url,
                  data = {},
                  success = function () {},
    ) {
        $.ajax({
            url: url,
            data: data,
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: success
        })
            .fail (function (data) {
                // alert error
            });
    }

    $('#createTokken').click(function () {
        const url = $(this).data('url');
        send(url, {}, function (data) {
            if (data.success) {
                alertify.alert('Your Bearer Token', data.access_token);
            }
        });
    })
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
