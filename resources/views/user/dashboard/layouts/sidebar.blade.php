<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar" >

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            {{ session('select') == true ? 'FX' : 'MX' }}
        </div>
        <div class="sidebar-brand-text mx-3"> Личный кабинет </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 mb-3">

    <!-- Heading -->
    <div class="sidebar-heading">
        Основное
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Главная</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('kniga-resheniy') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Книга решений</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('kniga-resheniy', ['table' => 'teoriya_mat', 'subchapter' => 'true',]) }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Теория</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('code-examples') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Примеры кодов</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('user-statistics') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Статистика</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Другое
    </div>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-cog"></i>
            <span>Настройки</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Оплата</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->