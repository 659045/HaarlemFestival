<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
    
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap');

    * {
        font-family: 'Lato', sans-serif;
        padding: 0px;
        margin: 0px;
        /* outline: 1px solid red; */
    }
</style>

<title><? echo $artist->get_name() ?></title>
<script src="https://cdn.tailwindcss.com"></script>

<?php
    include __DIR__ . '/../header.php';
    require_once __DIR__ . '/../../controllers/tourController.php';
    generateHeader('Dance', 'light');
?>

<body class="overflow-x-hidden bg-[#F7F7FB] flex flex-col items-center h-fit w-screen">
    <div class="lg:w-[1280px] md:w-[100vw] sm:w-[100vw] mt-[100px] mb-[100px] grid text-white" id="content-container">
        <button type="submit" class="w-[100px] h-[40px] mt-[20px] bg-[#42BFDD] text-white text-[20px] font-bold rounded-[10px] cursor-pointer" onclick="back()">Back</button>
        <div class="mt-[100px] grid grid-cols-2 " id="introSection">
            <img src="<? echo $artist->get_imagePath() ?>" class="w-[500px]">
            <div class="mt-[50px]">
                <h1 class="text-[36px] font-bold mt-[50px] font-[Orbitron]"><? echo $artist->get_name() ?></h1>
                <p class="text-xl w-[700px] mt-[20px] font-[Orbitron]"><? echo $artist->get_description() ?></p>
            </div>            
        </div>
        <h1 class="text-[36px] font-bold mt-[100px] font-[Orbitron]">Popular Songs</h1>
            <div class="mt-[30px] grid grid-cols-3 text-[24px] gap-[50px]">
                <h2 class="font-[Orbitron] bg-[#2D2D2D] p-[20px] pb-[50px] rounded-[10px]"><? echo $popularSongs[0] ?></h2>
                <h2 class="font-[Orbitron] bg-[#2D2D2D] p-[20px] pb-[50px] rounded-[10px]"><? echo $popularSongs[1] ?></h2>
                <h2 class="font-[Orbitron] bg-[#2D2D2D] p-[20px] pb-[50px] rounded-[10px]"><? echo $popularSongs[2] ?></h2>
            </div>
        
        <h1 class="text-[36px] font-bold mt-[100px] font-[Orbitron]">Planning</h1>
        <div class="grid grid-cols-8 mt-[50px] text-[24px] text-[#F7F7FB] ">
            <h2 class="pl-[3px] font-['Orbitron'] mb-[20px]">Date</h2>
            <h2 class="col-span-2 pl-[3px] font-['Orbitron'] mb-[20px]">Location</h2>
            <h2 class="col-span-2 pl-[3px] font-['Orbitron'] mb-[20px]">Session</h2>
            <h2 class="pl-[3px] font-['Orbitron'] mb-[20px]">Duration</h2>
            <h2 class="pl-[3px] font-['Orbitron'] mb-[20px]">Tickets</h2>
            <h2 class="pl-[3px] font-['Orbitron'] mb-[20px]">Price</h2>

            <?php $i = 0; foreach ($danceSessions as $session) {  $date = strtotime($session->get_date());?>

                <h2 class="outline outline-1 outline-white p-[10px] font-['Orbitron']"><?php echo date('D, M. j H:i', $date);?></h2>
                <h2 class="col-span-2 outline outline-1 outline-white p-[10px] font-['Orbitron']"><?php echo $venues[$i++]->get_name() ?></h2>
                <h2 class="col-span-2 outline outline-1 outline-white p-[10px] font-['Orbitron']"><?php echo $session->get_session(); ?></h2>
                <h2 class="outline outline-1 outline-white p-[10px] font-['Orbitron']"><?php echo ($session->get_duration() / 60); ?>hours</h2>
                <h2 class="outline outline-1 outline-white p-[10px] font-['Orbitron']"><?php echo $session->get_ticketsAmount(); ?></h2>
                <h2 class="outline outline-1 outline-white p-[10px] font-['Orbitron']">€<?php echo $session->get_price(); ?></h2>
            <?php } ?>  
           
        </div>

        <button class="mt-[100px] w-[200px] h-[50px] text-white outline outline-3 white justify-self-end font-[Orbitron]" onclick="buy()">Buy Tickets</button>
    </div>
    </div>
</body>

<script>
    function back() {
        window.location.href = "/dance";
    }

    function buy() {
        window.location.href = "/danceTicket";
    }
</script>

<?php
    include __DIR__ . '/../danceFooter.php';
?>