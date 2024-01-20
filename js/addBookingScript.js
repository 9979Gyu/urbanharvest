$(document).ready(function(){

    $retrievedGarden = null;
    $retrievedPlot = null;

    var map = L.map('map').setView([0, 0], 2); // Set the initial view

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    // Make an AJAX request to retrieve garden data
    $.ajax({
        url: '../garden/gardenProcess.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $retrievedGarden = data;
            // Iterate through the data and display it
            $.each(data, function(index, garden) {
                $('#gardenName').append('<option value="' + garden.gardenID + '">' + garden.name + '</option>');
            });
        },
        error: function(error) {
            console.log('Error fetching garden data:', error);
        }
    });

    function getPlot(gardenID, callback) {
        $.ajax({
            url: '../garden/getPlot.php',
            type: 'GET',
            data: { gardenID: gardenID },
            dataType: 'json',
            success: function(data) {
                $retrievedPlot = data;

                // Call the callback function with the retrieved data
                callback(data);
            },
            error: function(error) {
                callback(false); // Pass false to the callback to indicate an error
            }
        });
    }

    $("#gardenName").change(function() {
        var selectedValue = $(this).val();
        $.each($retrievedGarden, function(index, garden) {
            if (garden.gardenID === selectedValue) {
                $("textarea[name='gardenAddress']").val(garden.address);

                // Use the callback to get the retrievedPlot data
                getPlot(garden.gardenID, function(retrievedPlot) {

                    // Now you can use the retrievedPlot data
                    if (retrievedPlot !== false) {
                        $("input[name='plotNo']").val(retrievedPlot.plotID);
                    }
                    else{
                        $("input[name='plotNo']").val(null);
                    }
                });

                return false;
            } 
            else {
                $("textarea[name='gardenAddress']").val(null);
            }
        });

        if($("textarea[name='gardenAddress']").val() != ""){
            $address = $("textarea[name='gardenAddress']").val();
            updateMarkerFromAddress($address);
        }

    });

    $("button[name='submit']").click(function(event){
        // Validate input field
        $plot = $("input[name='plotNo'").val();
        $address = $("textarea[name='gardenAddress'").html();

        if($plot == "" && address == ""){
            $(".message").html("Sorry there is no available plot in this area")
            event.preventDefault();
        }

    });

    function updateMarkerFromAddress(address) {
        if (address.trim() !== "") {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    var newLocation = [parseFloat(data[0].lat), parseFloat(data[0].lon)];
                    updateMarker(newLocation);
                } 
                else {
                    console.error('No results found for the given address.');
                }
            })
            .catch(error => console.error('Error fetching data:', error));
        }
    }

    function updateMarker(location) {
        if (!marker) {
            marker = L.marker(location).addTo(map);
        } else {
            marker.setLatLng(location);
        }

        map.setView(location, 14); // Set the map view to the marker location
    }

});