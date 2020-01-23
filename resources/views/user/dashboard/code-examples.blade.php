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
                            <p>
                                Регистры букв - отличаются, т.е. например s=vt - правильно, а s=Vt - неправильно<br>
                                При введении кода никаких лишних символов не ставить!<br>
                                В тексте $\text{inf}$ - сокращенно от английского слова &laquo;infinity&raquo; - бесконечность.<br>
                            </p>
                            <div class="table-responsive">
                                <table border="1" cellpadding="5">
                                    <thead>
                                    <tr>
                                        <th>Вид:</th>
                                        <th>Код:</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> $\cfrac{1}{2}$ </td> <td> frac$\{$1$\}$$\{$2$\}$ или 1/2 </td>
                                    </tr>
                                    <tr>
                                        <td> $1\cfrac{2}{3}$ </td> <td> 1frac$\{$2$\}$$\{$3$\}$ </td>
                                    </tr>
                                    <tr>
                                        <td> $\cfrac{a}{bc}$ </td> <td> frac$\{$a$\}$$\{$bc$\}$ или a/bc </td>
                                    </tr>
                                    <tr>
                                        <td> $\cfrac{a+b}{b}$ </td> <td> frac$\{$a+b$\}$$\{$c$\}$ <br> (неправильно: $a+b/c$) </td>
                                    </tr>
                                    <tr>
                                        <td> $\cfrac{a}{b+c}$ </td> <td> frac$\{$a$\}$$\{$b+c$\}$ </td>
                                    </tr>
                                    <tr>
                                        <td> $2\cfrac{1}{3}$ </td> <td> 2frac$\{$1$\}$$\{$3$\}$ </td>
                                    </tr>
                                    <tr>
                                        <td> $\sqrt{a}$ </td> <td> sqrt$\{$a$\}$ </td>
                                    </tr>
                                    <tr>
                                        <td> $\sqrt[3]{a}$ </td> <td> sqrt$\{$3$\}$$\{$a$\}$ </td>
                                    </tr>
                                    <tr>
                                        <td> $\sqrt[3]{a^2}$ </td> <td> sqrt$\{$3$\}$$\{$a$\verb'^'$2$\}$ </td>
                                    </tr>
                                    <tr>
                                        <td> $a^{2/3}$ или $a^{\frac{2}{3}}$ </td> <td> a$\verb'^'$$\{$2/$3\}$ </td>
                                    </tr>
                                    <tr>
                                        <td> $a^2b^3$ </td> <td> a$\verb'^'$2$b\verb'^'$3 </td>
                                    </tr>
                                    <tr>
                                        <td> $2^2\cdot5^3$ </td> <td> 2$\verb'^'$2*5$\verb'^'$3 </td>
                                    </tr>
                                    <tr>
                                        <td> $x=2$ или $x_1=2$ <br> (если у уравнения только один корень) </td> <td> x=2 или 2 </td>
                                    </tr>
                                    <tr>
                                        <td> $x_1=1$, $x_2=3$ <br> (если у уравнения только два корня) </td> <td> x1=1, x2=3 или x1=3, x2=1 </td>
                                    </tr>
                                    <tr>
                                        <td> $x_1=1$, $x_2=3$, $x_3=-2$ <br> (если у уравнения три корня) </td> <td> 1,3,-2 или 1,-2,3 или 3,1,-2 или <br> 3,-2,1 или -2,1,3 или -2,3,1 </td>
                                    </tr>
                                    <tr>
                                        <td> </td> <td> </td>
                                    </tr>
                                    <tr>
                                        <td> $x<2$ или $x\in(-\infty,2)$ </td> <td> x<2 или (-inf,2) </td>
                                    </tr>
                                    <tr>
                                        <td> $x\leqslant2$ или $x\in(-\infty,2]$ </td> <td> x<=2 или (-inf,2] </td>
                                    </tr>
                                    <tr>
                                        <td> $x>3$ или $x\in(3,\infty)$ </td> <td> x>3 или (3,inf) </td>
                                    </tr>
                                    <tr>
                                        <td> $x\geqslant3$ или $x\in[3,\infty)$ </td> <td> x>=3 или [3,inf) </td>
                                    </tr>
                                    <tr>
                                        <td> $(1,2)\cup(3,4)$ или $x\in(1,2)\cup(3,4)$ </td> <td> (1,2)u(3,4) </td>
                                    </tr>
                                    <tr>
                                        <td> $(-\infty,1)\cup(2,\infty)$ или $x\in(-\infty,1)\cup(2,\infty)$ </td> <td> (-inf,1)u(2,inf) </td>
                                    </tr>
                                    <tr>
                                        <td> $\Big(\cfrac{1}{2},3\Big]$ или $x\in\Big(\cfrac{1}{2},3\Big]$ </td> <td> $\big($frac$\{$1$\}$$\{$2$\}$,3$\big]$ </td>
                                    </tr>
                                    <tr>
                                        <td> </td> <td> </td>
                                    </tr>
                                    <tr>
                                        <td> $\log_2 3$ </td> <td> log$\{$2$\}$$\{$3$\}$ </td>
                                    </tr>
                                    <tr>
                                        <td> $\sin\alpha$ </td> <td> sin$\setminus$alpha </td>
                                    </tr>
                                    <tr>
                                        <td> $\cos\alpha$ </td> <td> cos$\setminus$alpha </td>
                                    </tr>
                                    <tr>
                                        <td> $\text{tg}\,\alpha$ </td> <td> tg$\setminus$alpha </td>
                                    </tr>
                                    <tr>
                                        <td> $\sin\beta$ </td> <td> sin$\setminus$beta </td>
                                    </tr>
                                    <tr>
                                        <td> $\sin^2\alpha$ </td> <td> sin$\verb'^'$2$\setminus$alpha </td>
                                    </tr>
                                    <tr>
                                        <td> $\sin2\alpha$ </td> <td> sin2$\setminus$alpha </td>
                                    </tr>
                                    <tr>
                                        <td> $\cos^32\alpha$ </td> <td> cos$\verb'^'$32$\setminus$alpha </td>
                                    </tr>
                                    <tr>
                                        <td> $\cfrac{1}{\sin^2\alpha}$ </td> <td> frac$\{$1$\}$$\{$sin$\verb'^'$2$\setminus$alpha$\}$ </td>
                                    </tr>
                                    <tr>
                                        <td> </td> <td> </td>
                                    </tr>
                                    <tr>
                                        <td> $\mu$ </td> <td> $\backslash\!\!$ mu </td>
                                    </tr>
                                    <tr>
                                        <td> $\nu$ </td> <td> $\backslash\!\!$ nu </td>
                                    </tr>
                                    <tr>
                                        <td> $\lambda$ </td> <td> $\backslash\!\!$ lambda </td>
                                    </tr>
                                    <tr>
                                        <td> $\Delta p$ </td> <td> $\backslash\!\!$ delta p </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
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