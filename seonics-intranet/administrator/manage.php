<?php
include('../connect.php');
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
                                                        <th style="width: 10%"> Sl. No.</th>
                                                        <th style="width: 20%"> Title</th>
                                                        <th style="width: 20%"> Description</th>
                                                        <th style="width: 30%">FileName</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                            
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
                                                        <td><?php echo  $data['name']; ?></td>
                                                        <td><?php echo $data['description']; ?></td>
                                                        <td><?php echo $fileName; ?></td>
                                                        <td><?php echo $data['date']; ?></td>
                                                        
                                                             <td>
                                                                <a data-category-id="<?php echo htmlentities($data['id'])?>" class="btn btn-info fa fa-eye" target="_blank" href="../view.php?filename=<?php echo $fileName; ?>"></a>
                <?php if(isset($_SESSION["user"])){
                                                            ?><a data-manage="Update" id="UpdatePost" data-id="<?php echo htmlentities($data['id'])?>" class="btn btn-warning fa fa-edit"  href="#"></a>
                <a data-manage="Delete" class="btn btn-danger fa fa-trash" data-id="<?php echo htmlentities($data['id'])?>"  id="deletePost" href="#<?php echo $data["id"]?>"></a><?php
                                                        } ?></td>
                
                                                    </tr>
        <?php
        
    } } ?>

                                            

                                               
                                               </tbody>
                                            </table>
                                            
                                        <?php } 
                                        
                                        if(isset($_GET["type"]) && $_GET["type"] == "Add"){ 
                                            $sqlSelectCategory = "SELECT * FROM category where status=1";
                                            $resultCategory = mysqli_query($conn,$sqlSelectCategory);            
                                        ?>
                                        <form action="process.php" name="addpost" method="post" enctype="multipart/form-data">
                                            <div class="form-group ">

                                        <label for="exampleInputEmail1">Category</label>

                                        <select name="category_id" class="form-control" ><option class="form-control" value="<?php echo $_GET['category_id'];?>" ><?php echo $_GET['category_name'];?></option>
                                    </select>
                                    <input type="text" hidden class="form-control" name="category_name" value="<?php echo $_GET['category_name'];?>"  >

                                    </div>
                                       <div class="form-group ">

                                        <label for="exampleInputEmail1">Date</label>

                                        <input type="date" class="form-control" name="date" id="aero_date" placeholder="Enter Date"  >

                                    </div>



                                    <div class="form-group ">

                                        <label for="exampleInputEmail1">Name</label>

                                        <input type="text" class="form-control" id="name_aero" name="name" placeholder="Name" required="">

                                    </div>
                                    <div class="form-group ">

                                        <label for="exampleInputEmail1">Description</label>

                                        <textarea class="form-control" name="description" id="description" required></textarea>

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
                                            $sqlSelectCategory = "SELECT * FROM category where status=1";
                                            $resultCategory = mysqli_query($conn,$sqlSelectCategory);            
                                        ?>
                                        <form action="process" name="addpost" method="post" enctype="multipart/form-data">
                                            <div class="form-group ">

                                        <label for="exampleInputEmail1">Category</label>

                                        <select name="category_id" class="form-control" ><option class="form-control" value="<?php echo $_GET['category_id'];?>" ><?php echo $_GET['category_name'];?></option>
                                    </select>
                                    <input type="text" hidden class="form-control" name="category_name" value="<?php echo $_GET['category_name'];?>"  >

                                    </div>
                                       <div class="form-group ">

                                        <label for="exampleInputEmail1">Date</label>

                                        <input type="date" class="form-control" name="date" id="aero_date" placeholder="Enter Date"  >

                                    </div>



                                    <div class="form-group ">

                                        <label for="exampleInputEmail1">Name</label>

                                        <input type="text" class="form-control" id="name_aero" name="name" placeholder="Name" required="">

                                    </div>
                                    <div class="form-group ">

                                        <label for="exampleInputEmail1">Description</label>

                                        <textarea class="form-control" name="description" id="description" required></textarea>

                                    </div>




                               






                                <div class="form-group">

                                    <label for="exampleInputFile">Attach File</label>

                                    <input class="form-control" type="file" name="files[]" multiple="multiple" id="file" required="">

                                    <p class="help-block">File size should not exceed more than 2MB </p>

                                </div>







                                <button type="submit" name="create" class="btn btn-success waves-effect waves-light">Save and Post</button>

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
                                                <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end row -->
                     </div>