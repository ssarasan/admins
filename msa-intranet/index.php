<?php
include("templates/header.php");
include('connect.php');
?>

<body class="inner_page media_gallery">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <?php
            include("templates/sidebar.php");
            ?>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <?php
                include("templates/topnav.php");
                ?>

                <!-- end topbar -->
                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title" id="page_title">
                                    <h2></h2>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                         
                        <div class="row column4 graph">
                            <!-- Gallery section -->
                            <div class="col-md-12">
                                <?php if(isset($_SESSION["success"])) { ?>
                                <div class="alert alert-success" role="alert"><?php echo $_SESSION["success"]; ?></div>
                                <?php } ?>
                                <div class="white_shd full margin_bottom_30" id="dashboard">
                                    <?php if(isset($_GET["category_id"])) { ?>
                                       
                                            <?php } unset($_SESSION["success"]);
    ?>
                                        
<style>

    .container {
      background-color: #ffffff;
      padding: 100px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
      text-align: center;
    }
    .welcome {
      color: #000000; /* Black */
      font-size: 40px;
    }
    .intranet {
      color: #F7941D; /* Orange */
      font-size: 41px;
      font-weight: bold;
    }
    .company {
      color: #0070C0; /* Blue */
      font-size: 35px;
      margin-top: 20px;
      font-weight:bolder;
    }
  </style>
    <div class="container">
    <div class="welcome">Welcome to –
    <span class="intranet">Intranet</span></div>
    <div class="company">MSA Global Technology & Engineering Pvt. Ltd.</div>
  </div>



                                       
                                    
                            </div>
                        </div>
                        <!-- footer -->
                        <?php
include("templates/footer.php");
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
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- wow animation -->
    <script src="js/animate.js"></script>
    <!-- select country -->
    <script src="js/bootstrap-select.js"></script>
    <!-- owl carousel -->
    <script src="js/owl.carousel.js"></script>
    <!-- chart js -->
    <script src="js/Chart.min.js"></script>
    <script src="js/Chart.bundle.min.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/analyser.js"></script>
    <!-- nice scrollbar -->
    <script src="js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- fancy box js -->
    <script src="js/jquery-3.3.1.min.js"></script>
          <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
      $('#FileList').DataTable({
  stripeClasses: [ 'odd-row', 'even-row' ]
});
      $('#myTable').DataTable();
    });
  </script>
    <script src="js/jquery.fancybox.min.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
    <!-- calendar file css -->
    <script src="js/semantic.min.js"></script>
    
</body>

</html>