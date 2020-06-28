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




<!-- Alert Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content position-relative">
            <div class="modal-header position-absolute w-100">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML"></script>
<script src="/js/manifest.js?ver=1.1"></script>
<script src="/js/vendor.js?ver=1.1"></script>
<script src="/js/app.js?ver=1.1"></script>
<script type="text/javascript">
    (function() {
        setTimeout(function(){
            $('.take-tests').removeAttr('disabled').removeClass('btn-dark');
        }, 15000);
    })();
</script>

</body>
</html>