<body class="">
<center>
<div class="col s12 z-depth-6 card-panel">
    <div class="row">     
      <form class="login-form" action="index.php?c=reportes&a=generar" method="POST" name="form1">
        <div class="row">
          <div class="input-field col s12 center">
            
            <p class="center login-form-text">REPORTES</p>
          </div>
        </div>

        <div class="row">
          <div class="col s12 m15 l15">
            <div class="input-field col s12">
              <select name="Tipo">
                <option value="" disabled selected>Elija su Tipo de Reporte</option>
                <option value="Hospital">Hospitales</option>
                <option value="Hotel">Hoteles</option>
                <option value="Comida">Restaurantes</option>
                <option value="Diversion">Diversion</option>
              </select>
            </div>
          </div>
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
