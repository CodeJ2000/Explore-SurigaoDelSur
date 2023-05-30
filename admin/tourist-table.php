<?php 
  require_once "../config/init.php";
  include "admin-partials/side-nav.php";
  include "admin-partials/topbar.php";
    if(isset($_GET['delete'])){
        $delete_id = sanitize_input($_GET['delete']);
        $sd['soft_delete'] = 1;
        Destination::action()->soft_delete($sd,$delete_id);
        $_SESSION['success_message'] = "Successfuly deleted";
    }
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tourist spot table</h1>
    <!-- Show success message if the destination is added -->
    <?php if(isset($_SESSION['success_message'])){
        success_message();
    }
     ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
        </div>
        <?php if(empty($destination = Destination::action()->get_all("destination"))): ?>
        <div class="text-center border rounded p-5">
            <h3 class="text-muted">Nothing to display!</h3>
        </div>
        <?php else: ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Address</th>
                            <th>Youtube Video</th>
                            <th>Date Posted</th>
                            <th>Updated Post date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Address</th>
                            <th>Youtube Video</th>
                            <th>Date Posted</th>
                            <th>Updated Post date</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($destination = Destination::action()->get_by_deleteId_destination(0) as $d): 
                                    $address = $d->purok . " " . $d->barangay . " " . $d->city_mun;
                                    $category = Category::action()->get_by_id_category($d->cat_id);
                                ?>
                        <tr>
                            <td><?=$d->name;?></td>
                            <td><?=$category[0]->name;?></td>
                            <td><?=$address;?></td>
                            <td class="text-center"><a class="text-center text-danger"
                                    href="https://www.youtube.com/watch?v=<?=isYoutubeVideoLink($d->youtube_url);?>"
                                    target="_blank"><i class="fab fa-brands fa-youtube fa-2x"></i></a></td>
                            <td><?=format_date($d->date_posted);?></td>
                            <td><?=format_date($d->date_update);?></td>
                            <td class="d-flex "><a class="btn btn-sm btn-dark"
                                    href="addtourspot.php?update=<?=$d->id;?>">UPDATE</a><span
                                    style="margin: 0 10px;"></span><a class="btn btn-sm btn-danger"
                                    href="tourist-table.php?delete=<?=$d->id?>">DELETE</a>
                            </td>
                        </tr>
                        <?php endforeach; 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

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

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
</body>

</html>