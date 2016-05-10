<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>The Leyends</title>
  <!-- CORE CSS-->
  
  <link rel="stylesheet" href="resources/css/materialize.css">

<style type="text/css">
html,
body {
    height: 100%;
}
html {
    display: table;
    margin: auto;
}
body {
    display: table-cell;
    vertical-align: middle;
}
.margin {
  margin: 0 !important;
}
</style>
  
</head>

<body class="green">


  <div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
      <form class="login-form" action="index.php?c=usuario&a=registrar" method="POST" name="form1">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="resources/images/gdg.png" alt="" class="responsive-img valign profile-image-login" style="margin-left: 30px; width: 200px; height: 120px;">
            <p class="center login-form-text">REGISTRO DE EMPRESA</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="nombre" type="text" class="validate" name="Nombre">
            <label for="nombre" class="center-align">Nombre de la Empresa</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="responsable" type="text" class="validate" name="Responsable">
            <label for="responsable" class="center-align">Responsable</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input id="email" type="email" class="validate" name="Correo">
            <label for="email" class="center-align">Email</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-phone prefix"></i>
            <input id="telefono" type="text" class="validate" name="Telefono">
            <label for="telefono" class="center-align">Telefono</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" type="text" class="validate" name="Username">
            <label for="username" class="center-align">Nombre de Usuario</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password" class="validate" name="Pass">
            <label for="password">Contraseña</label>
          </div>
        </div>  
        <div class="row">
          <div class="input-field col s12">
            <a href="#" onclick="document.form1.submit();" class="btn waves-effect waves-light indigo col s12">Registrar</a>
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Ya tienes una Cuenta? <a href="login.php" class="btn waves-effect waves-light light-green darken-4 col s12">Inicio de Sesion</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- jQuery Library -->
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!--materialize js-->
  <script src="resources/js/materialize.min.js"></script>


</body>

</html>