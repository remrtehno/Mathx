@extends('user/dashboard/main')

@section('content')

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('user/dashboard/layouts/sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('user/dashboard/layouts/topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Список (примеры) кодов, используемых при вводе ответов-кодов. </h1>
                    </div>


                    <!-- Content Row -->
                    <div class="row">

                        @if (session()->get('alert'))
                            <div class="col-lg-12 mb-3">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {{ session()->get('alert') }}
                                    {{ session()->forget('alert') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> <!-- alert -->
                            </div> <!-- col-lg-12 -->
                        @endif

                        @if (session()->get('success'))
                            <div class="col-lg-12 mb-3">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('success') }}
                                    {{ session()->forget('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> <!-- alert -->
                            </div> <!-- col-lg-12 -->
                        @endif

                        @if (session()->get('danger'))
                            <div class="col-lg-12 mb-3">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session()->get('danger') }}
                                    {{ session()->forget('danger') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> <!-- alert -->
                            </div> <!-- col-lg-12 -->
                        @endif

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <table border="1" cellpadding="10">
                                <thead>
                                    <tr>
                                        <th>Вид</th>
                                        <th>Код</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>$\cfrac{1}{2}$ </td>
                                        <td> frac$\{$1$\}$$\{$2$\}$ или 1/2 </td>
                                    </tr>
                                </tbody>
                            </table>


                            Регистры букв - отличаются, т.е. например s=vt - правильно, а s=Vt - неправильно<br>
                            При введении кода никаких лишних символов не ставить!<br>

                            Правила написания дроби:<br>
                            Вид: $\cfrac{1}{2}$ Код: frac$\{$1$\}$$\{$2$\}$ или 1/2<br>
                            Вид: $\cfrac{a}{bc}$ Код: frac$\{$a$\}$$\{$bc$\}$ или a/bc<br>
                            Вид: $\cfrac{a+b}{b}$ Код: frac$\{$a+b$\}$$\{$c$\}$ (неправильно: $a+b/c$!)<br>
                            Вид: $\cfrac{a}{b+c}$ Код: frac$\{$a$\}$$\{$b+c$\}$<br>
                            Вид: $2\cfrac{1}{3}$ Код: 2frac$\{$1$\}$$\{$3$\}$<br>
                            Вид $\sqrt{a}$ Код: sqrt$\{$a$\}$<br>
                            Вид $\sqrt[3]{a}$ Код: sqrt$\{$3$\}$$\{$a$\}$<br>
                            Вид $\sqrt[3]{a^2}$ Код: sqrt$\{$3$\}$$\{$a\verb'^'2$\}$<br>
                            Вид: $a^{2/3}$ Код: a\verb'^'$\{$2/$3\}$<br>
                            Вид: $a^2b^3$ Код: a\verb'^'$2$b\verb'^'$3$<br>
                            Вид: $2^2\cdot5^3$ Код: 2\verb'^'$2$$*$5\verb'^'$3$<br>
                            Вид: $x=2$ или $x_1=2$ (если у уравнения только один корень) Код: x=2 или 2<br>
                            Вид: $x_1=1$, $x_2=3$ (если у уравнения только два корня) Код: x1=1, x2=3 или x1=3, x2=1<br>
                            Вид: $x_1=1$, $x_2=3$, $x_3=-2$ (если у уравнения три корня) Код: 1,3,-2 или 1,-2,3 или 3,1,-2 или 3,-2,1 или -2,1,3 или -2,3,1<br>

                            <br> <br>

                            Вид: $x<2$ или $x\in(-\infty,2)$ Код: x<2 или (-inf,2)<br>
                            Вид: $x\leqslant2$ или $x\in(-\infty,2]$ Код: x<=2 или (-inf,2]<br>
                            Вид: $x>3$ или $x\in(3,\infty)$ Код: x>3 или (3,inf)<br>
                            Вид: $x\geqslant3$ или $x\in[3,\infty)$ Код: x>=3 или [3,inf)<br>
                            Вид: $(1,2)\cup(3,4)$ или $x\in(1,2)\cup(3,4)$ Код: (1,2)u(3,4)<br>
                            Вид: $(-\infty,1)\cup(2,\infty)$ или $x\in(-\infty,1)\cup(2,\infty)$ Код: (-inf,1)u(2,inf)<br>
                            Вид: $\Big(\cfrac{1}{2},3\Big]$ или $x\in\Big(\cfrac{1}{2},3\Big]$ Код: $\big($frac$\{$1$\}$$\{$2$\}$,3$\big]$<br>
                            Здесь $\text{inf}$ - сокращенно от английского слова <<infinity>> - бесконечность.<br>

                                <br> <br>

                                Вид: $\log_2 3$ Код: log$\{$2$\}$$\{$3$\}$<br>
                                Вид: $\sin\alpha$ Код: sin$\setminus$alpha<br>
                                Вид: $\cos\alpha$ Код: cos$\setminus$alpha<br>
                                Вид: $\text{tg}\,\alpha$ Код: tg$\setminus$alpha<br>
                                Вид: $\sin\beta$ Код: sin$\setminus$beta<br>
                                Вид: $\sin^2\alpha$ Код: sin\verb'^'$2$$\setminus$alpha<br>
                                Вид: $\sin2\alpha$ Код: sin2$\setminus$alpha<br>
                                Вид: $\cos^32\alpha$ Код: cos\verb'^'$3$2$\setminus$alpha<br>
                                Вид: $\cfrac{1}{\sin^2\alpha}$ Код: frac$\{$1$\}$$\{$sin\verb'^'$2$$\setminus$alpha$\}$<br>

                                <br> <br>

                                Другие символы:<br>
                                Вид: $\mu$  Код $\backslash\!\!$ mu<br>
                                Вид: $\nu$  Код: $\backslash\!\!$ nu<br>
                                Вид: $\lambda$  Код: $\backslash\!\!$ lambda<br>
                                Вид: $\Delta p$ Код: $\backslash\!\!$ delta p<br>
                        </div>

                    </div>

                </div><!-- /.container-fluid -->

            </div><!-- End of Main Content -->

        </div> <!-- End of Content Wrapper -->

    </div><!-- End of Page Wrapper -->







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



@endsection