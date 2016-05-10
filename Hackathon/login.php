<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>The Leyends Login</title>
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
      <form class="login-form" name="form1" method="POST" action="index.php?c=usuario&a=acceder">
        <div class="row">
          <div class="input-field col s7 center">
          <center>
            <img src="resources/images/gdg.png" alt="" class="responsive-img valign profile-image-login" style="margin-left: 90px;">
          </center>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input class="validate" id="username" type="text" name="Username" required="true">
            <label for="username" class="center-align">Nombre de Usuario</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password" name="Pass" required="true">
            <label for="password">Contraseña</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <a href="#" onclick="document.form1.submit();" class="btn waves-effect waves-light indigo col s12">Ingresar</a>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <a href="select_register.php" class="btn waves-effect waves-light light-green darken-4 col s12">Registrarse</a>
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