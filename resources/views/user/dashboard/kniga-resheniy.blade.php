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
                        <h1 class="h3 mb-0 text-gray-800"> Книга решений </h1>
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

                            @foreach ($content as $val)
                                <div id="section-1.{{ $val['id'] }}">
                                    <div class="heading">
                                        {{ $val['name'] }}
                                    </div><!-- /.heading -->
                                    <div class="body">
                                        {{ $val['content'] }}
                                    </div><!-- /.body -->
                                </div> <!-- /#section-1.1 -->
                            @endforeach
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