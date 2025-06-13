<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('admin.clients.index') }}"><i class="fa fa-th"></i><span>Client</span></a></li>

                <li><a href="{{ route('admin.barbers.index') }}"><i class="fa fa-th"></i><span>Barber</span></a></li>

                <!-- Shop Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Shop
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="shopDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.shops.index') }}">Shop</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.shop-hours.index') }}">Shop Hours</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.shop-services.index') }}">Shop Services</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                      <i class="fa fa-th"></i>
                      <span>Schedules</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('admin.schedules.active') }}">Active</a></li>
                      <li><a class="dropdown-item" href="{{ route('admin.schedules.incoming') }}">Incoming</a></li>
                      <li><a class="dropdown-item" href="{{ route('admin.schedules.history') }}">History</a></li>
                      <li><a class="dropdown-item" href="{{ route('admin.schedules.index') }}">All</a></li>
                    </ul>
                </li>

                <!-- Clients & Reports Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="clientDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Clients & Reports
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="clientDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.favorite-clients.index') }}">Favorite Clients</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.rates.index') }}">Rates</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.reports.index') }}">Reports</a></li>
                    </ul>
                </li>

                <li><a href="#"><i class="fa fa-th"></i><span>Help Message</span></a></li>
        </ul>

    </section>

</aside>

