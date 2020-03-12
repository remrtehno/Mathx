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
                                        window.jsonTests = <?= $jsonData; ?>;
                                    </script>

                                <div class="tests-container">
                                    @foreach ($data as $val)
                                        <div class="task">
                                            <div class="heading mb-3">
                                                <span class="counter"> {{$counter++}}. </span>
                                                <?= $val['uslovie'] ?>
                                            </div> <!-- /.heading -->

                                            @if(!$fiz)
                                                <div class="task-body">
                                                    <div class="d-flex">
                                                        {{--onkeyup="this.value = this.value.toUpperCase();"--}}
                                                        <input type="text" name="task-{{  $val['id'] }}" >
                                                    </div>
                                                </div> <!-- /.task-body -->
                                            @endif

                                            @if($fiz)
                                                <div class="task-body col-md-4">
                                                    <input type="hidden" checked value="null" name="task-{{  $val['id'] }}">
                                                    <div class="form-check custom-input">
                                                        <input class="form-check-input" type="radio" name="task-{{  $val['id'] }}" id="task-{{  $val['id'] }}-answer-a" value="A" >
                                                        <label class="form-check-label" for="task-{{  $val['id'] }}-answer-a">
                                                           <b>A:</b> {{  $val['A'] }}
                                                        </label>
                                                    </div>
                                                    <div class="form-check custom-input">
                                                        <input class="form-check-input" type="radio" name="task-{{  $val['id'] }}" id="task-{{  $val['id'] }}-answer-b" value="B" >
                                                        <label class="form-check-label" for="task-{{  $val['id'] }}-answer-b">
                                                           <b>B:</b> {{  $val['B'] }}
                                                        </label>
                                                    </div>
                                                    <div class="form-check custom-input">
                                                        <input class="form-check-input" type="radio" name="task-{{  $val['id'] }}" id="task-{{  $val['id'] }}-answer-c" value="C" >
                                                        <label class="form-check-label" for="task-{{  $val['id'] }}-answer-c">
                                                            <b>C:</b> {{  $val['C'] }}
                                                        </label>
                                                    </div>
                                                    <div class="form-check custom-input">
                                                        <input class="form-check-input" type="radio" name="task-{{  $val['id'] }}" id="task-{{  $val['id'] }}-answer-d" value="D" >
                                                        <label class="form-check-label" for="task-{{  $val['id'] }}-answer-d">
                                                           <b>D:</b> {{  $val['D'] }}
                                                        </label>
                                                    </div>
                                                </div> <!-- /.task-body -->
                                            @endif

                                        </div> <!-- task -->
                                    @endforeach
                                </div> <!-- /.tests-container -->

                                <button type="submit" class="btn-success btn take-tests btn-dark" disabled>Сдать тесты</button>
                            </form>
                        </div> <!-- /.col-lg-12 -->

                    </div>

                </div><!-- /.container-fluid -->

            </div><!-- End of Main Content -->

        </div> <!-- End of Content Wrapper -->

    </div><!-- End of Page Wrapper -->

@endsection
