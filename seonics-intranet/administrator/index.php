<?php
include("../templates/admin-header.php");
include('../connect.php');
?>

<body class="inner_page media_gallery">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <?php
            include("../templates/admin-sidebar.php");
            ?>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <?php
                include("../templates/topnav.php");
                ?>

                <!-- end topbar -->
                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title" id="page_title">
                                    <h2><?php if(isset($_GET['category_name'])){ echo 'Manage '.$_GET['category_name']; } else { echo ''; }?></h2>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                        
                        <div class="row column4 graph">
                            <!-- Gallery section -->
                            <div class="col-md-12">
                                <?php if(isset($_SESSION["success"])) { ?>
                                    <div id="successMsg" class="alert alert-success" role="alert"><?php echo $_SESSION["success"]; ?></div>
                                    <?php } ?>
                                    <div class="white_shd full margin_bottom_30" id="dashboard">
                                    <?php if(isset($_GET["category_id"])) { ?>
                                       
                                            <?php } unset($_SESSION["success"]);
    ?>
                                        <div class="container">
    <div class="welcome">Welcome to –
    <span class="intranet">Intranet</span></div>
    <div class="company">Southern Electronics Pvt. Ltd.</div>
  </div>
                            </div>
                        </div>
                        <!-- footer -->
                        <?php
include("../templates/footer.php");
?>     
                        
                        
                    </div>
                    <!-- end dashboard inner -->
                </div>
            </div>
            <!-- model popup -->
            <!-- The Modal -->
            <div class="modal fade" id="Delete">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Are You Sure?</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            Do you want to delete this file?
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="Delete">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end model popup -->
        </div>
    </div>
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- wow animation -->
    <script src="../js/animate.js"></script>
    <!-- select country -->
    <script src="../js/bootstrap-select.js"></script>
    <!-- owl carousel -->
    <script src="../js/owl.carousel.js"></script>
    <!-- chart js -->
    <script src="../js/Chart.min.js"></script>
    <script src="../js/Chart.bundle.min.js"></script>
    <script src="../js/utils.js"></script>
    <script src="../js/analyser.js"></script>
    <!-- nice scrollbar -->
    <script src="../js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- fancy box js -->
    <script src="../js/jquery-3.3.1.min.js"></script>
          <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
      $('#FileList').DataTable({
        stripeClasses: [ 'odd-row', 'even-row' ]
        });

        let successMsg = document.getElementById('successMsg');
        setTimeout(() => {
        msg.style.transition = "opacity 1s";
        msg.style.opacity = 0;
        setTimeout(() => successMsg.remove(), 1000);
        }, 3000);
        
        
    });

  </script>
    <script src="../js/jquery.fancybox.min.js"></script>
    <!-- custom js -->
    <script src="../js/custom.js"></script>
    <!-- calendar file css -->
    <script src="../js/semantic.min.js"></script>
    
</body>

</html>