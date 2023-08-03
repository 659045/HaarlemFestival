<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    * {
        font-family: 'Lato', sans-serif;
        padding: 0px;
        margin: 0px;
        /* outline: 1px solid red; */
    }
</style>

<title><? echo $restaurant->get_name() ?></title>
<script src="https://cdn.tailwindcss.com"></script>

<?php
    include __DIR__ . '/../header.php';
    require_once __DIR__ . '/../../controllers/foodController.php';
    generateHeader('Dnace', 'dark');
?>

<body class="overflow-x-hidden bg-[#F7F7FB] flex flex-col items-center h-fit w-screen">  
    <div class="lg:w-[1280px] md:w-[100vw] sm:w-[100vw] mt-[100px] mb-[100px] grid" id="content-container">
        <button type="submit" class="w-[100px] h-[40px] mt-[20px] bg-[#42BFDD] text-white text-[20px] font-bold rounded-[10px] cursor-pointer" onclick="back()">Back</button>
        <div class="grid grid-cols-2 mt-[50px]">
            <div class="flex flex-row">
                <h1 class="text-3xl font-bold"><? echo $restaurant->get_name() ?></h1>
            </div>
            <button type="submit" class="w-[200px] h-[40px]  bg-[#42BFDD] text-white text-[20px] font-bold rounded-[10px] cursor-pointer justify-self-end" onclick="reserve()">Make reservation</button>
        </div>
        <div class="flex justify-items-start pb-[10px]">
            <img class="w-[115px] h-[25px]" src="/img/4.7Rating.png">
            <p class="text-[20px] font-medium pl-[10px]"><? echo $restaurant->get_stars() ?></p>
            <p class="text-[20px] text-[#FC5B84] font-medium pl-[10px]"><? echo $restaurant->get_category() ?></p>
        </div>
        <p class="text-xl w-[1000px] mt-[50px]"><? echo $restaurant->get_description() ?></p>
        <img class="w-[1280px] h-[400px] mt-[50px] rounded-[10px]" src="<? echo $imagePaths[4] ?>">
        <div class="grid grid-cols-3 grid-rows-2 gap-[50px] mt-[50px]">
            <img class="h-[300px] rounded-[10px]" src="<? echo $imagePaths[5] ?>">
            <img class="row-span-2 h-[650px] rounded-[10px]" src="<? echo $imagePaths[7] ?>">
            <img class="row-span-2 h-[650px] rounded-[10px]" src="<? echo $imagePaths[8] ?>">
            <img class="h-[300px] rounded-[10px]" src="<? echo $imagePaths[6] ?>">
        </div>
        <button type="submit" class="w-[200px] h-[40px]  bg-[#42BFDD] text-white text-[20px] font-bold rounded-[10px] cursor-pointer justify-self-end mt-[50px]" onclick="reserve()">Make reservation</button>
        <p class="text-l w-[200px] text-gray-700 mt-[10px] justify-self-end">** €10,- deposit pp. and mandatory reservation. Deposit will be deducted upon payment.**</p>

        <div class="bg-[#42BFDD] rounded-[10px] w-[900px] h-[300px]" id="schedule">
            <h1 class="ml-[20px] pt-[20px] text-3xl text-white">Schedule</h2>              
            <div class="grid grid-cols-4 mt-[20px] p-[20px] text-white outline outline-white text-xl">
                <p class="ml-[20px]">Session</p>
                <p>Time</p>
                <p>Adult Price</p>
                <p>Kids Price</p>

                <div class="col-span-1">
                    <?php foreach ($restaurantSessions as $index => $session) { ?>
                    <p class="ml-[20px]"><?php echo 'Session ' . ($index+1); ?></p>
                    <?php } ?>
                </div>
                <div class="col-span-1">
                    <?php foreach ($restaurantSessions as $session) {
                        $startTime = strtotime($session->get_session_startTime());
                        $endTime = strtotime($session->get_session_endTime());
                    ?>
                        <p><?php echo date('H:i', $startTime); ?>-<?php echo date('H:i', $endTime); ?></p>
                    <?php } ?>
                </div>
                <div class="col-span-1">
                    <?php foreach ($restaurantSessions as $session) { ?>
                        <p>€<?php echo $session->get_adult_Price(); ?></p>
                    <?php } ?>
                </div>
                <div class="col-span-1">
                <?php foreach ($restaurantSessions as $session) { ?>
                        <p>€<?php echo $session->get_kids_Price(); ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="bg-[#42BFDD] rounded-[10px] p-[10px] text-white w-[300px] mt-[100px]" id="contanct">
            <h1 class="text-3xl font-bold">Contact Us</h1>
            <h2 class="text-[24px] mt-[10px]"><? echo $restaurant->get_address() ?></h2>    
            <p class="text-xl mt-[10px] mt-[10px]">Tel: <? echo $restaurant->get_phone_number() ?></p>
        </div>


    </div>
</body>

<script>
    function back() {
        window.location.href = "/food";
    }
    function reserve() {
        window.location.href = "/yummieTicket";
    }
</script>

<?php
    include __DIR__ . '/../footer.php';
?>