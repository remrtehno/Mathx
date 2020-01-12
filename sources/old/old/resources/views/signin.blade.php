
@extends('main')

    @section('content')

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center">Регистрация</h1>
                        <?php if(!session()->get('login')) {?>
                        <form method="post" action="{{ route('sign.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Номер телефона (обязательно)</label>
                                    <input required type="text" name="phone_number" class="form-control" id="phone_number" aria-describedby="phone_number">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputPassword1">Пароль (обязательно)</label>
                                    <input required type="password" name="password" class="form-control" id="Password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Имя</label>
                                    <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" aria-describedby="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Фамилия</label>
                                    <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" aria-describedby="last_name" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Статус</label>
                                <input type="text" name="status" class="form-control" id="exampleInputEmail1" aria-describedby="status">
                            </div>

                            <input type="hidden" name="date_reg">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Дата рождения</label>
                                    <input type="text" name="date_birth" class="form-control" id="date-picker-2" aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Дата окончания учебного заведения</label>
                                    <input type="text" name="date_pass" class="form-control date-picker" id="date-picker" aria-describedby="date_pass" >
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                        </form>
                        <?php } else {
                            echo "<h5 class='text-center'> Вы уже загологинены. </h5>";
                        }; ?>
                    </div>
                </div>
            </div>

    @endsection
