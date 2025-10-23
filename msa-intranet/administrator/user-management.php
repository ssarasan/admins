<?php
include("../templates/admin-header.php");
include('../connect.php');

// Table structure for reference (MySQL):

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Handle Create
if (isset($_POST['add_user'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = $_POST['role'] === 'admin' ? 'admin' : 'user';
    $status = isset($_POST['status']) ? 1 : 0;
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    // Security validations
    if (!preg_match('/^[a-zA-Z0-9_]{3,30}$/', $username)) {
        $_SESSION['error'] = 'Username must be 3-30 characters and contain only letters, numbers, and underscores.';
        header('Location: user-management.php');
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email address.';
        header('Location: user-management.php');
        exit;
    }
    // Check for existing username or email
    $check = $conn->prepare("SELECT id FROM users WHERE username=? OR email=? LIMIT 1");
    $check->bind_param('ss', $username, $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        $_SESSION['error'] = 'Username or email already exists!';
        $check->close();
        header('Location: user-management.php');
        exit;
    }
    $check->close();
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match!';
    } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $_SESSION['error'] = 'Password must be at least 8 characters and include uppercase, lowercase, and a number.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssi', $username, $email, $hash, $role, $status);
        if ($stmt->execute()) {
            $_SESSION['success'] = 'User added successfully!';
        } else {
            $_SESSION['error'] = 'Error: ' . $stmt->error;
        }
        $stmt->close();
    }
    header('Location: user-management.php');
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($id !== $_SESSION['user_id']) { // Prevent self-delete
        $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['success'] = 'User deleted successfully!';
    } else {
        $_SESSION['error'] = 'You cannot delete your own account!';
    }
    header('Location: user-management.php');
    exit;
}

// Handle Edit (Update)
if (isset($_POST['edit_user'])) {
    $id = intval($_POST['id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = $_POST['role'] === 'admin' ? 'admin' : 'user';
    $status = isset($_POST['status']) ? 1 : 0;
    $update_password = !empty($_POST['password']);
    // Security validations
    if (!preg_match('/^[a-zA-Z0-9_]{3,30}$/', $username)) {
        $_SESSION['error'] = 'Username must be 3-30 characters and contain only letters, numbers, and underscores.';
        header('Location: user-management.php');
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email address.';
        header('Location: user-management.php');
        exit;
    }
    // Check for existing username or email (excluding current user)
    $check = $conn->prepare("SELECT id FROM users WHERE (username=? OR email=?) AND id!=? LIMIT 1");
    $check->bind_param('ssi', $username, $email, $id);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        $_SESSION['error'] = 'Username or email already exists!';
        $check->close();
        header('Location: user-management.php');
        exit;
    }
    $check->close();
    if ($update_password) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if ($password !== $confirm_password) {
            $_SESSION['error'] = 'Passwords do not match!';
            header('Location: user-management.php');
            exit;
        } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
            $_SESSION['error'] = 'Password must be at least 8 characters and include uppercase, lowercase, and a number.';
            header('Location: user-management.php');
            exit;
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username=?, email=?, password=?, role=?, status=? WHERE id=?");
        $stmt->bind_param('ssssii', $username, $email, $hash, $role, $status, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username=?, email=?, role=?, status=? WHERE id=?");
        $stmt->bind_param('sssii', $username, $email, $role, $status, $id);
    }
    if ($stmt->execute()) {
        $_SESSION['success'] = 'User updated successfully!';
    } else {
        $_SESSION['error'] = 'Error: ' . $stmt->error;
    }
    $stmt->close();
    header('Location: user-management.php');
    exit;
}

$users = $conn->query("SELECT id, username, email, role, status, created_at FROM users");
?>
<body class="inner_page media_gallery">
    <div class="full_container">
        <div class="inner_container">
            <?php include("../templates/admin-sidebar.php"); ?>
            <div id="content">
                <?php include("../templates/topnav.php"); ?>
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title" id="page_title">
                                    <h2>User Management</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row column4 graph">
                            <div class="col-md-12">
                                <?php if(isset($_SESSION["success"])) { ?>
                                    <div id="successMsg" class="alert alert-success" role="alert"><?php echo $_SESSION["success"]; ?></div>
                                <?php unset($_SESSION["success"]); } ?>
                                <?php if(isset($_SESSION["error"])) { ?>
                                    <div id="errorMsg" class="alert alert-danger" role="alert"><?php echo $_SESSION["error"]; ?></div>
                                <?php unset($_SESSION["error"]); } ?>
                                <div class="full margin_30" id="dashboard">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#userModal" id="addUserBtn">+ Add User</button>
                                    </div>
                                    <table class="table projects table-bordered" id="UserList">
                                        <thead class="thead-dark dark-pink">
                                        <tr>
                                            <th style="text-align:center;">ID</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th style="text-align:center;">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row = $users->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                                <td><?php echo htmlspecialchars($row['role']); ?></td>
                                                <td><?php echo $row['status'] ? 'Active' : 'Inactive'; ?></td>
                                                <td><?php echo $row['created_at']; ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-info editUserBtn  fa fa-edit" 
                                                        data-id="<?php echo $row['id']; ?>" 
                                                        data-username="<?php echo htmlspecialchars($row['username'], ENT_QUOTES); ?>" 
                                                        data-email="<?php echo htmlspecialchars($row['email'], ENT_QUOTES); ?>" 
                                                        data-role="<?php echo $row['role']; ?>" 
                                                        data-status="<?php echo $row['status']; ?>"
                                                        ></a>
                                                    <?php if ($row['id'] !== $_SESSION['user_id']): ?>
                                                    <a href="user-management.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger fa fa-trash" onclick="return confirm('Delete this user?');"></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <form method="post" id="userForm" autocomplete="off">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="userModalLabel">Add User</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id" id="user_id">
                                  <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" id="username" class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" id="role" class="form-control">
                                      <option value="user">User</option>
                                      <option value="admin">Admin</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Status</label>
                                    <input type="checkbox" name="status" id="status" value="1" checked> Active
                                  </div>
                                  <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control" minlength="6">
                                  </div>
                                  <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" minlength="6">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-primary" id="modalSubmitBtn" name="add_user">Add User</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php include("../templates/footer.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery and scripts -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/animate.js"></script>
    <script src="../js/bootstrap-select.js"></script>
    <script src="../js/owl.carousel.js"></script>
    <script src="../js/Chart.min.js"></script>
    <script src="../js/Chart.bundle.min.js"></script>
    <script src="../js/utils.js"></script>
    <script src="../js/analyser.js"></script>
    <script src="../js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#UserList').DataTable({
                stripeClasses: [ 'odd-row', 'even-row' ]
            });
            let successMsg = document.getElementById('successMsg');
            if(successMsg) {
                setTimeout(() => {
                    successMsg.style.transition = "opacity 1s";
                    successMsg.style.opacity = 0;
                    setTimeout(() => successMsg.remove(), 1000);
                }, 3000);
            }
            let errorMsg = document.getElementById('errorMsg');
            if(errorMsg) {
                setTimeout(() => {
                    errorMsg.style.transition = "opacity 1s";
                    errorMsg.style.opacity = 0;
                    setTimeout(() => errorMsg.remove(), 1000);
                }, 3000);
            }
            // Open modal for add
            $('#addUserBtn').on('click', function() {
                $('#userModalLabel').text('Add User');
                $('#modalSubmitBtn').text('Add User').attr('name', 'add_user');
                $('#userForm')[0].reset();
                $('#user_id').val('');
                $('#status').prop('checked', true);
            });
            // Open modal for edit (event delegation for dynamic content)
            $(document).on('click', '.editUserBtn', function() {
                $('#userModalLabel').text('Edit User');
                $('#modalSubmitBtn').text('Update User').attr('name', 'edit_user');
                $('#user_id').val($(this).data('id'));
                $('#username').val($(this).data('username'));
                $('#email').val($(this).data('email'));
                $('#role').val($(this).data('role'));
                $('#status').prop('checked', $(this).data('status') == 1);
                $('#password').val('');
                $('#confirm_password').val('');
                $('#userModal').modal('show');
            });

            // JS validation for password strength and match
            $('#userForm').on('submit', function(e) {
                var password = $('#password').val();
                var confirmPassword = $('#confirm_password').val();
                var username = $('#username').val();
                var email = $('#email').val();
                var userId = $('#user_id').val();
                // Password validation only if password is set (add or edit)
                if(password.length > 0) {
                    var strong = password.length >= 8 && /[A-Z]/.test(password) && /[a-z]/.test(password) && /[0-9]/.test(password);
                    if (!strong) {
                        alert('Password must be at least 8 characters and include uppercase, lowercase, and a number.');
                        e.preventDefault();
                        return false;
                    }
                    if (password !== confirmPassword) {
                        alert('Passwords do not match!');
                        e.preventDefault();
                        return false;
                    }
                }
                // Username validation
                if(!/^[a-zA-Z0-9_]{3,30}$/.test(username)) {
                    alert('Username must be 3-30 characters and contain only letters, numbers, and underscores.');
                    e.preventDefault();
                    return false;
                }
                // Email validation
                var emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
                if(!emailPattern.test(email)) {
                    alert('Invalid email address.');
                    e.preventDefault();
                    return false;
                }
                // Duplicate check (client-side, for visible table only)
                var duplicate = false;
                $('#UserList tbody tr').each(function() {
                    var rowUsername = $(this).find('td:eq(1)').text().trim();
                    var rowEmail = $(this).find('td:eq(2)').text().trim();
                    var rowId = $(this).find('td:eq(0)').text().trim();
                    if ((rowUsername.toLowerCase() === username.toLowerCase() || rowEmail.toLowerCase() === email.toLowerCase()) && rowId !== userId && userId === '') {
                        duplicate = true;
                    }
                    if ((rowUsername.toLowerCase() === username.toLowerCase() || rowEmail.toLowerCase() === email.toLowerCase()) && rowId !== userId && userId !== '') {
                        duplicate = true;
                    }
                });
                if(duplicate) {
                    alert('Username or email already exists!');
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
    <script src="../js/jquery.fancybox.min.js"></script>
    <script src="../js/custom.js"></script>
    <!-- <script src="../js/semantic.min.js"></script> -->
</body>
</html>
