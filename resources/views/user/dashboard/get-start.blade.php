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
                            <h1 class="h3 mb-2 text-gray-800">{{$title}}</h1>
                            <h5> Ваш уровень:
			                        <?php
			                        if(isset($users->level)) {
				                        echo $users->level;
			                        } else {
				                        echo 'A1.1a';
			                        }
			                        ?>
                            </h5>

                            <h6>
                                Оставшееся число задач в блоке: <span id="taskLeft"></span>
                            </h6>
                            <h6>
                                Прохождение главы:
                                <span id="totalPercent" data-json="{{$totalJson}}">{{$total}}</span>%
                            </h6>
                        </div>
                        <!-- /.col-12 -->
                        <div class="col-lg-12 mb-5">
                                <input type="hidden" value="{{ $id_test }}" name="name_db">
                                <input type="hidden" value="{{ route('save-meta') }}" name="save_meta_route">
                                <input type="hidden" name="date" value={{date('Y-m-d', strtotime("+5 hours") )}}>
                                <input id="tasks" type="hidden">
                                <div class="tests-container">
                                    @foreach ($data as $val)
                                        <div class="task">
                                            <div class="heading mb-3">
                                                <span class="counter"> {{$val['id']}}. </span>
												{!! $val['uslovie']  !!} {{$val['primer']}}
                                                <div class="mb-2"></div>
                                                {!! isset($val['primechanie']) ? $val['primechanie'] : null !!}
                                            </div> <!-- /.heading -->

	                                        @if($val['shag_1'])
                                            <div class='hints-1' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 1.</font> <?= $val['shag_1'] ? $val['shag_1'] : '';?>	    </div>
	                                        @endif

                                            @if($val['shag_2'])
                                            <div class='hints-2' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 2.</font> <?= $val['shag_2'] ? $val['shag_2'] : '' ;?>	    </div>
                                            @endif
	                                        @if($val['shag_3'])
                                            <div class='hints-3' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 3.</font> <? $val['shag_3'];?>	    </div>
                                            @endif
	                                        @if($val['shag_4'])
                                            <div class='hints-4' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 4.</font> <? $val['shag_4'];?>	    </div>
                                            @endif
	                                        @if($val['shag_5'])
                                            <div class='hints-5' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 5.</font> <? $val['shag_5'];?>	    </div>
                                            @endif

	                                        @if($val['shag_6'])
                                            <div class='hints-6' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 7.</font> <? $val['shag_6'];?>	    </div>
                                            @endif
	                                        @if($val['shag_7'])
                                            <div class='hints-7' style="display:none;">
                                                <br>
                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 8.</font> <? $val['shag_7'];?>	    </div>
                                            @endif
	                                        @if($val['shag_8'])
                                            <div class='hints-8' style="display:none;">

                                                <font size="3" color="darkgreen" face="sans-serif" style="font-weight:bold">Шаг 1.</font> <? $val['shag_8'];?>	    </div>
                                            @endif

                                            <div class="task-body">
                                                <div class="d-inline-flex">
                                                    {{--onkeyup="this.value = this.value.toUpperCase();"--}}
                                                    <input type="text" placeholder="Код-ответ" name="task-{{  $val['id'] }}" class="otvet-kod" data-id="{{  $val['id'] }}" data-answer="{{$val['otvet_kod']}}">
                                                    <a href="#" class="btn btn-primary rounded-0 check-answer" data-id="{{  $val['id'] }}" data-answer="{!! $val['otvet_kod'] !!}">Проверить</a>
                                                </div>
                                                @if($val['shag_1'])
                                                <button class="steps btn btn-success rounded-0" data-id="<?= $val['id'];?>">
                                                    Подсказать
                                                </button>
                                                @endif
                                                <span class="timer badge badge-light"></span>
                                            </div> <!-- /.task-body -->
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
