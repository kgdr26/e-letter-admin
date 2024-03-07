<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @if ($idn_user->role_id == 8)
        @else
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('inputsurat') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Input Surat</span>
                </a>
            </li>
        @endif


        @if ($idn_user->id == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('users') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Users</span>
                </a>
            </li>
        @endif

        @if ($idn_user->role_id == 8)
        @else
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('assetsdash') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Asset Lending</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('scurity') }}">
                <i class="bi bi-person-circle"></i>
                <span>Security</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('assetscheck') }}">
                <i class="bi bi-person-circle"></i>
                <span>Asset Checksheet</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>

</aside>
