@if (!Auth::user())
    <script>
        window.location.replace("login");
    </script>
@endif
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AD-Restaurant</title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/materialize.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
      
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>
  <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
      <style>
      
      .disabled {
           pointer-events: none;
           cursor: default;
        }
      </style>
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>AD</b>R</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>AD-Restaurant</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation"  style="height: 50px;">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"  style="height: 50px; line-height: 1.7;">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
           @guest
             @else
          <div class="navbar-custom-menu" style="float: right; width: auto; margin-right: 50px;">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">Hola: {{ Auth::user()->name }} </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
                @endguest
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
            
          <ul class="sidebar-menu">
            <li class="header"></li>
              @if (!Auth::user())
                <script>
                    window.location.replace("login");
                </script>
            @else
              @if(Auth::user()->roll==1)
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Pedidos</span>
                     <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('ventasP')}}"><i class="fa fa-circle-o"></i> Compras</a></li>
                  </ul>
                </li>
              @elseif(Auth::user()->roll==2)
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-coffee" aria-hidden="true"></i>
                    <span>Cocina</span>
                     <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('chef')}}"><i class="fa fa-circle-o"></i> Pedidos</a></li>
                  </ul>
                </li>
              @elseif(Auth::user()->roll==3)
              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-motorcycle" aria-hidden="true"></i>
                    <span>Repartidor</span>
                     <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('repartidor')}}"><i class="fa fa-circle-o"></i> Pedidos</a></li>
                  </ul>
                </li>
             @else
              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-motorcycle" aria-hidden="true"></i>
                    <span>Repartidor</span>
                     <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('repartidor')}}"><i class="fa fa-circle-o"></i> Pedidos</a></li>
                  </ul>
                </li>
              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-coffee" aria-hidden="true"></i>
                    <span>Cocina</span>
                     <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('chef')}}"><i class="fa fa-circle-o"></i> Pedidos</a></li>
                  </ul>
                </li>
              
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Pedidos</span>
                     <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('ventasP')}}"><i class="fa fa-circle-o"></i> Compras</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Productos</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('menu')}}"><i class="fa fa-circle-o"></i> Menu</a></li>
                    <li><a href="{{asset('categorias')}}"><i class="fa fa-circle-o"></i> Categorias</a></li>
                    <!--<li><a href="ingredientes"><i class="fa fa-circle-o"></i> Ingredientes</a></li>-->
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Ventas</span>
                     <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('ventas')}}"><i class="fa fa-circle-o"></i> Ventas</a></li>
                    <li><a href="{{asset('clientes')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                  </ul>
                </li>

                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-folder"></i> <span>Acceso</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{asset('usuario')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                  </ul>
                </li>  
              @endif
            @endif
            </ul>
        </section>
      </aside>

      <div class="content-wrapper">
        
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">ADMINISTRACIÓN</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido Dinamico-->
                               @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div>
                </div>
              </div>
        </section>
    </div>      
</div>
      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
      
    <script src="{{asset('js/materialize.min.js')}}"></script>
      <script>$(document).ready(function() {
    $('select').material_select();
     $('.carousel.carousel-slider').carousel({
    fullWidth: false,
    indicators: true
  });
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Hoy',
    format: 'yyyy/mm/dd',
    clear: 'Limpiar',
    close: 'Aceptar',
    closeOnSelect: false, // Close upon selecting a date,
    container: undefined,
  });
  });</script>
    
  </body>
</html>
