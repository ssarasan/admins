<?php
include('./connect.php');
$sqlSelectCategory = "SELECT * FROM category";
$resultCategory = mysqli_query($conn,$sqlSelectCategory);            
?>
<nav id="sidebar">
   <div class="sidebar_blog_1">
      <div class="sidebar-header">
         <div class="logo_section">
            <a href="index.php"><img class="logo_icon img-responsive" src="images/logo/msa_logo.png" alt="#" /></a>
         </div>
      </div>
      <div class="sidebar_user_info msa_dark_blue_bg ">
         <div class="icon_setting"></div>
         <div class="user_profle_side">
            <div class="logo_section"><img class="img-responsive" src="images/logo/msa_logo.png" alt="#" /></div>
            <!-- <div class="user_info">
               <h6><?php //echo $_SESSION["user"] ?></h6>
               <p><span class="online_animation"></span> Online</p>
            </div> -->
         </div>
      </div>
   </div>
   <div class="sidebar_blog_2">
        <ul>
                  <!-- <li><a href="icons.html"> <span>Icons</span></a></li> -->
                  <li class="active">
                     <a href="index.php" > <i class="fa fa-home orange_color"></i>Home</a>            
                  </li>
         </ul>
         
         <ul class="list-unstyled components"  id="categoryLinks">
            
            <?php while($row = $resultCategory->fetch_assoc()) { ?>
               
               <li>                        
                  <a data-user="User" data-manage="Manage" data-category-id="<?php echo htmlentities($row['id'])?>" data-category="<?php echo htmlentities($row['category_name'])?>" href="#<?php echo htmlentities($row['category_name']);?>" data-toggle="collapse" aria-expanded="false"><i class="fa <?php echo htmlentities($row['category_icon']);?> orange_color"></i> <span><?php echo htmlentities($row['category_name']);?></span><i class="fa fa-angle-right right orange_color"></i></a>
                  
               </li>
               <?php } ?>
               
            </ul>
            <!-- <ul>
               <li ><a href="calendar.php"><i style="padding-top: 10px !important;" class="fa fa-calendar orange_color"></i> <span style="padding-top: 10px !important;" >Calendar</span><i style="padding-top: 10px !important;" class="fa fa-angle-right right orange_color"></i></a></li>                      
             </ul> -->
      </div>
   </nav>
      