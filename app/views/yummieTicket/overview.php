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
    generateHeader('ReservationOverview', 'dark');
?>

<body class="overflow-x-hidden bg-[#F7F7FB] flex flex-col items-center h-fit w-screen">  
    <div class="lg:w-[1280px] md:w-[100vw] sm:w-[100vw] mt-[100px] mb-[100px] grid justify-center" id="content-container">
        <h1 class="text-4xl text-center font-bold text-slate-800 mt-10">Reservation Overview</h1>

        <div class="w-[500px] bg-white p-2 rounded-md grid lg:grid-cols-2 lg:grid-rows-2 md:grid-cols-1 text-left relative gap-4 text-center mt-10">
            <h2>Restaurant</h2>
            <h2><? echo $restaurantName ?></h2>
            <h2>Date</h2>
            <h2><? echo $date ?></h2>
            <h2>Time</h2>
            <h2><? echo $startTime . ' - ' . $endTime ?></h2>
            <h2>Adults</h2>
            <h2><? echo $adults ?></h2>
            <h2>Kids</h2>
            <h2><? echo $kids ?></h2>
            <h2 class="col-span-2 text-center mt-5">Comment</h2>
            <h2><? echo $comment ?></h2>
        </div>
        <div class="flex justify-center">
            <button id="checkoutButton" class="m-2 py-2 px-8 rounded-md text-[#F7F7FB] bg-slate-800 w-fit mt-10" onclick="reserve()">Make New Reservation</button>
            <button id="checkoutButton" class="m-2 py-2 px-8 rounded-md text-[#F7F7FB] bg-slate-800 w-fit mt-10" onclick="checkout()">Go To Shopping Cart</button>
        </div>
    </div>
</body>

<?php
    include __DIR__ . '/../footer.php';
?>

<script>
    function reserve() {
        window.location.href = "http://localhost/yummieTicket";
    }

    function checkout() {
        window.location.href = "http://localhost/shoppingCart";
    }
</script>

<style>
    h2 {
        font-size: 20px;
        text-align: start;
    }
</style>