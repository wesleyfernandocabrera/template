<aside class="sidebar">
    <!-- Sidebar Header Starts -->
    <a href="{{ route('home') }}">
        <div class="sidebar-header">
            <div class="sidebar-logo-icon">
                <x-application-logo class="w-20 h-15 fill-current text-gray-500" />
            </div>

            <div class="sidebar-logo-text">
                <h1 class="flex text-xl">
                    
                    <span class="whitespace-nowrap text-base  dark:text-slate-200"> {{ $settings?->companie_name ?? 'Nome da Empresa' }} </span>
                    
                </h1>

                <p class="whitespace-nowrap text-xs text-slate-400">  {{ $settings?->companie_description ?? 'Descrição da Empresa' }}</p>
            </div>
        </div>
    </a>
    <!-- Sidebar Header Ends -->

    <!-- Sidebar Menu Starts -->
    <ul class="sidebar-content">
        <!-- Dashboard -->

        <li>
            <a href="javascript:void(0);"
                class="sidebar-menu  {{ request()->routeIs('dashboard', 'ecommerce.report') ? 'active' : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="home"></i>
                </span>
                <span class="sidebar-menu-text">Dashboard</span>
                <span class="sidebar-menu-arrow">
                    <i data-feather="chevron-right"></i>
                </span>
            </a>
            <ul class="sidebar-submenu">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Analytics</a>
                </li>
                <li>
                    <a href="{{ route('ecommerce.report') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('ecommerce.report') ? 'active' : '' }}">Ecommerce</a>
                </li>
            </ul>
        </li>


        <div class="sidebar-menu-header">Applications</div>

        <!-- Email -->

        <li>
            <a href="{{ route('email') }}" class="sidebar-menu {{ request()->routeIs('email') ? 'active' : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="mail"></i>
                </span>
                <span class="sidebar-menu-text">Email</span>
            </a>
        </li>


        <!-- Chat -->

        <li>
            <a href="{{ route('chat') }}" class="sidebar-menu {{ request()->routeIs('chat') ? 'active' : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="message-square"></i>
                </span>
                <span class="sidebar-menu-text">Chat</span>
            </a>
        </li>


        <!-- Calendar -->

        <li>
            <a href="{{ route('calendar') }}"
                class="sidebar-menu {{ request()->routeIs('calendar') ? 'active' : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="calendar"></i>
                </span>
                <span class="sidebar-menu-text">Calendar</span>
            </a>
        </li>

        <!-- Invoice -->

        <li>

            <a href="javascript:void(0);"
                class="sidebar-menu {{ request()->routeIs('invoice.create', 'invoice.details') ? 'active' : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="file-text"></i>
                </span>
                <span class="sidebar-menu-text ">Invoice</span>
                <span class="sidebar-menu-arrow">
                    <i data-feather="chevron-right"></i>
                </span>
            </a>


            <ul class="sidebar-submenu">
                <li>
                    <a href="{{ route('invoice.create') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('invoice.create') ? 'active' : '' }}">
                        Create
                    </a>
                </li>

                <li>
                    <a href="{{ route('invoice.details') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('invoice.details') ? 'active' : '' }}">
                        Details
                    </a>
                </li>
            </ul>

        </li>

        <!-- ecommnerce -->

        <li>
            <a href="javascript:void(0);"
                class="sidebar-menu {{ request()->routeIs(['product.index', 'product.edit', 'order.index', 'order.show', 'customer.index'])
                    ? 'active'
                    : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="shopping-bag"></i>
                </span>
                <span class="sidebar-menu-text">Ecommerce</span>
                <span class="sidebar-menu-arrow">
                    <i data-feather="chevron-right"></i>
                </span>
            </a>
            <ul class="sidebar-submenu">

                <li>
                    <a href="{{ route('product.index') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('product.index') ? 'active' : '' }}">
                        Product List </a>
                </li>


                <li>
                    <a href="{{ route('product.edit') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('product.edit') ? 'active' : '' }}">
                        Product Edit </a>
                </li>


                <li>
                    <a href="{{ route('order.index') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('order.index') ? 'active' : '' }}">
                        Order List </a>
                </li>


                <li>
                    <a href="{{ route('order.show') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('order.show') ? 'active' : '' }}">
                        Order Details </a>
                </li>


                <li>
                    <a href="{{ route('customer.index') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('customer.index') ? 'active' : '' }}">
                        Customer List </a>
                </li>

            </ul>
        </li>

        <!-- Users -->
        <li>
            <a href="javascript:void(0);"
                class="sidebar-menu {{ request()->routeIs(['user.list', 'user.profile']) ? 'active' : '' }}">

                <span class="sidebar-menu-icon">
                    <i data-feather="users"></i>
                </span>
                <span class="sidebar-menu-text">Users</span>
                <span class="sidebar-menu-arrow">
                    <i data-feather="chevron-right"></i>
                </span>
            </a>
            <ul class="sidebar-submenu ">

                <li>
                    <a href="{{ route('user.list') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('user.list') ? 'active' : '' }}">
                        List</a>
                </li>
                <li>
                    <a href="{{ route('user.profile') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                        Profile</a>
                </li>

            </ul>
        </li>
        <!--  Commponents  -->
        <div class="sidebar-menu-header">Components</div>
        <!-- Common  -->
        @php
            $commonRoutes = [
                'common.accordion' => 'Accordion',
                'common.alert' => 'Alert',
                'common.avatar' => 'Avatar',
                'common.badge' => 'Badge',
                'common.button' => 'Button',
                'common.card' => 'Card',
                'common.carousel' => 'Carousel',
                'common.drawer' => 'Drawer',
                'common.dropdown' => 'Dropdown',
                'common.list.group' => 'List Group',
                'common.modal' => 'Modal',
                'common.pagination' => 'Pagination',
                'common.progress.bar' => 'Progress',
                'common.spinner' => 'Spinner',
                'common.tabs' => 'Tab',
                'common.toast' => 'Toast',
                'common.tooltip' => 'Tooltip',
                'common.skeleton' => 'Skeleton',
            ];

        @endphp

        <li>
            <a href="javascript:void(0);"
                class="sidebar-menu {{ collect($commonRoutes)->keys()->contains(request()->route()->getName())? 'active': '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="box"></i>
                </span>
                <span class="sidebar-menu-text">Common</span>
                <span class="sidebar-menu-arrow">
                    <i data-feather="chevron-right"></i>
                </span>
            </a>
            <ul class="sidebar-submenu">
                @foreach ($commonRoutes as $route => $name)
                    <li>
                        <a href="{{ route($route) }}"
                            class="sidebar-submenu-item {{ request()->routeIs($route) ? 'active' : '' }}">
                            {{ $name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

        <!-- Forms  -->
        @php
            $formRoutes = [
                'form.input' => 'Input',
                'form.input.group' => 'Input Group',
                'form.textarea' => 'Textarea',
                'form.checkbox' => 'Checkbox',
                'form.radio' => 'Radio',
                'form.toggle' => 'Toggle',
                'form.select' => 'Select',
                'form.datepicker' => 'Datepicker',
                'form.editor' => 'Editor',
                'form.uploader' => 'Uploader',
                'form.layout' => 'Layout',
                'form.validation' => 'Validation',
            ];
        @endphp
        <li>
            <a href="javascript:void(0);"
                class="sidebar-menu {{ collect($formRoutes)->keys()->contains(request()->route()->getName())? 'active': '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="edit"></i>
                </span>
                <span class="sidebar-menu-text">Forms</span>
                <span class="sidebar-menu-arrow">
                    <i data-feather="chevron-right"></i>
                </span>
            </a>
            <ul class="sidebar-submenu">
                @foreach ($formRoutes as $route => $name)
                    <li>
                        <a href="{{ route($route) }}"
                            class="sidebar-submenu-item {{ request()->routeIs($route) ? 'active' : '' }}">
                            {{ $name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

        <!-- Tables  -->
        <li>
            <a href="javascript:void(0);"
                class="sidebar-menu {{ request()->routeIs('table.data', 'table.basic') ? 'active' : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="list"></i>
                </span>
                <span class="sidebar-menu-text">Tables</span>
                <span class="sidebar-menu-arrow">
                    <i data-feather="chevron-right"></i>
                </span>
            </a>
            <ul class="sidebar-submenu">
                <li>
                    <a href="{{ route('table.basic') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('table.basic') ? 'active' : '' }}">
                        Basic Table </a>
                </li>
                <li>
                    <a href="{{ route('table.data') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('table.data') ? 'active' : '' }}">
                        Data Table </a>
                </li>
            </ul>
        </li>
        <!-- Charts  -->
        <li>
            <a href="{{ route('chart.index') }}"
                class="sidebar-menu {{ request()->routeIs('chart.index') ? 'active' : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="pie-chart"></i>
                </span>
                <span class="sidebar-menu-text">Charts</span>
            </a>
        </li>
        <!-- Icons-->
        <li>
            <a href="{{ route('icons.index') }}"
                class="sidebar-menu {{ request()->routeIs('icons.index') ? 'active' : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="italic"></i>
                </span>
                <span class="sidebar-menu-text">Icons</span>
            </a>
        </li>
        <!-- Typography-->
        <li>
            <a href="{{ route('typography.index') }}"
                class="sidebar-menu {{ request()->routeIs('typography.index') ? 'active' : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="type"></i>
                </span>
                <span class="sidebar-menu-text">Typography</span>
            </a>
        </li>
        <!--  Pages  -->
        <div class="sidebar-menu-header">Pages</div>
        <!-- Authentication  -->
        <li>
            <a href="javascript:void(0);"
                class="sidebar-menu {{ request()->routeIs([
                    'authentication.login',
                    'authentication.register',
                    'authentication.recover.password',
                    'authentication.reset.password',
                ])
                    ? 'active'
                    : '' }}">

                <span class="sidebar-menu-icon">
                    <i data-feather="lock"></i>
                </span>
                <span class="sidebar-menu-text">Authentication</span>
                <span class="sidebar-menu-arrow">
                    <i data-feather="chevron-right"></i>
                </span>
            </a>
            <ul class="sidebar-submenu">
                <li>
                    <a href="{{ route('authentication.login') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('authentication.login') ? 'active' : '' }}">Login</a>
                </li>
                <li>
                    <a href="{{ route('authentication.register') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('authentication.register') ? 'active' : '' }}">
                        Register </a>
                </li>
                <li>
                    <a href="{{ route('authentication.recover.password') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('authentication.recover.password') ? 'active' : '' }}">
                        Forgot Password </a>
                </li>
                <li>
                    <a href="{{ route('authentication.reset.password') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('authentication.reset.password') ? 'active' : '' }}">
                        Reset Password </a>
                </li>
            </ul>
        </li>
        <!-- Miscellaneous  -->
        <li>
            <a href="javascript:void(0);"
                class="sidebar-menu {{ request()->routeIs('miscellaneous.starter', 'miscellaneous.comming.soon', 'miscellaneous.maintenance', 'miscellaneous.404', 'miscellaneous.500', 'miscellaneous.403') ? 'active' : '' }}">
                <span class="sidebar-menu-icon">
                    <i data-feather="grid"></i>
                </span>
                <span class="sidebar-menu-text">Miscellaneous</span>
                <span class="sidebar-menu-arrow">
                    <i data-feather="chevron-right"></i>
                </span>
            </a>
            <ul class="sidebar-submenu">
                <li>
                    <a href="{{ route('miscellaneous.starter') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('miscellaneous.starter') ? 'active' : '' }}">
                        Starter Page </a>
                </li>
                <li>
                    <a href="{{ route('miscellaneous.comming.soon') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('miscellaneous.comming.soon') ? 'active' : '' }}">
                        Coming Soon </a>
                </li>
                <li>
                    <a href="{{ route('miscellaneous.maintenance') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('miscellaneous.maintenance') ? 'active' : '' }}">
                        Maintenance </a>
                </li>
                <li>
                    <a href="{{ route('miscellaneous.404') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('miscellaneous.404') ? 'active' : '' }}">
                        Error 404 </a>
                </li>
                <li>
                    <a href="{{ route('miscellaneous.500') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('miscellaneous.500') ? 'active' : '' }}">
                        Error 500 </a>
                </li>
                <li>
                    <a href="{{ route('miscellaneous.403') }}"
                        class="sidebar-submenu-item {{ request()->routeIs('miscellaneous.403') ? 'active' : '' }}">
                        Not Authorized </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Ends -->
</aside>
