@extends('user/dashboard/main')

@section('content')

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('user/dashboard/layouts/sidebar')

        {{--{{ dd(get_defined_vars()) }}--}}
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('user/dashboard/layouts/topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-12 mb-5 text-center">
                            <div id="time" data-time="{{ $time_left }}"></div> <!-- /#time -->
                        </div>
                        <!-- /.col-12 -->

                        <div class="col-lg-12 mb-5">
                            <form method="POST" action="{{ route('end-test') }}">
                                @csrf
                                <input type="hidden" value="{{ $id_test }}" name="name_db">
                                <?php $counter = 1; ?>
                                    <script id="jsonData">
                                        window.jsonTests = <?= $jsonData; ?>
                                    </script>

                                <div class="tests-container">
                                    @foreach ($data as $val)
                                        <div class="task">
                                            <div class="heading mb-3">
                                                <span class="counter"> {{$counter++}}. </span>
                                                <?= $val['uslovie'] ?>
                                            </div> <!-- /.heading -->

                                            <div class="task-body">
                                                <div class="d-flex">
                                                    {{--onkeyup="this.value = this.value.toUpperCase();"--}}
                                                    <input type="text" name="task-{{  $val['id'] }}" >
                                                </div>
                                            </div> <!-- /.task-body -->
                                        </div> <!-- task -->
                                    @endforeach
                                </div> <!-- /.tests-container -->

                                <button type="submit" class="btn-success btn">Сдать тесты</button>
                            </form>
                        </div> <!-- /.col-lg-12 -->

                    </div>

                </div><!-- /.container-fluid -->

            </div><!-- End of Main Content -->

        </div> <!-- End of Content Wrapper -->

    </div><!-- End of Page Wrapper -->

@endsection
