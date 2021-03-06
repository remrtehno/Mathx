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
                        <h1 class="h3 mb-0 text-gray-800">Тестирование</h1>
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

                        @if(session()->get('last_result') && json_decode($results))
                            {{ session()->forget('last_result') }}
                            <div class="col-lg-12 mb-3">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div class="tests-cotainer">
                                        @foreach (json_decode($results) as $val)
                                            <div class="task">
                                                <div class="heading mb-3">
                                                    <?= htmlspecialchars_decode($val->id); ?>.  <?= htmlspecialchars_decode($val->uslovie); ?>
                                                </div> <!-- /.heading mb-3 -->
                                                <input type="text" value="<?= $val->kod_otvet; ?>" disabled="disabled">
                                            </div> <!-- task -->
                                        @endforeach
                                    </div><!-- /.tests-cotainer -->
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> <!-- alert -->
                            </div> <!-- col-lg-12 -->
                        @endif

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">
							<h5> Ваш уровень: <?php echo $level_test;?> </h5>
                        </div>
                        <div class="col-lg-3 mb-4">

	                        <?php if($allow_tests) { ?>
                                <a href="{{ route('load-tests', ['level_test' => $level_test, ]) }}" class="card bg-success text-white shadow">
                                    <div class="card-body">
                                        Начать тест
                                    </div>
                                </a>
	                        <?php } ?>

                            @if($continue_tests)
                                <a href="{{ route('load-tests') }}" class="card bg-success text-white shadow">
                                    <div class="card-body">
                                        Продолжить тест
                                    </div>
                                </a>
                            @endif

                            @if(!$allow_tests && !$continue_tests)
                                <a href="JavaScript:void(0);" class="card btn-disabled text-white shadow">
                                    <div class="card-body">
                                        Начать тест
                                    </div>
                                </a>
                            @endif
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