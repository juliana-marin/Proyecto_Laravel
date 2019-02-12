<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>3 marias</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap3-wysihtml5.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">


  </head>
  <!-- Color de la cabecera -->
  <body class="hold-transition skin-black sidebar-mini" >
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{url('inicio/inicio')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>3M's</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>3 Marias</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li><a href="{{ route('cart-show') }}"  class="fa fa-shopping-cart"></a></li>
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"role="button" aria-expanded="false">
            <i class="fa fa-user"></i> 
          </a>
                  
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header" style="background-color: #FFFFFF">
                    <p style="color:#848484">
                      Usuario: Administrador - 3 Marias
                      <medium></medium> 
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">

                      <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <!--Menu lateral color negro-->
      <aside class="main-sidebar" style="background-color: #000000">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar ">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" style="background-color: #000000">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span >Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('almacen/producto')}}"><i class="fa fa-check"></i> Producto</a></li>
                <li><a href="{{url('almacen/categoria')}}"><i class="fa fa-check"></i> Categorías</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cart-plus"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('compras/ingreso')}}"><i class="fa fa-check"></i>Ingresos</a></li>
              </ul>
            </li>

             <li class="treeview">
              <a href="#">
                <i class="fa fa-calculator"></i>
                <span>Inventario</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('inventarioProducto/inventario')}}"><i class="fa fa-check"></i>Inventario de productos</a></li>
              </ul>
            </li>


            <li class="treeview">
              <a href="#">
                <i class="fa fa-cc-visa"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('ventas/venta')}}"><i class="fa fa-check"></i> Ventas</a></li>
                <li><a href="{{url('ventas/cliente')}}"><i class="fa fa-check"></i> Clientes</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-line-chart"></i> <span>Estadisticas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('home')}}"><i class="fa fa-area-chart"></i>Graficos</a></li>
                
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-glass"></i> <span>Menu</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('menuProductos/menu')}}"><i class="fa fa-coffee"></i>Menu de productos</a></li>
                
              </ul>
            </li>
                       
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('seguridad/usuario')}}"><i class="fa fa-group"></i> Usuarios</a></li>
                
              </ul>
            </li>

                                    
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <!--Color de fondo del panel de informacion-->
      <div class="content-wrapper" style="background-color: #1B0A2A">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><b>Gestor de Inventario</b></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
    <!--Fin-Contenido-->
      <footer class="main-footer" >
        <strong>Siguenos en nuestras Redes Sociales:
          <a href="#"><i class="fa fa-facebook-official fa-2x"></i></a>
          <a href="#"><i class="fa fa-instagram fa-2x"></i></a>
          <a href="#"><i class="fa fa-whatsapp fa-2x"></i></a>
       </strong>
      </footer>
     

      
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset ( 'js/jQuery-2.1.4.min.js' )}}"></script>
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset ( 'js/bootstrap.min.js' )}}"></script>
    <script src="{{ asset ( 'js/bootstrap-select.min.js' )}}"></script>
    <script src="{{ asset ( 'js/bootstrap3-wysihtml5.all.min.js' )}}"></script>
    <script src="{{ asset ( 'js/main.js' )}}"></script>
    <script src="{{ asset ( 'js/pinterest_grid.js' )}}"></script>
   
    <!-- AdminLTE App -->
    <script src="{{ asset ('js/app.min.js')}}"></script>

    
  </body>
</html>
