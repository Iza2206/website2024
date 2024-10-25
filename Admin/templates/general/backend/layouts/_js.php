<!-- Bootstrap core JavaScript -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

<!-- Sidebar menu JS -->
<script src="../assets/js/sidebar-menu.js"></script>

<!-- Custom scripts -->
<script src="../assets/js/app-script.js"></script>

<!-- Simplebar JS -->
<script src="../assets/plugins/simplebar/js/simplebar.js"></script>

<!-- Chart.js -->
<script src="../assets/plugins/Chart.js/Chart.min.js"></script>

<!-- Index JS -->
<script src="../assets/js/index.js"></script>

<!-- Toastr JS for notifications -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- jQuery from CDN (you can comment this out if you're using the local version above) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap JS from CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- JS Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<!-- JS Summernote -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#example').DataTable();

        // Initialize Summernote
        $('#summernote').summernote({
            height: 200, // Set height
            focus: true
        });

        $('#summernote1').summernote({
            height: 200, // Set height
            focus: true
        });
    });
</script>
