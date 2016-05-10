<body class="">
<center>
<div class="col s12 z-depth-6 card-panel">
    <div class="row">     
      <form class="login-form" action="index.php?c=reportes&a=generar" method="POST" name="form1">
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="nombre" type="text" class="validate" name="Nombre">
            <label for="nombre" class="center-align">Nombre</label>
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

        <div class="row">
          <div class="col s12 m15 l15">
            <div class="input-field col s12">
              <select name="Distrito">
                <option value="" disabled selected>Elija su Distrito</option>
                <option value="05">Distrito 5</option>
                <option value="11">Distrito 11</option>
              </select>
            </div>
          </div>
        </div>
          
        <div class="row">
            <p>
              <input name="Barras" type="radio" id="test1" />
              <label for="test1">Barras</label>
            </p>
            <p>
              <input name="Torta" type="radio" id="test2" />
              <label for="test2">Torta</label>
            </p>
        </div>
        
        <div class="row">
          <div class="input-field col s12">
            <a href="#" onclick="document.form1.submit();" class="btn waves-effect waves-light indigo col s12">Generar</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</center>
</body>

</html>
