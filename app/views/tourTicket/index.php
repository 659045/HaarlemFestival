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

<title>Tour Tickets</title>
<script src="https://cdn.tailwindcss.com"></script>

<?php
    include __DIR__ . '/../header.php';
    require_once __DIR__ . '/../../controllers/tourController.php';
    generateHeader('TourTickets', 'dark');
?>

<body class="overflow-x-hidden bg-[#F7F7FB] flex flex-col items-center h-fit w-screen">  
    <div class="lg:w-[1280px] md:w-[100vw] sm:w-[100vw] mt-[100px] mb-[100px] grid" id="content-container">
        <h1 class="text-[36px] font-bold mt-[50px]">Haarlem Tour</h1>
        <div class="grid grid-cols-2">    
            <div id="dateContainer" class="w-[50vw] mt-10 mb-10">
                <h2 class="text-[24px] font-bold mt-[50px]">Select a date</h2>
                <select id="dates" required></select>
            </div>

            <div id="timeContainer" class="w-[50vw] mt-10 mb-10">
                <h2 class="text-[24px] font-bold mt-[50px]">Select a time</h2>
                <select id="times" required>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2">    
            <div id="languageContainer" class="w-[50vw] mt-10 mb-10">
                <h2 class="text-[24px] font-bold mt-[50px]">Select a language</h2>
                <select id="languages" required>
                </select>
            </div>

            <div class="grid grid-cols-2">
                <div id="singleContainer" class="w-[50vw] mt-10 mb-10">
                    <h2 class="text-[24px] font-bold mt-[50px]">Single Ticket</h2>
                    <input type="number" id="singleInput" min="0" value="0" required>
                </div>

                <div id="familyContainer" class="w-[50vw] mt-10 mb-10">
                    <h2 class="text-[24px] font-bold mt-[50px]">Family Ticket (4 People)</h2>
                    <input type="number" id="familyInput" min="0" value="0" required>
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
    addDefaultOption(dates, 'Select a date');
    addDefaultOption(times, 'Select a time');
    addDefaultOption(languages, 'Select a language');

    loadSelects();

    function loadSelects() {


        fetch('http://localhost/api/tourSessions')
        .then(response => response.json())
        .then(data => {
            const addedDates = [];
            const addedTimes = [];
            const addedLanguages = [];

            data.forEach(session => {
                const sessionDate = session.date.split(' ')[0];
                const sessionTime = session.date.split(' ')[1];
                const sessionLanguage = session.language;
                if (!addedDates.includes(sessionDate)) {
                    const option = document.createElement('option');
                    option.value = sessionDate;
                    option.innerHTML = sessionDate;
                    dates.appendChild(option);

                    addedDates.push(sessionDate);
                }
                if (!addedTimes.includes(sessionTime)) {
                    const option = document.createElement('option');
                    option.value = sessionTime;
                    option.innerHTML = sessionTime;
                    times.appendChild(option);

                    addedTimes.push(sessionTime);
                }
                if (!addedLanguages.includes(sessionLanguage)) {
                    const option = document.createElement('option');
                    option.value = sessionLanguage;
                    option.innerHTML = sessionLanguage;
                    languages.appendChild(option);

                    addedLanguages.push(sessionLanguage);
                }
            });
        });
    }

    function getSelectedSession() {
        const selectedDate = dates.value;
        const selectedTime = times.value;
        const selectedLanguage = languages.value;

        if (selectedDate && selectedTime && selectedLanguage) {
            return fetch(`http://localhost/api/tourSessions`)
                .then(response => response.json())
                .then(data => {
                    const selectedSession = data.find(session => {
                        const sessionDate = session.date.split(' ')[0];
                        const sessionTime = session.date.split(' ')[1];
                        const sessionLanguage = session.language;
                        return sessionDate === selectedDate && sessionTime === selectedTime && sessionLanguage === selectedLanguage;
                    });

                    return selectedSession;
                });
        } else {
            return null;
        }
    }

    function createTicket(ticketPrice){
        var user_id = <?php echo json_encode($user_id); ?>;
        console.log(user_id);

        getSelectedSession()
        .then((selectedSession) => {
            const ticket = {
                post_type: 'insert',
                price: ticketPrice,
                event_id: selectedSession.id,
                user_id: user_id,
                isAllAccess: 0
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
                createTicket(selectedSession.price);
            }
            for (let i = 0; i < familyInput.value; i++) {
                createTicket(selectedSession.family_Price);
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