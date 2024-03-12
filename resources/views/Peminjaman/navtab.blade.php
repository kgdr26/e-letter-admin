<ul class="nav nav-tabs">

    @php
        $role_data    = ['1','2','3','4','5','6','7','8','9','10','11'];
    @endphp
    @if(in_array($idn_user->role_id , $role_data))
        @php
            $array_route    = ['assetsdash'];
        @endphp
        <li class="nav-item" role="presentation">
            <a href="{{ route('assetsdash') }}" class="nav-link @if (in_array(Route::currentRouteName() , $array_route)) active @endif">Dashboard</a>
        </li>
    @endif

    @php
        $role_data    = ['1','2','3','4','5','6','7','9','10','11'];
    @endphp
    @if(in_array($idn_user->role_id , $role_data))
        @php
            $array_route    = ['assetscreate'];
        @endphp
        <li class="nav-item" role="presentation">
            <a href="{{ route('assetscreate') }}" class="nav-link @if (in_array(Route::currentRouteName() , $array_route)) active @endif">Create Form</a>
        </li>
    @endif

    @php
        $role_data    = ['1','7','10'];
    @endphp
    @if(in_array($idn_user->role_id , $role_data))
        @php
            $array_route    = ['assetsdephed'];
        @endphp
        <li class="nav-item" role="presentation">
            <a href="{{ route('assetsdephed') }}" class="nav-link @if (in_array(Route::currentRouteName() , $array_route)) active @endif">DepHead Approved</a>
        </li>
    @endif

    @php
        $role_data    = ['1','2','11'];
    @endphp
    @if(in_array($idn_user->role_id , $role_data))
        @php
            $array_route    = ['assetsfirst'];
        @endphp
        <li class="nav-item" role="presentation">
            <a href="{{ route('assetsfirst') }}" class="nav-link @if (in_array(Route::currentRouteName() , $array_route)) active @endif">HRGA Approved</a>
        </li>
    @endif

    @php
        $role_data    = ['1','8'];
    @endphp
    @if(in_array($idn_user->role_id , $role_data))
        @php
            $array_route    = ['assetssecond'];
        @endphp
        <li class="nav-item" role="presentation">
            <a href="{{ route('assetssecond') }}" class="nav-link @if (in_array(Route::currentRouteName() , $array_route)) active @endif">Security</a>
        </li>
    @endif

    @php
        $role_data    = ['1','8'];
    @endphp
    @if(in_array($idn_user->role_id , $role_data))
        @php
            $array_route    = ['assetsdirector'];
        @endphp
        <li class="nav-item" role="presentation">
            <a href="{{ route('assetsdirector') }}" class="nav-link @if (in_array(Route::currentRouteName() , $array_route)) active @endif">Returned</a>
        </li>
    @endif

    @php
        $role_data    = ['1','2','3','4','5','6','7','8','9','10','11'];
    @endphp
    @if(in_array($idn_user->role_id , $role_data))
        @php
            $array_route    = ['assetsdata'];
        @endphp
        <li class="nav-item" role="presentation">
            <a href="{{ route('assetsdata') }}" class="nav-link @if (in_array(Route::currentRouteName() , $array_route)) active @endif">Show Lending Asset</a>
        </li>
    @endif

    @php
        $role_data    = ['1','2','9','10','11'];
    @endphp
    @if(in_array($idn_user->role_id , $role_data))
        @php
            $array_route    = ['dataasset'];
        @endphp
        <li class="nav-item">
            <a href="{{ route('dataasset') }}" class="nav-link @if (in_array(Route::currentRouteName() , $array_route)) active @endif">Data Asset</a>
        </li>
    @endif
</ul>