<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('inputsurat')}}">
                <i class="bi bi-person-circle"></i>
                <span>Input Surat</span>
            </a>
        </li>

        @if($idn_user->id == 5)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('users')}}">
                    <i class="bi bi-person-circle"></i>
                    <span>Users</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </li>



    </ul>

</aside>
