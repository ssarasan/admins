<?php
include("templates/header.php");
?>

<!-- FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<!-- Semantic UI -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.js"></script>

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
            <!-- end sidebar -->

            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Calendar</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="row">
                     <!-- invoice section -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="row">
                              <div class="col-md-12">
                                 <!-- Modal -->
                                 <div id="calendar"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
               </div>
               <!-- footer -->
               <?php include('templates/footer.php'); ?>
            </div>
            <!-- end dashboard inner -->
         </div>
      </div>
      <!-- model popup -->
      <!-- The Modal -->
      <div class="modal" id="myModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="modal-title">Meeting Details</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body" style="text-align:left;">
                  <p><strong>Title:</strong> <span id="modalTitle"></span></p>
                  <p><strong>Start:</strong> <span id="modalStart"></span></p>
                  <p><strong>End:</strong> <span id="modalEnd"></span></p>
               </div>
               <!-- Modal footer -->
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!-- end model popup -->
   </div>
   <script>
      document.addEventListener('DOMContentLoaded', function () {
         var calendarEl = document.getElementById('calendar');

         var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: 'events.php?action=read',
            eventClick: function (info) {
               console.log(info.event.title)
               console.log(info.event.startStr)
               console.log(info.event.end)
               // Fill modal with event details
               document.getElementById('modalTitle').textContent = info.event.title;
               document.getElementById('modalStart').textContent = info.event.startStr;
               document.getElementById('modalEnd').textContent = info.event.end ? info.event.end.toISOString().split('T')[0] : "—";

               // Show Semantic UI modal
               $('#myModal').modal('show');
            }
         });

         calendar.render();
      });
   </script>
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
   <script src="js/jquery.fancybox.min.js"></script>
   <!-- custom js -->
   <script src="js/custom.js"></script>
   <!-- calendar file css -->
   <script src="js/semantic.min.js"></script>
</body>

</html>