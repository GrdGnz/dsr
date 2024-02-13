<nav class="sb-sidenav accordion marsman-bg-color-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav mt-3">
            <a class="nav-link text-white" href="{{ route('home') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link text-white" href="{{ route('datasource') }}">
                <div class="sb-nav-link-icon"><i class="far fa-chart-bar"></i></div>
                Data
            </a>

        </div>
    </div>
    <div class="sb-sidenav-footer marsman-bg-color-semidark txt-secondary">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->name }}
    </div>
</nav>
