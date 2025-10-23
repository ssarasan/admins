<?php
include('connect.php');
session_start();
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
                                               <thead class="thead-dark dark-pink" >
                                                    <tr>
                                                        <th style="width: 6%"> SL. No.</th>
                                                        <th style="width: 12%; text-align:center;"> Document. No</th>
                                                        <th style="width: 7%; text-align:center;"> Rev. No</th>
                                                        <th style="width: 15%; text-align:center;"> Date</th>
                                                        <th style="width: 45%">Document Name</th>
                                                        <?php if(isset($_SESSION["user"]) && isset($_GET['Admin'])){ 
                                                            echo '<th style="width: 20%; text-align:center;"><i class="fa fa-paperclip fa-lg"></i></th>';
                                                        } else{
                                                            echo '<th style="width: 10%; text-align:center;"><i class="fa fa-paperclip fa-lg"></i></th>';

                                                             } ?>
                                                            
                                                  </tr>
                                               </thead>
                                               <tbody>
                                                <?php
                                                    $sqlSelectPost = "SELECT * FROM posts WHERE status=1 and category_id = ".$_GET["category_id"];
                                                    $fileList = mysqli_query($conn, $sqlSelectPost);
                                                    $i = 1;
                                                    while ($data = mysqli_fetch_array($fileList)) {
                                                        $fileNames = explode(',', $data['file_name']);
                                                        foreach ($fileNames as $fileName) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo  $i++; ?></td>
                                                        <td style="text-align:center;"><?php echo  $data['document_no']; ?></td>
                                                        <td style="text-align:center;"><?php echo $data['revision_no']; ?></td>
                                                        <td style="text-align:center;"><?php echo date('d-M-Y', strtotime($data['date'])); ?></td>
                                                        <td><?php echo $data['name']; ?></td>
                                                        
                                                             <td style="text-align:center;">
                                                                <a data-category-id="<?php echo htmlentities($data['id'])?>" class="btn btn-info fa fa-eye" target="_blank" href="/seonics-intranet/view.php?filename=<?php echo $fileName; ?>"></a>
                <?php if(isset($_SESSION["user"]) && isset($_GET['Admin'])){
                                                            ?><a data-manage="Update" data-category-id="<?php echo htmlentities($data['id']) ?>"
                  data-category="<?php echo htmlentities($_GET['category_name']) ?>" onclick="handleCategoryClick()" id="UpdatePost" data-id="<?php echo htmlentities($data['id'])?>" class="btn btn-warning fa fa-edit"  href="#"></a>
                <a data-manage="Delete" data-category-id="<?php echo htmlentities($data['id']) ?>"
                  data-category="<?php echo htmlentities($_GET['category_name']) ?>" onclick="handleCategoryClick()" class="btn btn-danger fa fa-trash" data-id="<?php echo htmlentities($data['id'])?>"  id="deletePost" href="#<?php echo $data["id"]?>"></a><?php
                                                        } ?></td>
                
                                                    </tr>
        <?php
        
    } } ?>

                                            

                                               
                                               </tbody>
                                            </table>
                                            
                                        <?php } 
                                        
                                        if(isset($_GET["type"]) && $_GET["type"] == "Add"){                                                     
                                        ?>
                                        <form action="process.php" name="addpost" method="post" enctype="multipart/form-data">
                                            <div class="form-group ">

                                        <label for="exampleInputEmail1">Category</label>

                                        <select name="category_id" class="form-control" ><option class="form-control" value="<?php echo $_GET['category_id'];?>" ><?php echo $_GET['category_name'];?></option>
                                    </select>
                                    <input type="text" hidden class="form-control" name="category_name" value="<?php echo $_GET['category_name'];?>"  >

                                    </div>
                                       <div class="form-group ">

                                        <label for="exampleInputEmail1">Document No</label>

                                        <input type="text" class="form-control" name="document_no" id="document_no" placeholder="Enter Document No"  >

                                    </div>
                                       <div class="form-group ">

                                        <label for="exampleInputEmail1">Revision No</label>

                                        <input type="text" class="form-control" name="revision_no" id="revision_no" placeholder="Enter Revision No"  >

                                    </div>
                                       <div class="form-group ">

                                        <label for="exampleInputEmail1">Date</label>

                                        <input type="date" class="form-control" name="date" id="aero_date" placeholder="Enter Date" max="<?php echo date('Y-m-d'); ?>"  >

                                    </div>



                                    <div class="form-group ">

                                        <label for="exampleInputEmail1">Document Name</label>

                                        <input type="text" class="form-control" id="name_aero" name="name" placeholder="Enter Document Name" required="">

                                    </div>
                                     <div class="form-group">

                                    <label for="exampleInputFile">Attach File</label>

                                    <input class="form-control" type="file" name="files[]" multiple="multiple" id="file" required="">

                                    <p class="help-block">File size should not exceed more than 2MB </p>

                                </div>

                               <button type="submit" name="create" class="btn btn-success waves-effect waves-light">Save and Post</button>

                                <!-- <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button> -->

                            </form>

                            
                                        <?php } 
                                        if(isset($_GET["type"]) && $_GET["type"] == "Update"){
                                            $post_id = $_GET['post_id'];
                                            $sqlSelectPost = "SELECT p.*, c.category_name	 FROM posts p, category c	where p.id=$post_id and p.category_id	= c.id";
                                            $resultPost = mysqli_query($conn,$sqlSelectPost);
                                            $postData = mysqli_fetch_array($resultPost)          
                                        ?>
                                        <form action="process.php" name="addpost" method="post" enctype="multipart/form-data">
                                            <div class="form-group ">

                                        <label for="exampleInputEmail1">Category</label>

                                        <select name="category_id" class="form-control" ><option class="form-control" value="<?php echo $postData['category_id'];?>" ><?php echo $postData['category_name'];?></option>
                                    </select>
                                    <input type="text" hidden class="form-control" name="category_name" value="<?php echo $postData['category_name'];?>"  >

                                    </div>
                                    <div class="form-group ">

                                        <label for="exampleInputEmail1">Document No</label>

                                        <input type="text" class="form-control" name="document_no" id="document_no" value="<?php echo $postData['document_no'];?>"  >

                                    </div>
                                    </div>
                                       <div class="form-group ">

                                        <label for="exampleInputEmail1">Revision No</label>

                                        <input type="text" class="form-control" name="revision_no" id="revision_no"  value="<?php echo $postData['revision_no'];?>"  >

                                    </div>
                                       <div class="form-group ">

                                        <label for="exampleInputEmail1">Date</label>
                                        <input type="date" class="form-control" name="date" id="aero_date" value="<?php echo isset($postData['date']) ? date('Y-m-d', strtotime($postData['date'])) : ''; ?>" >

                                    </div>
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1">Document Name</label>
                                        <input type="text" class="form-control" id="name_aero" name="name" value="<?php echo $postData['name'];?>" required="">
                                   </div>
                                                    
                                <div class="form-group">
                                    <label for="exampleInputFile">Attach File</label>
                                    <input class="form-control" type="file" name="files[]" multiple="multiple" id="file" required="" value="<?php echo $postData['file_name'];?>">
                                    <p class="help-block">File size should not exceed more than 2MB </p>
                                </div>
                                <input type="submit" name="update" class="btn btn-success waves-effect waves-light">Update</button>
                                <!-- <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button> -->
                            </form>
                           
                                        <?php } if(isset($_GET["type"]) && $_GET["type"] == "Calendar"){
                                        ?>
                                           <div class="row">
                                                   <div class="col-md-12">
                                                      <div class="full">
                                                         <div class="ui calendar" id="example14"></div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <?php } if(isset($_GET["type"]) && $_GET["type"] == "Delete"){
                                                    $post_id = $_GET['post_id'];
                                                    $sqlDelete = "DELETE FROM posts WHERE id = $post_id";
                                                    if(mysqli_query($conn, $sqlDelete)){
                                                        $_SESSION["success"] = "Document deleted successfully";die;
                                                    }else{
    echo "Something is not write. Data is not deleted";
} }?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end row -->
                     </div>