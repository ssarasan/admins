<?php
include("../templates/admin-header.php");
include('../connect.php');

// Handle Create
if (isset($_POST['add_category'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $category_icon = mysqli_real_escape_string($conn, $_POST['category_icon']);
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;
    $sql = "INSERT INTO category (category_name, category_icon, status) VALUES ('$category_name', '$category_icon', $status)";
    mysqli_query($conn, $sql);
    $_SESSION['success'] = 'Category added successfully!';
    header('Location: category.php');
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM category WHERE id=$id";
    mysqli_query($conn, $sql);
    $_SESSION['success'] = 'Category deleted successfully!';
    header('Location: category.php');
    exit;
}

// Handle Edit (Update)
if (isset($_POST['edit_category'])) {
    $id = intval($_POST['id']);
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $category_icon = mysqli_real_escape_string($conn, $_POST['category_icon']);
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;
    $sql = "UPDATE category SET category_name='$category_name', category_icon='$category_icon', status=$status WHERE id=$id";
    mysqli_query($conn, $sql);
    $_SESSION['success'] = 'Category updated successfully!';
    header('Location: category.php');
    exit;
}

$categories = mysqli_query($conn, "SELECT id, category_name, category_icon, status FROM category");
?>
<body class="inner_page media_gallery">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <?php include("../templates/admin-sidebar.php"); ?>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <?php include("../templates/topnav.php"); ?>
                <!-- end topbar -->
                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title" id="page_title">
                                    <h2>Category Management</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row column4 graph">
                            <div class="col-md-12">
                                <?php if(isset($_SESSION["success"])) { ?>
                                    <div id="successMsg" class="alert alert-success" role="alert"><?php echo $_SESSION["success"]; ?></div>
                                <?php unset($_SESSION["success"]); } ?>
                                <div class="full margin_bottom_30" id="dashboard">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal" id="addCategoryBtn">+ Add Category</button>
                                    </div>
                                    <table class="table table-bordered" id="FileList">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Icon</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($categories)): ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['category_icon']); ?></td>
                                                <td><?php echo $row['status'] ? 'Active' : 'Inactive'; ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-info editCategoryBtn" 
                                                        data-id="<?php echo $row['id']; ?>" 
                                                        data-name="<?php echo htmlspecialchars($row['category_name'], ENT_QUOTES); ?>" 
                                                        data-icon="<?php echo htmlspecialchars($row['category_icon'], ENT_QUOTES); ?>" 
                                                        data-status="<?php echo $row['status']; ?>"
                                                        >Edit</button>
                                                    <a href="category.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?');">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <form method="post" id="categoryForm">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id" id="category_id">
                                  <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Category Icon</label>
                                    <input type="text" name="category_icon" id="category_icon" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="category_status" class="form-control">
                                      <option value="1">Active</option>
                                      <option value="0">Inactive</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-primary" id="modalSubmitBtn" name="add_category">Add Category</button>
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
            $('#FileList').DataTable({
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

            // Open modal for add
            $('#addCategoryBtn').on('click', function() {
                $('#categoryModalLabel').text('Add Category');
                $('#modalSubmitBtn').text('Add Category').attr('name', 'add_category');
                $('#categoryForm')[0].reset();
                $('#category_id').val('');
            });

            // Open modal for edit (event delegation for dynamic content)
            $(document).on('click', '.editCategoryBtn', function() {
                $('#categoryModalLabel').text('Edit Category');
                $('#modalSubmitBtn').text('Update Category').attr('name', 'edit_category');
                $('#category_id').val($(this).data('id'));
                $('#category_name').val($(this).data('name'));
                $('#category_icon').val($(this).data('icon'));
                $('#category_status').val($(this).data('status'));
                $('#categoryModal').modal('show');
            });
        });
    </script>
    <script src="../js/jquery.fancybox.min.js"></script>
    <script src="../js/custom.js"></script>
    <!-- <script src="../js/semantic.min.js"></script> -->
</body>
</html>
