<ul class="nav nav-tabs">
    @php
        $array_route = ['inputcia'];
    @endphp
    <li class="nav-item" role="presentation">
        <a href="{{ route('inputcia') }}" class="nav-link @if (in_array(Route::currentRouteName(), $array_route)) active @endif">Form CIA</a>
    </li>

    @php
        $array_route = ['listciadephead'];
    @endphp
    <li class="nav-item" role="presentation">
        <a href="{{ route('listciadephead') }}" class="nav-link @if (in_array(Route::currentRouteName(), $array_route)) active @endif">Dephead
            Approved</a>
    </li>

    @php
        $array_route = ['listciafinance'];
    @endphp
    <li class="nav-item" role="presentation">
        <a href="{{ route('listciafinance') }}" class="nav-link @if (in_array(Route::currentRouteName(), $array_route)) active @endif">Finance
            Approved</a>
    </li>

    @php
        $array_route = ['listciacashier'];
    @endphp
    <li class="nav-item" role="presentation">
        <a href="{{ route('listciacashier') }}"
            class="nav-link @if (in_array(Route::currentRouteName(), $array_route)) active @endif">Payment</a>
    </li>

    @php
        $array_route = ['listcia'];
    @endphp
    <li class="nav-item" role="presentation">
        <a href="{{ route('listcia') }}" class="nav-link @if (in_array(Route::currentRouteName(), $array_route)) active @endif">Overview</a>
    </li>
</ul>
