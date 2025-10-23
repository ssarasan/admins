<?php
include('../connect.php');
$sqlSelectCategory = "SELECT * FROM category";
$resultCategory = mysqli_query($conn, $sqlSelectCategory);
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
            <div class="logo_section"><a href="index.php"><img class="img-responsive" src="images/logo/msa_logo.png"
                     alt="#" /></a></div>
         </div>
      </div>
   </div>
   <div class="sidebar_blog_2">
      <ul>
         <li class="active">
            <a href="../index.php"> <i class="fa fa-home orange_color"></i>Home</a>
         </li>
      </ul>
      <ul class="list-unstyled components" id="categoryLinks">

         <?php while ($row = $resultCategory->fetch_assoc()) { ?>

            <li>
               <a data-category-id="<?php echo htmlentities($row['id']) ?>" data-manage="Manage"
                  data-category="<?php echo htmlentities($row['category_name']) ?>"
                  href="#<?php echo htmlentities($row['category_name']); ?>" data-toggle="collapse"
                  aria-expanded="false"><i class="fa <?php echo htmlentities($row['category_icon']); ?> orange_color"></i>
                  <span><?php echo htmlentities($row['category_name']); ?></span><i
                     id="<?php echo htmlentities($row['category_name']) . "-fa-icon"; ?>"
                     class="fa fa-angle-right right orange_color"></i></a>
               <ul class="collapse list-unstyled" id="<?php echo htmlentities($row['category_name']); ?>">
                  <li><a data-category-id="<?php echo htmlentities($row['id']) ?>" data-manage="Add"
                        data-category="<?php echo htmlentities($row['category_name']) ?>"
                        href="#<?php echo htmlentities($row['category_name']) ?>">> <span>Add
                           <?php echo htmlentities($row['category_name']); ?></span></a></li>
                  <li><a data-category-id="<?php echo htmlentities($row['id']) ?>" data-manage="Manage"
                        data-category="<?php echo htmlentities($row['category_name']) ?>"
                        href="#<?php echo htmlentities($row['category_name']) ?>"> > <span>Manage
                           <?php echo htmlentities($row['category_name']); ?></span></a></li>
               </ul>
            </li>
         <?php } ?>

         <li><a data-manage="Calendar" href="#"><i class="fa fa-calendar orange_color"></i> <span>Calendar</span></a>
         </li>
      </ul>
   </div>
</nav>
<script>
   // Toggle submenu and arrow
   document.querySelectorAll("li.has-children > a").forEach(link => {
      link.addEventListener("click", function (e) {
         e.preventDefault();
         const parent = this.parentElement;
         parent.classList.toggle("active");
      });
   });
</script>