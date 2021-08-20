// Initialize and add the map
function initMap() {
    // The location of Uluru
    const  ekvh = { lat: 51.073836, lng: -2.1729 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: ekvh,
        mapTypeId: 'hybrid',
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
        position: ekvh,
        map: map,

    });
}