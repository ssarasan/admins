<?php
include('../connect.php');
// session_start();
if(!isset($_SESSION["user"])){
    header("Location:login.php");
}
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
               <a data-category-id="<?php echo htmlentities($row['id']) ?>" data-manage="Manage"  data-user="Admin"
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
                  <li><a data-category-id="<?php echo htmlentities($row['id']) ?>" data-manage="Manage" data-user="Admin"
                        data-category="<?php echo htmlentities($row['category_name']) ?>"
                        href="#<?php echo htmlentities($row['category_name']) ?>"> > <span>Manage
                           <?php echo htmlentities($row['category_name']); ?></span></a></li>
               </ul>
            </li>
         <?php } ?>
         <!-- Manage Section at the end -->

      </ul>               
      <ul class="list-unstyled components">
       <li>
            <a href="#manageSubmenu" data-toggle="collapse" aria-expanded="false" >
               <i class="fa fa-gear orange_color"></i> <span>Manage</span> <i class="fa fa-angle-right right orange_color"></i>
            </a>
            <ul class="collapse list-unstyled" id="manageSubmenu">
               <li>
                  <a href="category.php"><i class="fa fa-tags orange_color"></i> Category</a>
               </li>
               <li>
                  <a href="user-management.php"><i class="fa fa-users orange_color"></i> Users</a>
               </li>
            </ul>
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