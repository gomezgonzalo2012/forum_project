<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Home</div>
                <a class="nav-link" href="{{route('Home.index')}}">
                    <div class="sb-nav-link-icon"><i class="bi bi-house"></i></div>
                    Principal
                </a>
                <div class="sb-sidenav-menu-heading">Discusiones</div>
                <a class="nav-link" href="{{route('posts.create')}}">
                    <div class="sb-nav-link-icon"><i class="bi bi-plus-square"></i></div>Crear Discusion
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                    <div class="sb-nav-link-icon"><i class="bi bi-card-checklist"></i></div>
                    Categorias
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @foreach ($categories as $category )
                        <a class="nav-link" href="#">{{$category->name}}</a>
                        @endforeach
                    </nav>
                </div>
                @if(Auth::check())
                    @if(Auth::user()->user_rol=="admin" || Auth::user()->user_rol=="superAdmin")
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="bi bi-people"></i></i></div>
                        Moderadores
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('admin.index')}}">Moderar Discusiones</a>
                            <a class="nav-link" href="{{route('admin.createCategory')}}">Agregar Categorias</a>

                        </nav>
                    </div>
                    @if(Auth::user()->user_rol=="superAdmin") <!--solo para super usuario-->
                    <div class="nav-link">
                    <i class="bi bi-shield-lock"></i><a class="nav-link" href="{{route('superAdmin.index')}}">Administrar Moderadores</a>
                    </div>
                    @endif
                    @endif

                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
