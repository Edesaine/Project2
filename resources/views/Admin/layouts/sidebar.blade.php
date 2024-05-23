<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{asset('images/logo.png')}}" alt="" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a  href="{{url('dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="chart.html">
                        <i class="fas fa-chart-bar"></i>Charts</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-table"></i>Tables</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('book/index')}}">Book Management</a>
                        </li>
                        <li>
                            <a href="{{ url('customer/index')}}">Customer Management</a>
                        </li>
                        <li>
                            <a href="{{url('publisher/index')}}">Publisher Management</a>
                        </li>
                        <li>
                            <a href="{{url('author/index')}}">Author Management</a>
                        </li>
                        <li>
                            <a href="{{url('category/index')}}">Category Management</a>
                        </li>
                        <li>
                            <a href="{{url('order/index')}}">Order Management</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
