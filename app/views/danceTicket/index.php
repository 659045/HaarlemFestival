<?php
$user_id = $_SESSION['TEMP_ID'];
if (isset($_SESSION['USER_ID']))
    $user_id = $_SESSION['USER_ID'];
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    * {
        font-family: 'Lato', sans-serif;
        padding: 0px;
        margin: 0px;
        /* outline: 1px solid red; */
    }
</style>

<title>Dance Tickets</title>
<script src="https://cdn.tailwindcss.com"></script>

<?php
    include __DIR__ . '/../header.php';
    require_once __DIR__ . '/../../controllers/tourController.php';
    generateHeader('DanceTickets', 'dark');
?>

<body class="overflow-x-hidden bg-[#F7F7FB] flex flex-col items-center h-fit w-screen">  
    <div class="lg:w-[1280px] md:w-[100vw] sm:w-[100vw] mt-[100px] mb-[100px] grid" id="content-container">
        <h1 class="text-[36px] font-bold mt-[50px]">Dance</h1>
        <div class="grid grid-cols-2">    
            <div id="artistContainer" class="w-[50vw] mt-10 mb-10">
                <h2 class="text-[24px] font-bold mt-[50px]">Select a artist</h2>
                <select id="artists" required></select>
            </div>

            <div id="locationContainer" class="w-[50vw] mt-10 mb-10" hidden>
                <h2 class="text-[24px] font-bold mt-[50px]">Select a location</h2>
                <select id="locations" required>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2">    
            <div id="dateContainer" class="w-[50vw] mt-10 mb-10" hidden>
                <h2 class="text-[24px] font-bold mt-[50px]">Date</h2>
                <h2 class="text-[20px]" id=dateLabel></h2>
            </div>

            <div class="grid grid-cols-2">
                <div id="singleContainer" class="w-[50vw] mt-10 mb-10" hidden>
                    <h2 class="text-[24px] font-bold mt-[50px]">Single Ticket</h2>
                    <input type="number" id="singleInput" min="0" value="0" required>
                </div>

                <div id="allAccessContainer" class="w-[50vw] mt-10 mb-10" hidden>
                    <h2 class="text-[24px] font-bold mt-[50px]">All Access Pass</h2>
                    <input type="number" id="allAccessInput" min="0" value="0" required>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <button id="proceedButton" class="m-2 py-2 px-8 rounded-md text-[#F7F7FB] text-[18px] bg-slate-800 w-fit mt-10" onclick="getSelectedSession">Add Ticket</button>
        </div>
    </div>
</body>

<?php
    include __DIR__ . '/../footer.php';
?>

<script>
    addDefaultOption(artists, 'Select a artist');
    addDefaultOption(locations, 'Select a location');
    loadArtists();

    artists.addEventListener('change', function() {
        const selectedArtist = artists.value;
        
        if (selectedArtist) {
            locationContainer.removeAttribute('hidden');
            clearSelect(locations);
            addDefaultOption(locations, 'Select a location');
            loadLocations();
        } else {
            locationContainer.setAttribute('hidden', true);
        }
    });

    locations.addEventListener('change', function() {
        const selectedLocation = locations.value;
        if (selectedLocation) {
            dateContainer.removeAttribute('hidden');
            singleContainer.removeAttribute('hidden');
            allAccessContainer.removeAttribute('hidden');
            loadSessions();
        } else {
            dateContainer.setAttribute('hidden', true);
            singleContainer.setAttribute('hidden', true);
            allAccessContainer.setAttribute('hidden', true);
        }
    });

    function loadArtists() {
        fetch(`http://localhost/api/artists`)
            .then(response => response.json())
            .then(data => {
                data.forEach(artist => {
                    const option = document.createElement('option');
                    option.value = artist.id;
                    option.innerText = artist.name;
                    artists.appendChild(option);
                });
            });
    }

    function loadLocations() {
        fetch(`http://localhost/api/danceSessions`)
        .then(response => response.json())
        .then(data => {
            data.forEach(session => {
                if (session.artist_id != artists.value) {
                    return;
                }
                                     
                fetch(`http://localhost/api/danceLocations`)
                .then(response => response.json())
                .then(venue => {
                    for (let i = 0; i < venue.length; i++) {
                        if (venue[i].id == session.venue) {
                            const locationOption = document.createElement('option');
                            locationOption.value = session.venue;
                            locationOption.innerText = venue[i].name;
                            locations.appendChild(locationOption);
                        }
                    }
                });
            });
        });
    }

    function loadSessions(){
        fetch(`http://localhost/api/danceSessions`)
        .then(response => response.json())
        .then(data => {
            data.forEach(session => {
                if (session.artist_id != artists.value || session.venue != locations.value) {
                    return;
                }
                const sessionDate = new Date(session.date);
                const formattedDate = sessionDate.toLocaleString();

                dateLabel.innerText = formattedDate;
            });
        });
    }

    function getSelectedSession() {
        return fetch(`http://localhost/api/danceSessions`)
        .then(response => response.json())
        .then(data => {
            const selectedSession = data.find(session => session.artist_id == artists.value && session.venue == locations.value);
            return selectedSession;
        });
    }

    function createTicket(ticketPrice, isAllAccess){
        var user_id = <?php echo json_encode($user_id); ?>;
        console.log(user_id);

        getSelectedSession()
        .then((selectedSession) => {
            const ticket = {
                post_type: 'insert',
                price: ticketPrice,
                event_id: selectedSession.id,
                user_id: user_id,
                isAllAccess: isAllAccess,
            };

            console.log(ticket);
            fetch('http://localhost/api/tickets', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
            'Content-Type': 'application/json',
            },
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(ticket),
            }) 
        });
    }

    proceedButton.addEventListener('click', function() {
        getSelectedSession()
        .then((selectedSession) => {
            for (let i = 0; i < singleInput.value; i++) {
                createTicket(selectedSession.price, 0);
            }
            for (let i = 0; i < allAccessInput.value; i++) {
                createTicket(250, 1);
            }
        });
        
        setTimeout(function() {
            window.location.href = `http://localhost/shoppingCart`;
        }, 1000);
    });

    function addDefaultOption(selectElement, text) {
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.innerText = text;
        defaultOption.disabled = true;
        defaultOption.selected = true;

        selectElement.appendChild(defaultOption);
    }

    function clearSelect(selectElement) {
        while (selectElement.firstChild) {
            selectElement.removeChild(selectElement.firstChild);
        }
    }

</script>

<style>
    select {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 18px;
    }

    input {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 8px;
        font-size: 18px;
    }

    textarea {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 8px;
        font-size: 18px;
    }
</style>