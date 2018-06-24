<div class="container-fluid pr-0 pl-0">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('brand/_ionicons_svg_md-ribbon.svg') }}" width="30" height="30" class="d-inline-block align-top svg" alt="">{{ config('app.name', 'Cursos') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
                <li>
                    <a class="nav-link text-danger" target="_blank" href="http://{{ str_slug(Auth::user()->name) }}.cursos.prod">
                        <strong>
                            <i class="fas fa-globe"></i> Ver meu portal
                        </strong>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-graduation-cap"></i> Cursos <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('curso-view')
                        <a href="/painel/cursos" class="dropdown-item">
                            Cadastrar cursos
                        </a>
                        @endcan
                        <a href="" class="dropdown-item">
                            Cursos adquiridos
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-cog"></i> Configurações <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="" class="dropdown-item">
                            Recebimento
                        </a>
                        @can('usuario-view')
                        <a href="/painel/usuarios" class="dropdown-item">
                            Usuários
                        </a>
                        @endcan
                        @can('papel-view')
                            <a href="/painel/papeis" class="dropdown-item">
                                Papéis
                            </a>
                        @endcan
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="">
                            Perfil
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</div>
