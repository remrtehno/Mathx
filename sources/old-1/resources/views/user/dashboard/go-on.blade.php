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

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">
							<h5> Ваш уровень: 
								<?php
									if($users->level_test) {
										echo $users->level_test;	
									} else {
										echo 'A1.1';
									} 
                                ?> 
                            </h5>
                        </div>
                        <div class="col-lg-3 mb-3">
	                        @if (session()->get('alert'))
	                          {{ session()->get('alert') }}
	                        @endif                   
                        </div>

                        <div class="col-lg-12 mb-5">
                            <?php $counter = 1; ?>
                                <script id="jsonData">
                                    var jsonTests = <?php print_r($jsonData); ?>
                                </script>
                                <div id="testContainer"></div>
                            @foreach ($data as $val)
                                <div class="task">
                                    <div class="heading mb-3">
                                        <span class="counter"> {{$counter++}}. </span>
	                                    <?= $val['uslovie'] ?>
                                    </div> <!-- /.heading -->

                                    <div class="task-body">
                                        <div class="d-flex">
                                            <input type="text" name="task-{{  $val['id'] }}">
                                        </div>
                                    </div> <!-- /.task-body -->
                                </div> <!-- task -->
                            @endforeach
                            <button class="btn-success btn">Сдать тесты</button>
                        </div> <!-- /.col-lg-12 -->

                    </div>

                </div><!-- /.container-fluid -->

            </div><!-- End of Main Content -->

        </div> <!-- End of Content Wrapper -->

    </div><!-- End of Page Wrapper -->

@endsection
