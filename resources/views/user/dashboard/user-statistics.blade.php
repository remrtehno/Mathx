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
                        <div class="col-12">
                            <h2 class="mb-3">Статистика</h2>
                            <table border="1" cellpadding="10">
                                <tr>
                                    <td>Дата</td>
                                    <td>Число решенных</td>
                                </tr>
                                @foreach ($user_statistics as $key => $statistic)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{ count((array)$statistic['id']) }}</td>
                                    </tr>
                                @endforeach

                            </table>

                        </div><!-- /.col-12 -->
                    </div>
                </div><!-- /.container-fluid -->
            </div><!-- End of Main Content -->
        </div> <!-- End of Content Wrapper -->
    </div><!-- End of Page Wrapper -->
@endsection
