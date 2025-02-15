<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">GENERAL</li>
        @php
            $role_data_side = [
                '1',
                '7',
                '8',
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
                '26',
            ];
        @endphp
        @if (in_array($idn_user->role_id, $role_data_side))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('inputsurat') }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Adm. Letter</span>
                </a>
            </li>
        @endif

        {{-- @php
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
                '26',
            ];
        @endphp
        @if (in_array($idn_user->role_id, $role_data_side))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('document.create') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Document</span>
                </a>
            </li>
        @endif --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('document.create') }}">
                <i class="bi bi-person-circle"></i>
                <span>Document</span>
            </a>
        </li>

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
                '8',
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
                '24',
                '25',
                '26',
            ];
        @endphp
        @if (in_array($idn_user->role_id, $role_data_side))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('assetsdash') }}">
                    <i class="bi bi-layout-text-window-reverse"></i>
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
            $role_data_side = ['1', '8', '16'];
        @endphp
        @if (in_array($idn_user->role_id, $role_data_side))
            <li class="nav-heading">HRGA</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('employeloan') }}">
                    <i class="bi bi-gem"></i>
                    <span>Dashboard CLP | COP</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('viewtableemployeloan') }}">
                    <i class="bi bi-bar-chart"></i>
                    <span>View Loan Program</span>
                </a>
            </li> --}}
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('employeloanperuser') }}">
                <i class="bi bi-gem"></i>
                <span>Loan Per User</span>
            </a>
        </li>

        @php
            $role_data_side = ['1', '8', '16', '21', '22'];
        @endphp
        @if (in_array($idn_user->role_id, $role_data_side))
            <li class="nav-heading">GENERAL AFFAIR</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('assetscheck') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Checksheet Cars</span>
                </a>
            </li>
        @endif

        <li class="nav-heading">E-Ticket Request IT</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('ticket_request') }}">
                <i class="bi bi-person-circle"></i>
                <span>Ticket Request</span>
            </a>
        </li>

        {{-- <li class="nav-heading">Finance</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('cia.form') }}">
                <i class="bi bi-cash-coin"></i>
                <span>Cash In Advance</span>
            </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#delivery-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-cash-coin"></i><span>Cash In Advance</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="delivery-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('inputcia') }}">
                        <i class="bi bi-file-earmark-text-fill fs-6"></i><span>Form CIA</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('listciadephead') }}">
                        <i class="bi bi-reddit fs-6"></i><span>To Approved</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('listciafinance') }}">
                        <i class="bi bi-reddit fs-6"></i><span>Second Approved</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('listciacashier') }}">
                        <i class="bi bi-reddit fs-6"></i><span>Cashier Approved</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('listcia') }}">
                        <i class="bi bi-flower2 fs-6"></i><span>Overview CIA</span>
                    </a>
                </li>
            </ul>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('stok.index') }}">
                <i class="bi bi-cash-coin"></i>
                <span>Stock Inventori Materai</span>
            </a>
        </li>


        {{-- <hr>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>
        </li> --}}
    </ul>

</aside>
