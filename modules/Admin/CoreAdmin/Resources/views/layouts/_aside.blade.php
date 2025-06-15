<aside class="main-sidebar">
    <section class="sidebar">

        <!-- User Panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                <a href="{{ route('admin.clients.index') }}">
                    <i class="fa fa-users"></i> <span>Clients</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.barbers.*') ? 'active' : '' }}">
                <a href="{{ route('admin.barbers.index') }}">
                    <i class="fa fa-user"></i> <span>Barbers</span>
                </a>
            </li>

            <!-- Shop Dropdown -->
            @php
                $shopActive = request()->routeIs('admin.shops.*') || request()->routeIs('admin.shops-hours.*') || request()->routeIs('admin.shops-services.*');
            @endphp
            <li class="treeview {{ $shopActive ? 'active menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-building"></i> <span>Shop</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu" style="{{ $shopActive ? 'display: block;' : '' }}">
                    <li class="{{ request()->routeIs('admin.shops.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.shops.index') }}"><i class="fa fa-circle-o"></i> Shop</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.shops-services.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.shops-services.index') }}"><i class="fa fa-cut"></i> Shop Services</a>
                    </li>
                </ul>
            </li>

            <!-- Schedules Dropdown -->
            @php
                $scheduleActive = request()->routeIs('admin.schedules.*');
            @endphp
            <li class="treeview {{ $scheduleActive ? 'active menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-calendar"></i> <span>Schedules</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu" style="{{ $scheduleActive ? 'display: block;' : '' }}">
                    <li class="{{ request()->routeIs('admin.schedules.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.schedules.index') }}"><i class="fa fa-circle-o"></i> All</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.schedules.active') ? 'active' : '' }}">
                        <a href="{{ route('admin.schedules.active') }}"><i class="fa fa-circle-o"></i> Active</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.schedules.incoming') ? 'active' : '' }}">
                        <a href="{{ route('admin.schedules.incoming') }}"><i class="fa fa-circle-o"></i> Incoming</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.schedules.history') ? 'active' : '' }}">
                        <a href="{{ route('admin.schedules.history') }}"><i class="fa fa-circle-o"></i> History</a>
                    </li>
                </ul>
            </li>

            <!-- Clients & Reports Dropdown -->
            @php
                $reportsActive = request()->routeIs('admin.favorites.*') || request()->routeIs('admin.rates.*') || request()->routeIs('admin.reports.*');
            @endphp
            <li class="treeview {{ $reportsActive ? 'active menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-file-text"></i> <span>Clients & Reports</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu" style="{{ $reportsActive ? 'display: block;' : '' }}">
                    <li class="{{ request()->routeIs('admin.favorites.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.favorites.index') }}"><i class="fa fa-heart"></i> Favorite Clients</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.rates.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.rates.index') }}"><i class="fa fa-star"></i> Rates</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.reports.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.reports.index') }}"><i class="fa fa-exclamation-circle text-warning"></i> Reports</a>
                    </li>
                </ul>
            </li>

            <!-- Help Message -->
            <li class="{{ request()->routeIs('admin.helps.*') ? 'active' : '' }}">
                <a href="{{ route('admin.helps.index') }}">
                    <i class="fa fa-question-circle"></i> <span>Help Message</span>
                </a>
            </li>
        </ul>

    </section>
</aside>
