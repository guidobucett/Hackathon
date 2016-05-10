<div class="row">
<div class="col s12 m12 l6">
 <div class="card-panel">
 <h4 class="header1">Registro de Usuario</h4>
  <div class="row">
    <form class="col s12" action="ver.php" 
      method="post" enctype="multipart/form-data" >
      
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" class="validate">
          <label for="icon_prefix">Nombre</label>
        </div>


        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" class="validate">
          <label for="icon_prefix">Apellido</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input id="icon_correo" type="email" class="validate">
          <label for="icon_correo">Correo</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">today</i>
          <input id="icon_fecha" type="date" class="datepicker" >
          <label for="icon_fecha">Fecha de Nacimiento </label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">store</i>
          <input id="icon_store" type="text" class="validate">
          <label for="icon_store">Direccion</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">phone</i>
          <input id="icon_telephone" type="tel" class="validate">
          <label for="icon_telephone">Telefono</label>
        </div>
 

        <div class="input-field col s12">
          <i class="material-icons prefix">perm_identity</i>
          <input id="icon_username" type="text" class="validate">
          <label for="icon_username">Username</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">vpn_key</i>
          <input id="icon_password" type="password" class="validate">
          <label for="icon_password">Password</label>
        </div>

      
        
      
       <button class="btn waves-effect waves-light right" type="submit" name="action">Registrar
       <i class="material-icons right">send</i></button>
    </form>
   </div>
   </div>
  </div> 
</div> 


<script type="text/javascript">
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });

</script> 