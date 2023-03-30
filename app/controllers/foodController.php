<?php
    require_once __DIR__ . '/controller.php';
    class FoodController extends Controller{

        public function index(){
            $this->echoPage("food");
        }

        public function detailPage(){
            $this->displayView($this);
        }
    }
?>

<body class="overflow-x-hidden bg-[#F7F7FB] flex flex-col items-center h-fit w-screen"></body>