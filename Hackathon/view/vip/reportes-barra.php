<?php 
$cuerpo="";

foreach ($rep as $r) {
  $valor="<tr>
          <td>$r->distrito</td>
          <td>$r->manzana</td>
          <td>$r->barrio</td>
          <td>$r->descripcion</td>
          <td>$r->cantidad</td>
         </tr>";  
  $cuerpo=$cuerpo.$valor;
}

 ?>

<body class="">
<center>
    <div class="row">     

        <script type="text/javascript" src="resources/dist/jquery.min.js"></script>
        <style type="text/css">
#container {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
        </style>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'REPORTES EN BARRAS'
        },
        subtitle: {
            text: 'THE LEYENDS'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories:[

            <?php 

                    foreach ($rep as $r) {

                 ?>
                ['<?php echo trim($r->descripcion); ?>'],

                <?php 

                }
             ?>

            ]
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: '<?php echo $tipo; ?>',
            data: [

            <?php 


                    foreach ($rep as $r) {

                 ?>

                [<?php echo $r->cantidad; ?>],
            <?php 

                }
             ?>

            ]
        }]
    });
});
        </script>
    </head>
<script src="resources/Highcharts/js/highcharts.js"></script>
<script src="resources/Highcharts/js/highcharts-3d.js"></script>
<script src="resources/Highcharts/js/modules/exporting.js"></script>

<div id="container" style="height: 400px; margin-top: 80px;"></div>
      
    </div>
</center>
<center>
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
</center>
</body>

</html>
