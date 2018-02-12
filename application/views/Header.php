<!DOCTYPE html>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo $raiz.'resources/'?>images/iconoSegey.ico">
    <title>Sevicio Profesional Docente</title>
    
    <!-- Bootstrap -->
    <link href="<?php echo $raiz.'resources'?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $raiz.'resources'?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $raiz.'resources'?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $raiz.'resources'?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?php echo $raiz.'resources'?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo $raiz.'resources'?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo $raiz.'resources'?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo $raiz.'resources'?>/build/css/custom.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="<?php echo $raiz.'resources'?>/vendors/select2/dist/css/select2.min.css" rel="stylesheet">

    <!-- Dropzone.js -->
    <link href="<?php echo $raiz.'resources'?>/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="<?php echo $raiz.'resources'?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $raiz.'resources'?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $raiz.'resources'?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $raiz.'resources'?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $raiz.'resources'?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script> -->
    <script src="<?php echo $raiz.'resources'?>/vendors/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo $raiz.'resources'?>/vendors/jquery/jquery-ui.css">
    <script src="<?php echo $raiz.'resources'?>/vendors/jquery/jquery-ui.min.js"></script>

    <link href="<?php echo $raiz.'resources'?>/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo $raiz.'resources'?>/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo $raiz.'resources'?>/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
  
    <script type="text/javascript">
      function salir(){
        var respuesta=confirm('¿Desea salir?');
        if(respuesta==true)
          window.location="http://<?php echo $_SERVER['SERVER_NAME'].$raiz?>outlogin";
        else
          return false;
      }
    </script>
  
  </head>
  
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo $raiz?>" class="site_title"><img src="<?php echo $raiz.'resources/'?>images/serviciopd.png" height="100%" weight="100%"> SERVICIO PROFESIONAL DOCENTE</a>
            </div>

            <div class="clearfix"></div>
            <?php
            if(!empty($this->session->userdata('fotoUsuario')))
            {
              $img=$this->session->userdata('fotoUsuario');
            }
            else
            {
              $img="user.png";
            }
            ?>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo $raiz.'resources/profile/'.$img?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido (a),</span>
                <h2><?php echo $this->session->userdata('primerNombre').' '.$this->session->userdata('primerApellido').' '.$this->session->userdata('segundoApellido')?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> General <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php
                        foreach ($menu as $keymenu => $valuemenu) {
                          echo '<li id="'.$menu[$keymenu]['urlMenu'].'"><a href="'.$raiz.$menu[$keymenu]['urlMenu'].'"><i class="'.$menu[$keymenu]['iconoMenu'].'"></i> '.$menu[$keymenu]['textoMenu'].'</a></li>';
                        }
                      ?>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons 
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Configuraciones" href="<?php echo $raiz.'miperfil'?>">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" id="menu_toggle" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Salir" href="<?php echo $raiz.'outlogin'?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>-->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <!--<div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>-->

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $raiz.'resources/profile/'.$img?>" alt=""><?php echo $this->session->userdata('primerNombre').' '.$this->session->userdata('primerApellido').' '.$this->session->userdata('segundoApellido')?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo $raiz.'miperfil'?>"> Perfil</a></li>
                    <li><a href="#" onclick='salir()' ><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->