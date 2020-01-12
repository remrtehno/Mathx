<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 d-flex justify-content-lg-start justify-content-center align-items-center">
                <div class="logo">
                    <a href="/">MATHX</a>
                </div>
                <!-- /.logo -->
            </div>
            <div class="col-md-3">
                <?php //print_r() ?>
                @if (session()->get('login'))
                    <a href="{{ route('logout') }}"> Выйти </a>
                @else
                    <a href="{{ route('signup') }}"> Войти </a>
                @endif
            </div>
            <!-- /.col-md-3 -->
        </div>
    </div>
    <!-- /.container -->
</header>