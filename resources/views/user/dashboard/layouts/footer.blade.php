<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Вы точно хотите выйти?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Нажмите на "Выйти" внизу если хотите выйти из системы.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}">Выйти</a>
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap core JavaScript-->
<script src="{{ asset('resources/views/user/dashboard/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('resources/views/user/dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('resources/views/user/dashboard/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('resources/views/user/dashboard/assets/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('resources/views/user/dashboard/assets/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<!--
<script src="{{ asset('resources/views/user/dashboard/assets/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('resources/views/user/dashboard/assets/js/demo/chart-pie-demo.js') }}"></script>
-->

<script src="{{ asset('resources/views/user/dashboard/assets/js/script.js') }}"></script>
<style type="text/css" media="screen">

	a.card:hover {
		opacity: .85;
		text-decoration: none;
	}
</style>

</body>

</html>