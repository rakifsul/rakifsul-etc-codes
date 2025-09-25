<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RF CI REST API Frontend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h1 id="heading" class="mb-4">RF CI REST API Demo</h1>

    <!-- Login -->
    <div class="card mb-4" id="login-card">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form id="login-form">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" class="form-control" name="login_username" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="login_password" required>
                </div>
                <button class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

    <!-- User Management -->
    <div id="user-section" style="display:none;">
        <div class="mb-3 d-flex justify-content-between">
            <h3>User List</h3>
            <button class="btn btn-success" id="btn-add-user">Add User</button>
        </div>

        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th>ID</th><th>Username</th><th>Email</th><th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>

<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="user-form">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id">
          <div class="mb-3">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control">
          </div>
          <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control">
              <small class="text-muted">Leave blank if not changing password</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('hidden.bs.modal', function (event) {
    // Remove the focus from the active element
    if (document.activeElement) {
    document.activeElement.blur();
    }
});

const API_BASE = 'http://127.0.0.1:8081'; // ganti dengan URL backend kamu
let token = localStorage.getItem('token') || '';
let userModal = new bootstrap.Modal(document.getElementById('userModal'));

// Login handler
$('#login-form').on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url: API_BASE + '/login',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            username: $('[name="login_username"]').val(),
            password: $('[name="login_password"]').val()
        }),
        success: function(res){
            token = res.token;
            localStorage.setItem('token', token);
            $('#login-card').hide();
            $('#user-section').show();
            loadUsers();
        },
        error: function(xhr){
            alert('Login failed: ' + xhr.responseJSON.message);
        }
    });
});

function logout(){
    localStorage.clear();
    location.reload();
}

// Load user list
function loadUsers(){
    $.ajax({
        url: API_BASE + '/api/users',
        method: 'GET',
        headers: { Authorization: 'Bearer ' + token },
        success: function(res){
            let rows = '';
            res.data.forEach(u => {
                rows += `<tr>
                    <td>${u.id}</td>
                    <td>${u.username}</td>
                    <td>${u.email || ''}</td>
                    <td>
                        <button class="btn btn-sm btn-warning me-1" onclick="editUser(${u.id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteUser(${u.id})">Delete</button>
                    </td>
                </tr>`;
            });
            $('#users-table tbody').html(rows);
        }
    });

    $("#logout").empty();
    $("#heading").append(`
    <a id="logout" href="javascript:void(0);" onclick="logout()">[logout]</a>
    `);
}

// Add user button
$('#btn-add-user').on('click', function(){
    $('#userModalLabel').text('Add User');
    $('#user-form')[0].reset();
    $('[name="id"]').val('');
    userModal.show();
});

// Edit user
function editUser(id){
    $.ajax({
        url: API_BASE + '/api/users/' + id,
        method: 'GET',
        headers: { Authorization: 'Bearer ' + token },
        success: function(res){
            $('#userModalLabel').text('Edit User');
            $('[name="id"]').val(res.data.id);
            $('[name="username"]').val(res.data.username);
            $('[name="email"]').val(res.data.email);
            $('[name="password"]').val('');
            userModal.show();
        }
    });
}

// Save user form
$('#user-form').on('submit', function(e){
    e.preventDefault();
    const id = $('[name="id"]').val();
    const method = id ? 'PUT' : 'POST';
    const url = API_BASE + '/api/users' + (id ? '/' + id : '');
    let data = {
        username: $('[name="username"]').val(),
        email: $('[name="email"]').val(),
        password: $('[name="password"]').val()
    };
    if(!data.password) delete data.password;

    console.log(data)

    $.ajax({
        url: url,
        method: method,
        headers: { Authorization: 'Bearer ' + token },
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(){
            userModal.hide();
            loadUsers();
        },
        error: function(xhr){
            alert('Error: ' + (xhr.responseJSON?.message || 'Unknown'));
        }
    });
});

// Delete user
function deleteUser(id){
    if(!confirm('Delete this user?')) return;
    $.ajax({
        url: API_BASE + '/api/users/' + id,
        method: 'DELETE',
        headers: { Authorization: 'Bearer ' + token },
        success: function(){
            loadUsers();
        }
    });
}

// Auto login if token exists
if(token){
    $('#login-card').hide();
    $('#user-section').show();
    loadUsers();
}
</script>
</body>
</html>
