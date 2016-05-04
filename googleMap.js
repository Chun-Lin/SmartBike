var map;
var mapMarker;

function initMap() {
    var latlng = new google.maps.LatLng(24.795855137078707, 120.99224170669913);
    var myOptions = {
        zoom: 17,
        center: latlng
    };
    currentMap = new google.maps.Map(document.getElementById("map"), myOptions);

    var bounds = {
        north: 24.800,
        south: 24.790,
        east: 120.997,
        west: 120.987
    };
    // Define a rectangle and set its editable property to true.
    var rectangle = new google.maps.Rectangle({
        bounds: bounds,
        editable: true
    });
    rectangle.setMap(currentMap);



// Clear all the click event of the map
google.maps.event.clearListeners(currentMap, "click");
// Register a click event to the map
google.maps.event.addListener(currentMap, "click", function(event) {
    // Clear marker if it already exists
    if (mapMarker) mapMarker.setMap(null);

    // Setting of marker
    var optionOfMarker = {
        position: event.latLng,
        map: currentMap,
        title: event.latLng.toString()
    };
    // Show marker in the place of mouse clicks
    mapMarker = new google.maps.Marker(optionOfMarker);
    mapMarker.setAnimation(google.maps.Animation.DROP);
    $("#longitude").val(optionOfMarker.position.lng());
    $("#latitude").val(optionOfMarker.position.lat());
});
}
