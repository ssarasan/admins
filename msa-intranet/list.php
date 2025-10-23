<?php
include('connect.php');
?>
<div class="row column1">
                        <div class="col-md-12">
                           <div class="white_shd full ">
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div >
                                        <?php if(isset($_GET["type"]) && $_GET["type"] == "Manage"){ 
                                            ?>
                                            <table class="table table-striped projects" id="FileList">
                                               <thead class="thead-dark">
                                                    <tr>
                                                        <th style="width: 20%"> Title</th>
                                                        <th style="width: 20%"> Description</th>
                                                        <th>FileName</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                            
                                                  </tr>
                                               </thead>
                                               <tbody>
                                                <?php
                                                    $sqlSelectPost = "SELECT * FROM posts WHERE status=1 and category_id = ".$_GET["category_id"];
                                                    $fileList = mysqli_query($conn, $sqlSelectPost);
                                                    while ($data = mysqli_fetch_array($fileList)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo  $data['name']; ?></td>
                                                        <td><?php echo $data['description']; ?></td>
                                                        <td><?php echo $data['file_name']; ?></td>
                                                        <td><?php echo $data['date']; ?></td>
                                                        
                                                             <td>
                                                                <a data-category-id="<?php echo htmlentities($data['id'])?>" class="btn btn-info fa fa-eye" target="_blank" href="../view.php?filename=<?php echo $data["file_name"]?>"></a>
               </td>
                
                                                    </tr>
        <?php
        
    } 
    ?>

                                            

                                               
                                               </tbody>
                                            </table>
                                            
                                        <?php } 
                                        if(isset($_GET["type"]) && $_GET["type"] == "Calendar"){ 
                                        ?>
                                           <div class="row">
                                                   <div class="col-md-12">
                                                      <div class="full">
                                                         <div class="ui calendar" id="example14"></div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end row -->
                     </div>