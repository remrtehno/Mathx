
@extends('main')

@section('content')

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Войти</h1>
                    @if (session()->get('error'))
                       <div class="alert-danger p-3 mb-4"> {{ session()->get('error') }} </div>
                    @endif
                    @if (!session()->get('login'))
                        <form method="post" action="{{ route('signup') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Номер телефона (обязательно)</label>
                                    <input required name="phone_number" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="phone_number">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputPassword1">Пароль (обязательно)</label>
                                    <input required name="password" type="password" class="form-control" id="password">
                                </div>
                            </div>
                            <!-- /.row -->
                            <button type="submit" class="btn btn-primary">Войти</button>
                        </form>
                    @else
                         Вы уже загологинены.
                    @endif
                </div>
            </div>
        </div>

@endsection


