<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/pageService.php';
require_once __DIR__ . '/../models/page.php';

class CmsController extends Controller
{
    private $service;
    public $content;
    public function index()
    {
        error_reporting(E_ALL & ~E_NOTICE);
        if (isset($_GET['page'])) {
            $pageName = $_GET['page'];

            if ($pageName == 'custom') {
                require __DIR__ . '/../views/cms/index.php';
            }
            else{
                $page = $this->service->get_PageByName($pageName);
                $this->content = $page->get_html();
                require __DIR__ . '/../views/cms/index.php';
            }

            if (isset($_POST['editor']) && $pageName == 'custom') {
                $html = $_POST['editor'];
                $newPage = new Page();
                $newPage->__set_name($_POST['pageNameInput']);
                $newPage->__set_title($_POST['pageNameInput']);
                $newPage->__set_html($html);
                $this->service->create_Page($newPage);
                return;
            }    
            else if (isset($_POST['editor']) && $pageName != 'custom') {
                $html = ($_POST['editor']);
                $this->service->update_Page($page->get_id(), $html);
                $page = $this->service->get_PageByName($pageName);
                $this->content = $page->get_html();
            }        
        }
        else {
            require __DIR__ . '/../views/404/index.html';
        }
        
    }

    function __construct()
    {
        $this->service = new PageService();
    }
}
