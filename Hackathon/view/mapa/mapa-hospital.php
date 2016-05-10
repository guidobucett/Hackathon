 
<div id="map" class="map-container" style="margin: 10px;"></div>

<script>




    function initMap() {

        var uluru = {lat: -17.78361, lng: -63.18212};
        var mapa = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: uluru
        });

<?php
$i = 0;
foreach ($rows as $h) {
    ?>


            var contentString = '<div id="content">' +
                    '<div id="bodyContent" >' +
                    '<p ></p>' +
                    '<p><?php echo utf8_decode($h->NombreRef); ?></p>' +
                    '<p><?php echo utf8_decode($h->DescripcionClasificacion); ?></p>' +
                    '</div>' +
                    '</div>';
    <?php
    echo" var company = new google.maps.LatLng($h->latitud, $h->longitud);
    var companyM$i = new google.maps.Marker({
    position: company,
    map: mapa,
    icon:'resources/images/markers/firstaid.png',    
    title:'$h->NombreRef',
    animation: google.maps.Animation.DROP,
  }); ";

    echo "var infowindow$i = new google.maps.InfoWindow({
    content: contentString
});";

    echo "google.maps.event.addListener(companyM$i, 'click', function() {
  infowindow$i.open(mapa,companyM$i);
  });";

    $i++;
    ?>
<?php } ?>

    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALddaybrgorglp2vtcbf5Mbhs5sWtLaNU&signed_in=true&libraries=drawing&callback=initMap"
        async defer>
</script>
