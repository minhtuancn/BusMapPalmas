/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author herinson
 */

// pontos inicial e final para traçar a rota
var map, startPoint, endPoint;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var points = [];    
var markerArray = [];

function initialize() {
    // coordenadas de Palmas: -10.18392,-48.33375
    // define componente que irá direcionar a rota e desenhá-la
    directionsDisplay = new google.maps.DirectionsRenderer();
    var palmas = new google.maps.LatLng(-10.18392, -48.33375);
    
    // opções do mapa
    var mapOptions = {
        scaleControl: true,
        center: palmas,
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    // coloca o mapa no elemento html
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    //google.maps.event.addDomListener(window, 'load', initialize);

    // 'desenha' o mapa utilizando os algoritmos da API
    // TODO: posteriormente utilizar vários pontos que darão o trageto ao pedestre
    directionsDisplay.setMap(map);
   
    // eventos do mouse no mapa
    google.maps.event.addListener(map, 'rightclick', function(event) {
        addMarker(event.latLng, null, null, null);
        
    });
    
    // adiciona pontos
    createMarkers();
}
    
function getStartEndLatLng(label1, label2) {
    $.ajax({
        type: "POST",
        url: $('#base-path').val() + '/point/getStartEndLatLng',
        async: false,
        data: {
            label1: label1,
            label2: label2
        },
        dataType: "json",
        success: function(data) {
            //console.log(data);
            //calcula Rota
            // pega origem e destino da rota
            var start = new google.maps.LatLng(data.latLngStart.lat, data.latLngStart.lng);
            var end = new google.maps.LatLng(data.latLngEnd.lat, data.latLngEnd.lng);
            var waypts = null;
            
            calcRoute(start, end, waypts);
        }
    });
}

// calcula rota    
// DEBUG: está sendo feito um teste para traçar uma rota em todos os pontos cadastrados
function calcRoute(start, end) {
    var waypts = [];
    
    //    for(var i = 0; i < 5; i++) {
    //        var latLng = new google.maps.LatLng(points[i]['latitude'],points[i]['longitude']);
    //        
    //        waypts.push({
    //            location: latLng,
    //            stopover: false
    //        });
    //    }
    
    var request = {
        origin:start,
        destination:end,
        waypoints:waypts,
        travelMode: google.maps.TravelMode.DRIVING
    };
    
    directionsService.route(request, function(result, status) {    
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(result);
        }
    });
}

// adicionar um marcador no mapa com sua posição, ícone, indetificação e observação
function addMarker(location, markerIcon, label, obs) {
    
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: markerIcon
    });
    marker.setDraggable(true);
    marker.setMap(map); 
    
    google.maps.event.addListener(marker, 'dblclick', function(event) {
        $('#new-point').dialog('open');
        
        $('#latitude').val(marker.getPosition().Ya);
        $('#longitude').val(marker.getPosition().Za);
    });
    
    var infoString = '<strong>Identificação</strong>: '+label+
    '<br /><strong>Observação</strong>: '+obs;

    var infowindow = new google.maps.InfoWindow({
        content: infoString
    });
        
    google.maps.event.addListener(marker, 'mouseover', function(event) {
        infowindow.open(map,marker);
    });
 
    google.maps.event.addListener(marker, 'mouseout', function(event) {
        infowindow.close();
    });
    
    markerArray.push(marker);
}

// traz da base de dados todas as coordenadas dos pontos de ônibus
function getMarkers() {
    $.ajax({
        type: "GET",
        url: $('#base-path').val()+'/point/getPoints',
        datatype: "json",
        async: false,
        success: function(data) {
            for(i = 0; i < data.latlng.length; i++) {
                var line = [];
                line['latitude'] = data.latlng[i].latitude;
                line['longitude'] = data.latlng[i].longitude;
                line['label'] = data.latlng[i].label;
                line['obs'] = data.latlng[i].obs;
                
                points.push(line);
            }
        }
    });
}

// cria os marcadores trazidos do banco (pontos de ônibus)
function createMarkers() {
    getMarkers();
    var blueIcon = $('#base-path').val() + '/images/blue-dot.png';
    
    markerOptions = {
        icon: blueIcon
    };
    for(var i = 0; i < points.length; i++) {
        var latlng = new google.maps.LatLng(points[i]['latitude'], points[i]['longitude']);
        addMarker(latlng, blueIcon, points[i]['label'], points[i]['obs']);
    }
}

// salva novo ponto no BD
function newPoint() {
    $.ajax({
        type: "POST",
        url: $('#base-path').val()+'/point/insert',
        data: {
            label: $('#label').val(),
            latitude: $('#latitude').val(),
            longitude: $('#longitude').val(),
            qnt_bus: $('#qnt_bus').val(),
            obs: $('#obs').val()
        },
        success: function(data) {
            if(data.success == true) {
                $('#div-message').addClass("div-message success");
                $('#div-message').html('Cadastrado com sucesso!');
                $('#div-message').show('slow');
                $('#div-message').slideUp(3000);
                $('#new-point').dialog("close");
                $('#reset-fields').click(function(){});
            } else {
                $('#div-message').addClass("div-message error");
                $('#div-message').html('Falha ao salvar!');
                $('#div-message').show('slow');
                $('#div-message').slideUp(3000);
                $('#new-point').close();
            }
        }
    });
}

function removePoint(marker) {
    marker.setMap(null);
}