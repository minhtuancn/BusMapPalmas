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
var batches = []; // pontos intermediários para a rota
var points_id = [];
var indexPts = 0;

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
    clearOverlays();
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
            //calcula Rota
            // pega origem e destino da rota
            var start = new google.maps.LatLng(data.latLngStart.lat, data.latLngStart.lng);
            var end = new google.maps.LatLng(data.latLngEnd.lat, data.latLngEnd.lng);
        // var waypts = null; // aqui vão os trechos das rotas
            
            
        // var myWayPoints = <recebe os pontos calculados no algoritmo de busca>
        // colocar ponto inicial e final na sub-rota
        // count: contar tamanho do objeto json trazido do php
        // walkAway8Points(myWayPoints, count)
        // calcRoute();
        }
    });
}

// pega rota do ônibus 
function getRoute(idbus) {
    $('#processing').show();
    
    $.ajax({
        type: "POST",
        url: $('#base-path').val() + '/routes/getRoute',
        async: true,
        data: {
            idbus: idbus
        },
        dataType: "json",
        success: function(data) {
            var count = 0;
            
            $.each(data.points, function(index, array) {
                count++;
            });
            walkAway8Points(data.points, count);
            calcRoute();
            
            $('#processing').hide();
        }
    });    
}

// mostra rota do ônibus "burlando" o máximo de waypoints da API
function calcRoute() {
    var combinedResults;
    var directionsResultsReturned = 0;
        
    for (var k = 0; k < batches.length; k++) {
        var lastIndex = batches[k].length - 1; 
        var start = batches[k][0].location;
        var end = batches[k][lastIndex].location;   // um ônibus sai e volta para o mesmo ponto

        // trim first and last entry from array
        var waypts = [];
        waypts = batches[k];
        waypts.splice(0, 1);
        waypts.splice(waypts.length - 1, 1);
        
        var request = {
            origin: start,
            destination: end,
            waypoints: waypts,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function (result, status) {
            
            if (status == google.maps.DirectionsStatus.OK) {
                if (directionsResultsReturned == 0) { // first bunch of results in. new up the combinedResults object
                    combinedResults = result;
                    directionsResultsReturned++;
                } else {
                    // only building up legs, overview_path, and bounds in my consolidated object. This is not a complete
                    // directionResults object, but enough to draw a path on the map, which is all I need
                    combinedResults.routes[0].legs = combinedResults.routes[0].legs.concat(result.routes[0].legs);
                    combinedResults.routes[0].overview_path = combinedResults.routes[0].overview_path.concat(result.routes[0].overview_path);

                    combinedResults.routes[0].bounds = combinedResults.routes[0].bounds.extend(result.routes[0].bounds.getNorthEast());
                    combinedResults.routes[0].bounds = combinedResults.routes[0].bounds.extend(result.routes[0].bounds.getSouthWest());
                    directionsResultsReturned++;
                }
                if (directionsResultsReturned == batches.length) { // we've received all the results. put to map
                    directionsDisplay.setOptions({
                        suppressMarkers: true 
                    });
                    directionsDisplay.setDirections(combinedResults);
                }
            }
        });
    }
}

// "burlando" a API do Google
function walkAway8Points(myWayPoints, count) {
    var itemsPerBatch = 10; // google API max - 1 start, 1 stop, and 8 waypoints
    var itemsCounter = 0;
    var wayptsExist = count > 0;
    batches = [];
    
    while (wayptsExist) {
        var subBatch = [];
        var subitemsCounter = 0;
        
        for (var j = itemsCounter; j < count; j++) {            
            subitemsCounter++;
            
            subBatch.push({
                location: new google.maps.LatLng(myWayPoints[j].latitude, myWayPoints[j].longitude),
                stopover: false
            });
            
            if (subitemsCounter == itemsPerBatch)
                break;
        }

        itemsCounter += subitemsCounter;
        batches.push(subBatch);
        wayptsExist = itemsCounter < count;
        // If it runs again there are still points. Minus 1 before continuing to 
        // start up with end of previous tour leg
        itemsCounter--;
    }
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
        
        $('#latitude').val(marker.getPosition().$a);
        $('#longitude').val(marker.getPosition().ab);
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
            for(var i = 0; i < data.latlng.length; i++) {
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

// Removes the overlays from the map, but keeps them in the array
function clearOverlays() {
    if (markerArray) {
        for (i in markerArray) {
            markerArray[i].setMap(null);
        }
    }
    
    directionsDisplay.setDirections({
        routes: []
    });
}

// Shows any overlays currently in the array
function showOverlays() {
    if (markerArray) {
        for (i in markerArray) {
            markerArray[i].setMap(map);
        }
    }
}

// salva ponto da rota instântaneo
function saveInstant(idbus, idpoint) {
    $('#processing').show();
    
    $.ajax({
        type: "POST",
        url: $('#base-path').val()+'/routes/insert',
        data: {
            idbus: idbus,
            idpoint: idpoint
        },
        success: function(data) {
            if(data.success == true) {
                $('#processing').hide();
                $("#gritter-item-success").html('Salvo com sucesso!');
                $("#gritter-item-success").slideDown(300).delay(5500).fadeOut(2000);
            } else {
                $('#processing').hide();
                $("#gritter-item-success").html('Falha ao salvar!');
                $("#gritter-item-success").slideDown(300).delay(5500).fadeOut(2000);
            }
        }
    });
}

// calcula a distancia  entre todos os pontos de uma rota
function calcDistFromRoute(idbus) {
    
    $.ajax({
        type: "POST",
        data: {
            idbus: idbus
        },
        url: $('#base-path').val()+'/routes/getRoute',
        dataType: "json",
        success: function(data) {
            
            if(data.success == true) {
                
                var array_points = data.points;
                $('#processing').show();

                for( var i = 0; i < array_points.length - 1; i++ ) {
                    
                    points_id.push({
                        point1: array_points[i].idpoint, 
                        point2: array_points[i+1].idpoint
                    });
                        
                    var service = new google.maps.DistanceMatrixService();
                    service.getDistanceMatrix(
                    {
                        origins: [ new google.maps.LatLng(array_points[i].latitude, array_points[i].longitude) ],
                        destinations: [ new google.maps.LatLng(array_points[i+1].latitude, array_points[i+1].longitude) ],
                        travelMode: google.maps.TravelMode.DRIVING,
                        avoidHighways: false,
                        avoidTolls: false
                    }, callbackCalcRoute);
                }
                $('#processing').hide();
            }
        }
    });
}

//  callback para receber o resultado do cálculo das distâncias com DirectionMatrix
function callbackCalcRoute(response, status) {
    if (status != google.maps.DistanceMatrixStatus.OK) {
        alert('Error was: ' + status);
    } else {
        var origins = response.originAddresses;
        var destinations = response.destinationAddresses;

        var results = response.rows[0].elements;
        saveConnectionPoints(points_id[indexPts].point1, points_id[indexPts].point2, results[0].distance.text);
        indexPts++;
    }
}

// salva as distãncias no BD
function saveConnectionPoints(point1, point2, distance) {
    
    $.ajax({
        type: "POST",
        url: $('#base-path').val()+'/routes/saveConnectionPoints',
        data: {
            point1: point1,
            point2: point2,
            distance: distance
        },
        success: function(data) {      
            if(data.result == true)
                $("#gritter-item-success").slideDown(300).delay(5500).fadeOut(2000);
        }
    });
    
}