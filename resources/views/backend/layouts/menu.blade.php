<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index-2.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('backend') }}/assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backend') }}/assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index-2.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('backend') }}/assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                {{-- <img src="{{ asset('backend') }}/assets/images/logo-light.png" alt=""
                    height="17"> --}}
                    <h2 class="text-white py-4">Vegist</h2>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics.html" class="nav-link" data-key="t-analytics">
                                    Analytics </a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm.html" class="nav-link" data-key="t-crm"> CRM </a>
                            </li>
                            <li class="nav-item">
                                <a href="index-2.html" class="nav-link" data-key="t-ecommerce"> Ecommerce
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crypto.html" class="nav-link" data-key="t-crypto"> Crypto
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-projects.html" class="nav-link" data-key="t-projects">
                                    Projects </a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-nft.html" class="nav-link"> <span
                                        data-key="t-nft">NFT</span> <span class="badge badge-pill bg-danger"
                                        data-key="t-new">New</span></a>
                            </li>
                        </ul>
                    </div>
                </li>  --}}



                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                        <i class="mdi mdi-puzzle-outline"></i> <span>Dashboard</span>
                    </a>
                </li>

                {{-- slider --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSlider" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSlider">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Slider</span>
                    </a>

                    <div class="collapse menu-dropdown {{ request()->routeIs('slider.*') ? 'show' : ''}}" id="sidebarSlider">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('slider.index')}}" class="nav-link {{ request()->routeIs('slider.index') ? 'active' : ''}}" data-key="t-crm"> View All </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('slider.create')}}" class="nav-link {{ request()->routeIs('slider.create') ? 'active' : ''}}" data-key="t-crm"> Create </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- category --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCategory" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCategory">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Category</span>
                    </a>

                    <div class="collapse menu-dropdown {{ request()->routeIs('slider.*') ? 'show' : ''}}" id="sidebarCategory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('category.index')}}" class="nav-link {{ request()->routeIs('category.index') ? 'active' : ''}}" data-key="t-crm"> View All </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.create')}}" class="nav-link {{ request()->routeIs('category.create') ? 'active' : ''}}" data-key="t-crm"> Create </a>
                            </li>
                        </ul>
                    </div>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
