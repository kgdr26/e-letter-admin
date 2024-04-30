<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @php
            $role_data_side = [
                '1',
                '7',
                '9',
                '10',
                '11',
                '12',
                '13',
                '14',
                '15',
                '16',
                '17',
                '18',
                '19',
                '20',
                '21',
                '22',
                '23',
                '25',
            ];
        @endphp
        @if (in_array($idn_user->role_id, $role_data_side))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('inputsurat') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Adm. Letter</span>
                </a>
            </li>
        @endif

        @php
            $role_data_side = [
                '1',
                '7',
                '9',
                '10',
                '11',
                '12',
                '13',
                '14',
                '15',
                '16',
                '17',
                '18',
                '19',
                '20',
                '21',
                '22',
                '23',
                '25',
            ];
        @endphp
        @if (in_array($idn_user->role_id, $role_data_side))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('document') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Document</span>
                </a>
            </li>
        @endif

        @php
            $role_data_side = ['1'];
        @endphp
        @if (in_array($idn_user->role_id, $role_data_side))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('users') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Manage Users</span>
                </a>
            </li>
        @endif

        @php
            $role_data_side = [
                '1',
                '7',
                '9',
                '10',
                '11',
                '12',
                '13',
                '14',
                '15',
                '16',
                '17',
                '18',
                '19',
                '20',
                '21',
                '22',
                '23',
                '25',
            ];
        @endphp
        @if (in_array($idn_user->role_id, $role_data_side))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('assetsdash') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Asset Lending</span>
                </a>
            </li>
        @endif

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('scurity') }}">
                <i class="bi bi-person-circle"></i>
                <span>Security</span>
            </a>
        </li> --}}

        @php
            $role_data_side = ['1', '8', '16', '22'];
        @endphp
        @if (in_array($idn_user->role_id, $role_data_side))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('assetscheck') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>General Affair</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>

</aside>
