$(document).ready(function () {
    $('#todoForm').on('submit', function (e) {
        e.preventDefault();

        const text = $('#todoInput').val().trim();
        if (text === '') return;

        const card = `
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
              <div class="card-body d-flex justify-content-between align-items-center">
                <span>${$('<div>').text(text).html()}</span>
                <button class="btn btn-sm btn-danger btn-hapus">Hapus</button>
              </div>
            </div>
          </div>
        `;

        $('#todoList').append(card);
        $('#todoInput').val('');
    });

    // Delegasi event untuk tombol hapus
    $('#todoList').on('click', '.btn-hapus', function () {
        $(this).closest('.col-12').remove();
    });
});