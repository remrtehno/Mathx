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
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-12 mb-3">
                            <h5> Ваш уровень:
			                        <?php
			                        if(isset($users->level)) {
				                        echo $users->level;
			                        } else {
				                        echo 'A1.1a';
			                        }
			                        ?>
                            </h5>
                        </div>
                        <!-- /.col-12 -->
                        <div class="col-lg-12 mb-5">
                                <input type="hidden" value="{{ $id_test }}" name="name_db">
                                <input type="hidden" value="{{ route('save-meta') }}" name="save_meta_route">

                                <div class="tests-container">
                                    @foreach ($data as $val)
                                        <div class="task">
                                            <div class="heading mb-3">
                                                <span class="counter"> {{$val['id']}}. </span>
												<?= $val['uslovie'] ?>
                                            </div> <!-- /.heading -->

	                                        <? if(isset($val['shag_1'])) { ?>
                                            <div class='hints-1' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 1.</font> <?= $val['shag_1'] ? $val['shag_1'] : '';?>	    </div>
	                                        <? }; ?>

	                                        <? if(isset($val['shag_2'])) { ?>
                                            <div class='hints-2' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 2.</font> <?= $val['shag_2'] ? $val['shag_2'] : '' ;?>	    </div>
	                                        <? }; ?>
	                                        <? if(isset($val['shag_3'])) { ?>
                                            <div class='hints-3' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 3.</font> <? $val['shag_3'];?>	    </div>
	                                        <? }; ?>
	                                        <? if(isset($val['shag_4'])) { ?>
                                            <div class='hints-4' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 4.</font> <? $val['shag_4'];?>	    </div>
	                                        <? }; ?>
	                                        <? if(isset($val['shag_5'])) { ?>
                                            <div class='hints-5' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 5.</font> <? $val['shag_5'];?>	    </div>
	                                        <? }; ?>

	                                        <? if(isset($val['shag_6'])) { ?>
                                            <div class='hints-6' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 7.</font> <? $val['shag_6'];?>	    </div>
	                                        <? }; ?>
	                                        <? if(isset($val['shag_7'])) { ?>
                                            <div class='hints-7' style="display:none;">
                                                <br>
                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 8.</font> <? $val['shag_7'];?>	    </div>
	                                        <? }; ?>
	                                        <? if(isset($val['shag_8'])) { ?>
                                            <div class='hints-8' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 1.</font> <? $val['shag_8'];?>	    </div>
	                                        <? }; ?>

                                            @if(!$fiz)
                                                <div class="task-body">
                                                    <a href="#" class="d-block steps" data-id="<?= $val['id'];?>">
                                                        Показать следующий шаг
                                                        <span class="timer"></span>
                                                    </a>
                                                    <b>Код-ответ:</b>
                                                    <div class="d-flex">
                                                        {{--onkeyup="this.value = this.value.toUpperCase();"--}}
                                                        <input type="text" name="task-{{  $val['id'] }}" class="otvet-kod">
                                                        <a href="#" class="btn btn-primary rounded-0 check-answer" data-id="{{  $val['id'] }}" data-answer={{$val['otvet_kod']}}>Проверить</a>
                                                    </div>
                                                </div> <!-- /.task-body -->
                                            @endif


                                        </div> <!-- task -->
                                    @endforeach
                                </div> <!-- /.tests-container -->
                        </div> <!-- /.col-lg-12 -->
                    </div>
                </div><!-- /.container-fluid -->
            </div><!-- End of Main Content -->
        </div> <!-- End of Content Wrapper -->
    </div><!-- End of Page Wrapper -->
@endsection
