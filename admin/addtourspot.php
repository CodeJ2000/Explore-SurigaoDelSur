<?php
  ob_start();
  require_once "../config/init.php";
  include "admin-partials/side-nav.php";
  include "admin-partials/topbar.php";
?>
<?php
if(isset($_GET['update'])){
    $update_id = sanitize_input($_GET['update']);
    $get_data = Destination::action()->get_by_id_destination($update_id);
    $get_cat = Destination::action()->get_by_id_category($get_data[0]->cat_id);
    
    if(!empty($get_data)){
        $touristspot_name = $get_data[0]->name;
        $description = $get_data[0]->description;
        $purok = $get_data[0]->purok;
        $guides = $get_data[0]->guides;
        $category_id = $get_cat[0]->id;
        $barangay = $get_data[0]->barangay;
        $city_mun = $get_data[0]->city_mun;
        $yt_link = $get_data[0]->youtube_url;
    }
} else {
//Return the data that user filled if the user fill some data so that it will not clear the form.
  $touristspot_name = $_POST['name'] ?? "";
  $description = $_POST['description'] ?? ""; 
  $purok = $_POST['purok'] ?? ""; 
  $guides = $_POST['guides'] ?? "";
  $category_id = $_POST['category'] ?? ""; 
  $barangay = $_POST['barangay'] ?? ""; 
  $city_mun = $_POST['city_mun'] ?? "";
  $yt_link = $_POST['yt_link'] ?? "";
}

  //Check if the $_POST is more than 0.
  if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_GET['update'])){
        $errors = Destination::action()->update_destination($_POST, $update_id);
    } else {
        //insert the data into the database table destination if not success it will return the $errors array for error message.
          $errors = Destination::action()->create($_POST);
    }
  }
 ob_end_flush();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <?=((isset($_GET['update'])) ? "Update" : "Add");?> tourist spot record
        </h1>
    </div>
    <div>
        <?php
                //Check if $errors is set and if its an array, then if is true, echo the error message.
                if(isset($errors) && is_array($errors) && !empty($errors)){
                    err_message($errors);
                }
            ?>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-9 shadow p-4 rounded mb-2">
            <form class="g-3" action="addtourspot.php<?=((isset($_GET['update'])) ? "?update=". $_GET['update']: "");?>"
                method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <label for="validationDefault01" class="form-label">Title</label>
                        <input name="name" value="<?=$touristspot_name;?>" type="text" class="form-control"
                            id="validationDefault01" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="validationDefault02" class="form-label">Description</label>
                        <input name="description" value="<?=$description;?>" type="text" class="form-control"
                            id="validationDefault02" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="validationDefault02" class="form-label">Guides:</label>
                        <input name="guides" value="<?=$guides;?>" type="text" class="form-control"
                            id="validationDefault02" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="validationDefault01" class="form-label">Purok:</label>
                        <input name="purok" value="<?=$purok;?>" type="text" class="form-control"
                            id="validationDefault01" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="validationDefault02" class="form-label">Barangay:</label>
                        <input name="barangay" value="<?=$barangay;?>" type="text" class="form-control"
                            id="validationDefault02" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="validationDefault02" class="form-label">Municipality/City:</label>
                        <input name="city_mun" value="<?=$city_mun;?>" type="text" class="form-control"
                            id="validationDefault02" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="validationDefault01" class="form-label">Destination image1:</label>
                        <input name="image1" value="" type="file" class="form-control" id="validationDefault01" />
                    </div>
                    <div class="col-md-3">
                        <label for="validationDefault01" class="form-label">Destination image2:</label>
                        <input name="image2" value="" type="file" class="form-control" id="validationDefault01" />
                    </div>
                    <div class="col-md-3">
                        <label for="validationDefault01" class="form-label">Destination image3:</label>
                        <input name="image3" value="" type="file" class="form-control" id="validationDefault01" />
                    </div>
                    <div class="col-md-3">
                        <label for="validationDefault01" class="form-label">Destination image4:</label>
                        <input name="image4" value="" type="file" class="form-control" id="validationDefault01" />
                    </div>
                </div>
                <?php if(isset($_GET['update'])): ?>
                <div class="row">
                    <div class="col-md-3 p-2">
                        <img style="width:100%;" src="../img/tourist-spot/<?=$get_data[0]->image1;?>" alt="">
                    </div>
                    <div class="col-md-3 p-2">
                        <img style="width:100%;" src="../img/tourist-spot/<?=$get_data[0]->image2;?>" alt="">

                    </div>
                    <div class="col-md-3 p-2">
                        <img style="width:100%;" src="../img/tourist-spot/<?=$get_data[0]->image3;?>" alt="">

                    </div>
                    <div class="col-md-3 p-2">
                        <img style="width:100%;" src="../img/tourist-spot/<?=$get_data[0]->image4;?>" alt="">
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-4">
                        <label for="validationDefault01" class="form-label">Youtube link:</label>
                        <input name="yt_link" value="<?=$yt_link;?>" type="text" class="form-control"
                            id="validationDefault01" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="validationDefault04" class="form-label">Category</label>
                        <select name="category" class="form-control form-select" id="validationDefault04">
                            <option <?=((empty($category_id)) ? 'selected' : '');?> value="">Choose...</option>
                            <?php foreach($cat = Category::action()->select()->all() as $c): ?>
                            <option <?=(($category_id == $c->id)? 'selected' : '');?> value="<?=$c->id;?>">
                                <?=$c->name;?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Add Destination</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!- - End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    </body>

    </html>