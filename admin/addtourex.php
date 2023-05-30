<?php
  require_once "../config/init.php";
  include "admin-partials/side-nav.php";
  include "admin-partials/topbar.php";
  $arr['name'] = "jason";
    DB::table("destination")->update($arr)->where("id = :id", ["id" => 1]);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Add tourist experience record
        </h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-7 shadow p-4 rounded mb-2">
            <form class="row g-3">
                <div class="col-md-4">
                    <label for="validationDefault01" class="form-label">Tourist spot name</label>
                    <input type="text" class="form-control" id="validationDefault01" required />
                </div>
                <div class="form-group col-md-4">
                    <label for="validationDefault02" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="validationDefault02" required />
                </div>
                <div class="form-group col-md-3">
                    <label for="validationDefault04" class="form-label">Category</label>
                    <select class="form-control form-select" id="validationDefault04" required>
                        <option selected disabled value="">Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Add</button>
                </div>
            </form>
        </div>
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
</body>

</html>