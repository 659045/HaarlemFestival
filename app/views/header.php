<?php

require_once __DIR__ . '/../services/pageService.php';
require_once __DIR__ . '/../models/page.php';
global $headerTextColourValue;
$headerTextColourValue = '#F7F7FB'; // white
global $unselected;
global $selected;
$unselected = '#F7F7FB'; //white
$selected = '#FC5B84'; // pink
global $colours;
$colours = array("yummie" => '', "tour" => '', "dance" => '', "login" => '', "pages" => '');

$service = new PageService();

function generateHeader(string $pageName, string $mode)
{
  global $unselected;
  global $selected;
  global $headerTextColourValue;
  switch ($mode) {
    case 'dark':
      $unselected = '#29334E';
      $selected = '#42BFDD';
      $headerTextColourValue = '#F7F7FB';
      break;
    case 'light':
      $unselected = '#F7F7FB';
      $selected = '#42BFDD';
      $headerTextColourValue = '#29334E';
      break;
    default:
      $unselected = '';
      $selected = '#42BFDD';
      break;
  }
  global $colours;
  $colours = pickColours($colours, $pageName);
  loadHTML();
}

function pickColours(mixed $colours, string $var)
{

  foreach ($colours as $key => $value) {
    if ($key == $var)
      $colours[$key] = $GLOBALS['selected'];
    else
      $colours[$key] = $GLOBALS['unselected'];
  }
  return $colours;
}

function loadHTML()
{
  echo "<body class=''>
  <div class='absolute top-0 w-[100vw] h-[100px] flex items-center justify-center pl-[50px] pr-[50px] z-[100]' id='header'>
    <div class='relative w-[1280px] flex flex-row' id='content'>
      <div class='relative w-max text-[" . $GLOBALS['unselected'] . "] font-sans text-[48px]' id='HeadTitle'>
      <a href='/'>
        <span class='text-[#42BFDD]'>H</span>aarlem</a>
      </div>
      <div class='absolute flex items-center right-0 gap-[25px] lg:text-[20px] md:text-[15px]' id='navigation'>
        <div class='flex items-center float-right'>
          <ul class='flex flex-row gap-[25px] mt-[15px]'>
            <li class='transition ease-in-out hover:translate-y-[-5px] text-[" . $GLOBALS['colours']['yummie'] . "]'>
              <a href='/food'>Yummie!</a>
            </li>
            <li class='transition ease-in-out hover:translate-y-[-5px] text-[" . $GLOBALS['colours']['tour'] . "]'>
              <a href='/tour'>Haarlem tour</a>
            </li>
            <li class='transition ease-out hover:translate-y-[-5px] text-[" . $GLOBALS['colours']['dance'] . "]'>
              <a href='/dance'>Dance</a>
            </li>
            </li>
            <button data-dropdown-toggle='dropdownPages' class='transition ease-out hover:translate-y-[-5px] text-[" . $GLOBALS['colours']['pages'] . "]'>
              Pages
            </button>
          </ul>
        </div>";
  if (isset($_SESSION['USER_ID'])) {
    echo "
          <button data-dropdown-toggle='dropdownInformation' class='w-max h-[40px] mt-[15px] text-[" . $GLOBALS['headerTextColourValue'] . "] flex items-center gap-[10px] bg-[" . $GLOBALS['unselected'] . "] border-2 border-[" . $GLOBALS['colours']['login'] . "] rounded-md px-4 py-5 transition ease-in-out hover:bg-[" . $GLOBALS['unselected'] . "] hover:border-[" . $GLOBALS['unselected'] . "] hover:text-[" . $GLOBALS['selected'] . "] cursor-pointer'>
          <i class='fa fa-user' style='font-size: 24px;'></i>My Account<i class='fa fa-caret-down mt-[5px]'></i></button>";
  } else {
    echo "
          <button data-dropdown-toggle='dropdownInformation' class='w-max h-[40px] mt-[15px] text-[" . $GLOBALS['unselected'] . "] flex items-center gap-[10px] border-2 border-[" . $GLOBALS['unselected'] . "] rounded-md px-4 py-5 transition ease-in-out hover:bg-[" . $GLOBALS['unselected'] . "] hover:border-[" . $GLOBALS['unselected'] . "] hover:text-[" . $GLOBALS['selected'] . "] cursor-pointer'>
          <i class='fa fa-user' style='font-size: 24px;'></i>Account<i class='fa fa-caret-down mt-[5px]'></i></button>";
  }
  echo
    "<a href='/shoppingCart'>
        <div class='w-max h-[40px] mt-[15px] text-[" . $GLOBALS['unselected'] . "] flex items-center gap-[10px] border-2 border-[" . $GLOBALS['unselected'] . "] rounded-md px-4 py-5 transition ease-in-out hover:bg-[" . $GLOBALS['unselected'] . "] hover:border-[" . $GLOBALS['unselected'] . "] hover:text-[" . $GLOBALS['headerTextColourValue'] . "] cursor-pointer'>
        <i class='fa fa-shopping-cart' style='font-size: 24px;'></i>
          cart</div>
        </a>
      </div>
    </div>
  </div>
    </body>";
}

?>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

  #HeadTitle {
    font-family: 'Inter', sans-serif;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<div id='dropdownInformation'
  class='z-20 hidden divide-y divide-gray-100 rounded-lg shadow w-44 bg-[#29334E] dark:divide-gray-600'>
  <div class='px-4 py-3 text-sm text-gray-900 dark:text-white'>
    <?php
    if (isset($_SESSION['USER_ID'])) {
      echo "<div> " . $_SESSION['USER_USERNAME'] . "</div>
          <div class='font-medium truncate'> " . $_SESSION['USER_MAIL'] . "</div>";
    }
    ?>
  </div>
  <ul class='py-2 text-sm text-gray-700 dark:text-gray-200' aria-labelledby='dropdownInformationButton'>
    <li>
      <?php
      if (isset($_SESSION['USER_ID'])) {
        if ($_SESSION['USER_ROLE'] == 9) {
          echo "<a href='/userPanel' class='block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>Manage Website & Database</a>";
        } else {
          echo "<a href='/userPanel' class='block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>Dasboard</a>";
        }
      } else {
        echo "<a href='/login' class='block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>Dashboard</a>";
      }
      ?>
    </li>
    <?php
    if (isset($_SESSION['USER_ROLE'])) {
      if ($_SESSION['USER_ROLE'] == 9) {
      }
      if ($_SESSION['USER_ROLE'] == 0) {
        if (isset($_SESSION['USER_ID'])) {
          echo "
      <li>
        <a href='/userPanel' class='block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>account details</a>
      </li>";
        } else {
          echo "<li>
        <a href='/register' class='block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>Register</a>
      </li>";
        }
      }
    }

    ?>
  </ul>
  <div class='py-2'>
    <a href='/login'
      class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white'>
      <?php
      if (isset($_SESSION['USER_ID'])) {
        echo 'Sign out';
      } else {
        echo 'Sign in';
      }

      ?>
    </a>
  </div>
  <div id="ddsf"></div>
</div>


<div id='dropdownPages' class='z-20 hidden divide-y divide-gray-100 rounded-lg shadow w-44 bg-[#29334E] dark:divide-gray-600'>
  <ul class='py-2 text-sm text-gray-700 dark:text-gray-200 flex flex-col gap-[25px] mt-[15px]' aria-labelledby='dropdownInformationButton' id="pageList">
  </ul>
</div>

<script>
  async function load() {
    const response = await fetch('http://localhost/api/pages');
    pages = await response.json();

    //get listElement
    div = document.getElementById('pageList');
    for (let i = 5; i < pages.length; i++) {
      pageList.innerHTML += '<li class="transition ease-out hover:translate-y-[-5px]"><a href="/page/' + pages[i].name + '">' + pages[i].name + '</a></li>'
    }
  }
  load();
</script>