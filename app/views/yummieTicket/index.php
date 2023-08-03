<?php
    use Ramsey\Uuid\Uuid;

    $uuid = Uuid::uuid4();
    $uuid = $uuid->toString();
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

<title>Yummie Reservation</title>
<script src="https://cdn.tailwindcss.com"></script>

<?php
    include __DIR__ . '/../header.php';
    require_once __DIR__ . '/../../controllers/tourController.php';
    generateHeader('Reservation', 'dark');
?>

<body class="overflow-x-hidden bg-[#F7F7FB] flex flex-col items-center h-fit w-screen">  
    <div class="lg:w-[1280px] md:w-[100vw] sm:w-[100vw] mt-[100px] mb-[100px] grid" id="content-container">
        <h1 class="text-[36px] font-bold mt-[50px]">Yummie Reservation</h1>
        <div class="grid grid-cols-2">    
            <div class="w-[50vw] mt-10 mb-10">
                <h2 class="text-[24px] font-bold mt-[50px]">Select a restaurant</h2>
                <select id="restaurants" required>
                </select>
            </div>
      
            <div id="dateContainer" class="w-[50vw] mt-10 mb-10" hidden>
                <h2 class="text-[24px] font-bold mt-[50px]">Select a date</h2>
                <select id="dates" required></select>
            </div>
        </div>

        <div class="grid grid-cols-2">
            <div id="sessionContainer" class="w-[50vw] mt-10 mb-10" hidden>
                <h2 class="text-[24px] font-bold mt-[50px]">Select a session</h2>
                <select id="sessionSelect" required></select>
            </div>

            <div class="grid grid-cols-2">
                <div id="adultContainer" class="w-[50vw] mt-10 mb-10" hidden>
                    <h2 class="text-[24px] font-bold mt-[50px]">Number of Adults</h2>
                    <input type="number" id="adultsInput" min="0" value="0" required>
                </div>

                <div id="childrenContainer" class="w-[50vw] mt-10 mb-10" hidden>
                    <h2 class="text-[24px] font-bold mt-[50px]">Number of Kids</h2>
                    <input type="number" id="kidsInput" min="0" value="0" required>
                </div>
            </div>
        </div>

        <div id="commentContainer" hidden>
            <h2 class="text-[24px] font-bold mt-[50px]">Comments/Allergies</h2>
            <textarea id="commentInput" class="w-[65vw] h-[100px] mb-10" placeholder="Comments/Allergies"></textarea>
        </div>  

        <div class="flex justify-center">
            <button id="proceedButton" class="m-2 py-2 px-8 rounded-md text-[#F7F7FB] text-[18px] bg-slate-800 w-fit mt-10">Make Reservation</button>
        </div>
    </div>
</body>

<?php
    include __DIR__ . '/../footer.php';
?>

<script>
    loadRestaurantsOptions();

    restaurants.addEventListener('change', function() {
    const selectedRestaurant = restaurants.value;
        
        if (selectedRestaurant) {
            dateContainer.removeAttribute('hidden');
            clearSelect(sessionSelect);
            clearSelect(dates);
            loadDates();
            loadSessions();
        } else {
            dateContainer.setAttribute('hidden', 'true');
        }
    });

    dates.addEventListener('change', function() {
    const selectedDate = dates.value;
        if (selectedDate) {
            sessionContainer.removeAttribute('hidden');
            adultContainer.removeAttribute('hidden');
            childrenContainer.removeAttribute('hidden');
            commentContainer.removeAttribute('hidden');
            clearSelect(sessionSelect);
            loadSessions();
        } else {
            sessionContainer.setAttribute('hidden', 'true');
            adultContainer.setAttribute('hidden', 'true');
            childrenContainer.setAttribute('hidden', 'true');
            commentContainer.setAttribute('hidden', 'true');
        }
    });

    proceedButton.addEventListener('click', function() {
        createReservation();
    });


    function loadRestaurantsOptions() {
        addDefaultOption(restaurants, 'Select a restaurant');

        fetch('http://localhost/api/restaurants')
        .then((response) => response.json())
        .then((data) => {      
            data.forEach(restaurant => {
                const option = document.createElement('option');
                option.value = restaurant.id;
                option.innerText = restaurant.name;
                restaurants.appendChild(option);
            });
        })
        .catch((error) => {
            console.log(error);
        });
    }

    function loadDates() {
        addDefaultOption(dates, 'Select a date');

        fetch('http://localhost/api/restaurantSessions')
        .then((response) => response.json())
        .then((data) => {
            sessions = [];
            data.forEach((session) => {
                if (session.restaurant_id != restaurants.value) {
                    return;
                }

                if (sessions.includes(session.session_date)) {
                    return;
                }

                sessions.push(session.session_date);
                const option = document.createElement('option');
                option.innerHTML = session.session_date;
                dates.appendChild(option);
            });
        })
        .catch((error) => {
            console.log(error);
        });
    }

    function loadSessions() {
        addDefaultOption(sessionSelect, 'Select a session');

        fetch('http://localhost/api/restaurantSessions')
        .then((response) => response.json())
        .then((data) => {
            data.forEach((session) => {
                if (session.restaurant_id != restaurants.value) {
                    return;
                }

                if (session.session_date != dates.value) {
                    return;
                }

                const option = document.createElement('option');
                option.value = session.session_startTime + '-' + session.session_endTime;
                option.innerHTML = session.session_startTime.substring(0, 5) + ' - ' + session.session_endTime.substring(0, 5);
                sessionSelect.appendChild(option);
            });
        })
        .catch((error) => {
            console.log(error);
        });
    }

    function getSelectedSession() {
        return new Promise((resolve, reject) => {
            fetch('http://localhost/api/restaurantSessions')
            .then((response) => response.json())
            .then((data) => {
                const selectedSession = data.find((session) => {
                    return (
                        session.restaurant_id == restaurants.value &&
                        session.session_date == dates.value &&
                        session.session_startTime + '-' + session.session_endTime == sessionSelect.value
                    );
                });

                console.log(selectedSession);
                resolve(selectedSession);
                return selectedSession;
            })
            .catch((error) => {
                console.log(error);
            });
        });
    }

    function createReservation() {
        var uuid = <?php echo json_encode($uuid); ?>;

        getSelectedSession()
        .then((selectedSession) => {
            const reservation = {
                post_type: 'insert',
                uuid: uuid,
                session_id: selectedSession.id,
                status: 1,
                adults: parseInt(adultsInput.value),
                kids: parseInt(kidsInput.value),
                comment: commentInput.value
            };

            console.log(reservation);

            for (let i = 0; i < reservation.adults; i++) {
                createYummieTicket(selectedSession, selectedSession.adult_Price);
            }

            for (let i = 0; i < reservation.kids; i++) {
                createYummieTicket(selectedSession, selectedSession.kids_Price);
            }

            fetch('http://localhost/api/reservations', {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                'Content-Type': 'application/json',
                },
                redirect: 'follow',
                referrerPolicy: 'no-referrer',
                body: JSON.stringify(reservation),
            })
            .then((data) => {
                window.location.href = 'http://localhost/yummieTicket/overview?id=' + uuid;
            })
        })
        .catch((error) => {
            console.log(error);  
        });
    }

    function createYummieTicket(selectedSession, ticketPrice){

        var user_id = <?php echo json_encode($user_id); ?>;
        console.log(user_id);

        const yummieTicket = {
            post_type: 'insert',
            price: ticketPrice,
            event_id: selectedSession.id,
            user_id: user_id,
            isAllAccess: 0
        };
        console.log(yummieTicket);
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
            body: JSON.stringify(yummieTicket),
        })
    }

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