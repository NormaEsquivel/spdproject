<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo $raiz.'resources/'?>images/iconoSegey.ico">
    <title>Servicio Profesional Docente | Login</title>

    <!-- Bootstrap -->
    <link href="<?php echo $raiz.'resources'?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $raiz.'resources'?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $raiz.'resources'?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo $raiz.'resources'?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo $raiz.'resources'?>/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
   <style type="text/css">
   .cadre{
    display: block;
    padding: 4px;
    margin-bottom: 20px;
    line-height: 1.42857143;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    }
  </style>
  <?php
    if($error != "")
    {
      echo "<h1>".$error."</h1>";
    }
  ?>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <h1>Sistema de Actualizaci&oacute;n y Validaci&oacute;n de Informaci&oacute;n Administrativa del personal que participa en evaluaciones de SPD.</h1>
            <form method="post" action="">
              <br/>
              <br/>
              <br/>
              <h2>Bienvenido</h2>
              <h4>Inicio de sesi&oacute;n</h4>
              <div>
                <input type="text" name="usuario" class="form-control" placeholder="Usuario" required="required" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" required="required" />
              </div>
              <center>
                <img src="resources/captcha/<?php echo $captcha?>.jpg" class="cadre">
              </center>
              Por favor, escriba el resultado de la operaci&oacute;n matem&aacute;tica que aparece en la imagen:
              <input type="text" placeholder="Resultado" style="font-size: 20px"  name="captcha" id="captcha" value="" class="form-control"/>
              <br/>

              <center>
                <input type="submit" class="btn btn-default submit" name="Ingresar" value="Ingresar" />
                <!--<a class="reset_pass" href="#">Lost your password?</a>-->
              </center> 

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="<?php echo $raiz.'resources/images/logoSegey.png'?>" width="50%" height="50%"></h1>
                  <p>©2017 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
