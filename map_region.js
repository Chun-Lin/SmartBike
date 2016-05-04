// This example adds a user-editable rectangle to the map.
// When the user changes the bounds of the rectangle,
// an info window pops up displaying the new bounds.

var ne;
var sw;
var longitude_east;
var longitude_west;
var latitude_north;
var latitude_south;
var rectangle;
var map;
var infoWindow;



function reload(){
    
}
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 24.795855137078707,
            lng: 120.99224170669913
        },
        zoom: 17
    });

    var bounds = {
        north: 24.7959,
        south: 24.7958,
        east: 120.9923,
        west: 120.9922
    };

    // Define the rectangle and set its editable property to true.
    rectangle = new google.maps.Rectangle({
        bounds: bounds,
        editable: true,
        draggable: true
    });

    rectangle.setMap(map);

    // Add an event listener on the rectangle.
    rectangle.addListener('bounds_changed', showNewRect);

    // Define an info window on the map.
    infoWindow = new google.maps.InfoWindow();

    //document.getElementById("button").addEventListener("click", to_php);
}
// Show the new coordinates for the rectangle in an info window.

/** @this {google.maps.Rectangle} */
function showNewRect(event) {
    ne = rectangle.getBounds().getNorthEast();
    sw = rectangle.getBounds().getSouthWest();

    var contentString = '<b>Rectangle moved.</b><br>' +
        'New north-east corner: ' + ne.lat() + ', ' + ne.lng() + '<br>' +
        'New south-west corner: ' + sw.lat() + ', ' + sw.lng();

    longitude_east = ne.lng().toString();
    longitude_west = sw.lng().toString();
    latitude_north = ne.lat().toString();
    latitude_south = sw.lat().toString();

    $("#longitude_east").val(longitude_east);
    $("#longitude_west").val(longitude_west);
    $("#latitude_north").val(latitude_north);
    $("#latitude_south").val(latitude_south);
    /*alert(longitude_east);*/
    /*
    window.location.href = "mysql.php?longitude_east=" + longitude_east + "&longitude_west=" + longitude_west + "&latitude_north=" + latitude_north + "&latitude_south=" + latitude_south;
    */

    // Set the info window's content and position.
    //infoWindow.setContent(contentString);
    infoWindow.setPosition(ne);

    //infoWindow.open(map);
}

