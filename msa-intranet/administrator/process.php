<?php
include("../connect.php");
if (isset($_POST["create"])) {
    $fileNames = "";
    if (!empty($_FILES['files']['name'])) {
        $uploadDir = "uploads/";
        $fileArray = [];
        foreach ($_FILES['files']['name'] as $key => $name) {
            if ($_FILES['files']['error'][$key] == 0) {
                $tmpName = $_FILES['files']['tmp_name'][$key];
                $newName = time() . "_" . basename($name);
                $targetPath = $uploadDir . $newName;

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $fileArray[] = $newName; // Store file names
                }
            }
    }
    $fileNames = implode(",", $fileArray);
    }
    // print_r($_POST);
    // Get POST values
    $category_name = $_POST["category_name"];
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']); // Make sure it matches your DB IDs
    $document_no = mysqli_real_escape_string($conn, $_POST['document_no']);
    $revision_no = mysqli_real_escape_string($conn, $_POST['revision_no']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    if($date != '') {
        $date = date('d-M-Y', strtotime($date));
    }

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO posts (category_id, date, name, document_no,revision_no, file_name) VALUES (?, ?, ?, ?, ?,?)");
    $stmt->bind_param("isssss", $category_id, $date, $name, $document_no, $revision_no,$fileNames);
    
    // Execute
    if ($stmt->execute()) {
        session_start();
        $_SESSION["success"] = $_POST['category_name']." added successfully";
        header("Location:index.php?category_name=$category_name&category_id=$category_id");
    } else {
        $_SESSION["error"] = $stmt->error;
        // echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

if (isset($_POST["update"])) {
    $fileNames = "";
    if (!empty($_FILES['files']['name'])) {
        $uploadDir = "uploads/";
        $fileArray = [];
        foreach ($_FILES['files']['name'] as $key => $name) {
            if ($_FILES['files']['error'][$key] == 0) {
                $tmpName = $_FILES['files']['tmp_name'][$key];
                $newName = time() . "_" . basename($name);
                $targetPath = $uploadDir . $newName;
                
                if (move_uploaded_file($tmpName, $targetPath)) {
                    $fileArray[] = $newName; // Store file names
                }
            }
        }
        $fileNames = implode(",", $fileArray);
    }
    
    $category_name = $_POST["category_name"];
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $document_no = mysqli_real_escape_string($conn, $_POST['document_no']);
    $revision_no = mysqli_real_escape_string($conn, $_POST['revision_no']);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']); // Make sure it matches your DB IDs
    $sqlUpdate = "UPDATE posts SET category_id='$category_id' ,name = '$name', document_no='$document_no', revision_no = '$revision_no', date = '$date', file_name='$fileNames' WHERE id = $id";
    if (mysqli_query($conn, $sqlUpdate)) {
        session_start();
        $_SESSION["success"] = $category_name." udpated successfully";
        header("Location:index.php");
    } else {
        die("Data is not updated!");
    }
}
if (isset($_GET['category_name'])) {
    include("../connect.php");
    $stmt = $conn->prepare("
    SELECT t.date, t.title, t.summary, t.file_name 
    FROM posts t
    JOIN category c ON t.category_id = c.id
    WHERE c.category_name like ?
    ORDER BY t.date DESC
    ");
    $category_name = $_GET['category_name'];
    $stmt->bind_param("s", $category_name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo '                                    <div class="full graph_head">
        
        </div>
        <div class="full gallery_section_inner padding_infor_info">
        <div class="row" >';
        while ($row = $result->fetch_assoc()) {
        echo '<div class="col-sm-4 col-md-2 margin_bottom_30">
                                                <div class="column">
                                                    <a data-fancybox="gallery" href="images/layout_img/g1.jpg" ><i class = "fa fa-file-pdf-o fa-13x msa_blue_color msa_white_bg"></i></a>
                                                </div>
                                                <div class="heading_section">
                                                    <h4>'. htmlspecialchars($row['title']) . '</h4>
                                                </div>
                                            </div>';
        
        
            // echo "<tr>";
            // echo "<td>" . htmlspecialchars($row['date']) . "</td>";
            // echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            // echo "<td>" . htmlspecialchars($row['summary']) . "</td>";
            // echo "<td><a href='uploads/" . htmlspecialchars($row['file_name']) . "' target='_blank'>View</a></td>";
            // echo "</tr>";
        }
        // echo "</table>";
        echo "</div></div>";
    } else {
        echo "<p>No data found for $category_name.</p>";
    }
}
if (isset($_POST["delete"])) {
$sqlDelete = "DELETE FROM posts WHERE id = $id";
if(mysqli_query($conn, $sqlDelete)){
    session_start();
    $_SESSION["success"] = "Post deleted successfully";
    header("Location:index.php");
}else{
    die("Something is not write. Data is not deleted");
}
}
?>