<div class="sidebar" data-color="orange">
    <div class="logo">
        <a href="{{ route('dashboard') }}" class="simple-text logo-mini">

        </a>
        <a href="{{ route('dashboard') }}" class="simple-text logo-normal">
            {{ config('app.name') }}
        </a>
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-simple btn-icon btn-neutral btn-round">
                <i class="now-ui-icons text_align-center visible-on-sidebar-regular"></i>
                <i class="now-ui-icons design_bullet-list-67 visible-on-sidebar-mini"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="/img/default-avatar.png" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#profile" class="collapsed">
                <span>
                    <br>
                <b class="caret"></b>
                </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="profile">
                    <ul class="nav">
                        <li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="{{ request()->is('/') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="{{ request()->is('products*') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#products">
                    <i class="fa fa-user"></i>
                    <p>productos
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="products">
                    <ul class="nav">
                        <li class="{{ request()->is('products') ? 'active' : '' }}">
                            <a href=" {{ route('products.index') }}">
                                <span class="sidebar-normal"><i class="fa fa-list"></i></span>
                                <span class="sidebar-normal">Lista de productos</span>
                            </a>
                        </li>
                        <li >
                            @if(request()->is('products/*'))
                            <a href="{{ route('products.index', '#product') }}">
                                <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                <span class="sidebar-normal">Nuevo producto</span>
                            </a>
                            @else
                                <a href="#" data-toggle="modal" data-target="#createProducts">
                                    <span class="sidebar-normal"><i class="fa fa-plus"></i></span>
                                    <span class="sidebar-normal">Nuevo producto</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
