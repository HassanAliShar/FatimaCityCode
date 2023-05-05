<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">

            <span class="page-logo-text mr-1">FatimaKashmiri Admin</span>
        </a>
    </div>
    @if (session()->get('role_id') == 1)
        <nav id="js-primary-nav" class="primary-nav" role="navigation">

            <ul id="js-nav-menu" class="nav-menu">
                <li>
                    <a href="{{ route('dashboard.index') }}" title="UI Components" data-filter-tags="ui components">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.ui_components">Home Page</span>
                    </a>
                </li>
                <li class="nav-title">Blocks Section</li>
                <li>
                    <a href="{{ route('block.add') }}" title="Add Blocks" data-filter-tags="application intel introduction">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_introduction">Add New Block</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('block.manage') }}" title="Manage Blocks" data-filter-tags="application intel privacy">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_privacy">Show All Blocks</span>
                    </a>
                </li>
                <li class="nav-title">Plots Section</li>
                <li>
                    <a href="{{ route('plots.add') }}" title="How it works" data-filter-tags="theme settings how it works">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Add Plots</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('plots.manage') }}" title="Layout Options" data-filter-tags="theme settings layout options">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.theme_settings_layout_options">Plot Details</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('plots.get.franchises.plots') }}" title="Franchises plots" data-filter-tags="theme settings layout options">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.theme_settings_layout_options">Franchises Plots</span>
                    </a>
                </li>
                <li class="nav-title">Booking Section</li>
                <li>
                    <a href="{{ route('add.cusotmer') }}" title="Introduction" data-filter-tags="application intel introduction">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_introduction">Plot Booking</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('manage.customer') }}" title="Privacy" data-filter-tags="application intel privacy">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_privacy">Show Booking</span>
                    </a>
                </li>
                <li class="nav-title">Bookings & Installments</li>
                <li>
                    <a href="{{ route('installment.payment') }}" title="UI Components" data-filter-tags="ui components">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.ui_components">Pay Installment</span>
                    </a>
                </li>
                <li class="nav-title">Franchises Section</li>
                <li>
                    <a href="{{ route('franchise.add') }}" title="Product Licensing" data-filter-tags="package info product licensing">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.package_info_product_licensing">New Franchise</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('franchise.manage') }}" title="Product Licensing" data-filter-tags="package info product licensing">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.package_info_product_licensing">Show Franchises</span>
                    </a>
                </li>
                <li class="nav-title">Franchise Expanses</li>
                <li>
                    <a href="{{ route('expanse.add') }}" title="Add Blocks" data-filter-tags="application intel introduction">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_introduction">Add New Expanse</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('expase.manage') }}" title="Manage Blocks" data-filter-tags="application intel privacy">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_privacy">Show All Expanses</span>
                    </a>
                </li>
            </ul>
            <div class="filter-message js-filter-message bg-success-600"></div>
        </nav>
    @else
        <nav id="js-primary-nav" class="primary-nav" role="navigation">
            <ul id="js-nav-menu" class="nav-menu">
                <li>
                    <a href="/profile/{{ session('id') }}" title="UI Components" data-filter-tags="ui components">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.ui_components">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.dashboard.index') }}" title="UI Components" data-filter-tags="ui components">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.ui_components">Home Page</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.add.cusotmer') }}" title="Introduction" data-filter-tags="application intel introduction">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_introduction"> Plot Booking</span>
                    </a>
                </li>
                <li>

                    <a href="{{ route('agent.manage.customer') }}" title="Privacy" data-filter-tags="application intel privacy">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_privacy">Your Customers</span>
                    </a>
                </li>
                <li class="nav-title">Create Plot Section</li>
                <li>
                    <a href="{{ route('agent.plots.add') }}" title="Add New Plot" data-filter-tags="ui components">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.ui_components">Add Plot</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.plots.manage') }}" title="Manage Plots" data-filter-tags="application intel introduction">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_introduction">Manage</span>
                    </a>
                </li>
                <li class="nav-title">Bookings & Installments</li>
                <li>
                    <a href="{{ route('agent.installment.payment') }}" title="UI Components" data-filter-tags="ui components">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.ui_components">Pay Installment</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.expanse.add') }}" title="Add Blocks" data-filter-tags="application intel introduction">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_introduction">Add Expanses</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.expase.manage') }}" title="Manage Blocks" data-filter-tags="application intel privacy">
                        <i class="fal fa-window"></i>
                        <span class="nav-link-text" data-i18n="nav.application_intel_privacy">Show Expanses</span>
                    </a>
                </li>
            </ul>
            <div class="filter-message js-filter-message bg-success-600"></div>
        </nav>
    @endif
</aside>
