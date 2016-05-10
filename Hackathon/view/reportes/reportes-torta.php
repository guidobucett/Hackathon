<?php 
$cuerpo="";
$datos="";
foreach ($rep as $r) {
  $valor="<tr>
          <td>$r->distrito</td>
          <td>$r->manzana</td>
          <td>$r->barrio</td>
          <td>$r->descripcion</td>
          <td>$r->cantidad</td>
         </tr>";  
  $cuerpo=$cuerpo.$valor;
 
 $datos.='["'.trim($r->descripcion).'", '.$r->cantidad.'],';

}

 ?>

<body class="">
<center>
    <div class="row">     
    <script type="text/javascript" src="resources/dist/jquery.min.js"></script>
<style type="text/css">
${demo.css}
        </style>
        <script type="text/javascript">
$(function () {
    $('#grafica').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'REPORTE DE TORTA'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Tipo de Usuario',
            data: [
                <?php 

                   echo "$datos";

                 ?>
            ]
        }]
    });
});


        </script>
    </head>
<script src="resources/Highcharts/js/highcharts.js"></script>
<script src="resources/Highcharts/js/modules/exporting.js"></script>

<div class="card-panel">
<div class="row">
<center>
<div class="card-panel" id="grafica" style="min-width: 310px; height: 400px; max-width: 600px; margin-top: 30px;" align="center"></div>
</center>
</div>
</div>



    </div>
</center>

<center>
   <div class="card-panel">
    <div class="row">
      <div class="col s12 m8 l12">
        <table id="data-table-simple" class="responsive-table display" cellspacing="0">
          <thead>
              <tr>
                  <th>Distrito</th>
                  <th>Manzana</th>
                  <th>Barrio</th>
                  <th>Descripcion</th>
                  <th>Cantidad</th>
              </tr>
          </thead>
          <tbody>
            <?php echo "$cuerpo"; ?>
          </tbody>
        </table>
      </div>
    </div>
   </div> 
</center>
</body>

</html>
