$(document).ready(async function () {
  axios.defaults.withCredentials = true;
  window.axiosConfig = {
    validateStatus: function (status) {
      return status >= 200;
    },
  };

  $('#todoForm').on('submit', async function (e) {
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

    // kirim ke server
    const ret = await axios.post(
      "http://127.0.0.1:3000/",
      {
        name: text
      },
      axiosConfig
    );

    console.log(ret)
  });

  // Delegasi event untuk tombol hapus
  $('#todoList').on('click', '.btn-hapus', async function () {
    // $(this).closest('.col-12').remove();
    const deleteID = $(this).closest('.col-12').attr("id")
    console.log(deleteID)

    $('#todoList').empty();

    const ret = await axios.delete(
      `http://127.0.0.1:3000/${deleteID}`,
      {
      },
      axiosConfig
    );

    console.log(ret)

    ret.data.forEach((item, index) => {
      const card1 = `
      <div id="${item.id}" class="col-12 col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span>${$('<div>').text(item.name).html()}</span>
            <button class="btn btn-sm btn-danger btn-hapus">Hapus</button>
          </div>
        </div>
      </div>
    `;
      $('#todoList').append(card1);
    })
  });

  // init
  const ret = await axios.get(
    "http://127.0.0.1:3000/",
    {
    },
    axiosConfig
  );

  console.log(ret)

  ret.data.forEach((item, index) => {
    const card1 = `
      <div id="${item.id}" class="col-12 col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span>${$('<div>').text(item.name).html()}</span>
            <button class="btn btn-sm btn-danger btn-hapus">Hapus</button>
          </div>
        </div>
      </div>
    `;
    $('#todoList').append(card1);
  })

});