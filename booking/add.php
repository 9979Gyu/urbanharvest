<!DOCTYPE html>
<html>
    <?php
        session_start();
    ?>
    <head>
        <title>Urban Harvest-Booking</title>
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/addBookingScript.js"></script>

        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        
        



        <!-- <script>
            function updateMap() {
                var location = document.getElementById('locationInput').value;
                var mapFrame = document.getElementById('mapFrame');
                mapFrame.src = "https://www.google.com/maps/embed/v1/place?key=&q=" + encodeURIComponent(location);
            }
        </script> -->
    </head>
    <body>
        <?php
            require("../head.php");
        ?>
        <section class="wrapper">
            <h1 class="title">Current Booking Details</h1>
            <article>
                <p class="message"></p>
            </article>
            <article class="mainContent">
                <form id="bookPlot" action="addCurrentBooking.php" method="post">
                    <table>
                        <tbody>
                            <tr>
                                <th colspan="2">Garden</th>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>
                                    <select id="gardenName" name="gardenName">
                                        <option value="none" selected>Please Select Garden Name</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Plot No:</th>
                                <td>
                                    <input type="text" name="plotNo" readonly required/>
                                </td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>
                                    <textarea name="gardenAddress" onchange="updateMarkerFromAddress(this.value)" readonly cols="30" rows="5" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>Your Location:</th>
                                <td>
                                    <div id="map" style="height: 300px;">
                                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15946.315112917162!2d102.26993133373348!3d2.309044353155428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e4951ed098ad%3A0xe3626f9c98cf5b70!2sTaman%20Desa%20Idaman%2C%2076100%20Durian%20Tunggal%2C%20Malacca!5e0!3m2!1sen!2smy!4v1705457761377!5m2!1sen!2smy" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Use Year (Maximum is 2):</th>
                                <td>
                                    <input type="radio" name="bookYear" value="1" checked/> 1
                                    <input type="radio" name="bookYear" value="2"/> 2
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="btnGroup">
                                        <button type="submit" name="submit" class="submit" id="addBtn">+ Add</button>
                                        <button type="reset" class="normal"><i class="fas fa-eraser"></i> Clear</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form> 
            </article>

        </section>
        <?php require("../foot.php"); ?>
        
        <!-- Leaflet initialization script -->
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            var map = L.map('map').setView([0, 0], 2); // Set the initial view

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker;

            function updateMarkerFromAddress(address) {
                console.log(address);
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            var newLocation = [data[0].lat, data[0].lon];
                            updateMarker(newLocation);
                        } else {
                            console.error('No results found for the given address.');
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

            function updateMarker(location) {
                if (!marker) {
                    marker = L.marker(location).addTo(map);
                } else {
                    marker.setLatLng(location);
                }

                map.setView(location, 14); // Set the map view to the marker location
            }
        </script>
    </body>
</html>