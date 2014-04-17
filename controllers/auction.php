<?php

class Auction extends Controller {

    private $section;

    function __construct() {
        parent::__construct();
        $this->view->share = URL . RUTE;
    }

    function index() {
        header('location: ' . URL . 'auction/view');
    }

    function view($id = null, $name = null) {
        $this->view->js = array('auction/js/custom.js');
        $this->view->setBreadcrumb('<a href="/" class="capitalize">' . $this->view->lang['home'] . '</a>', true);
        $this->view->setBreadcrumb('<a href="/" class="capitalize">' . $this->view->lang['auctions'] . '</a>');
        if (!$id)
            header('location: ' . URL);
        try {
            $this->view->auction = $this->model->getAuction($id);
            $this->view->bids = $this->model->getBids($this->view->auction);
            $this->view->Mybids = $this->model->Mybids($this->view->auction);
            $this->view->setBreadcrumb('<a href="' . URL . 'auction/view/' . $this->view->auction['auction_id'] . '/' . $this->view->auction['name'] . '">' . $this->view->auction['name'] . '</a>');
            $this->view->shareImg = UPLOAD . Model::getRouteImg($this->view->auction['img_date']) . $this->view->auction['file_name'];
            $this->view->shareDesc = $this->view->auction['name'];
            $this->view->shareName = $this->view->auction['description'];
        } catch (Exception $e) {
            $this->view->message = array(
                'content' => $e->getMessage()
            );
            $this->view->render('error/message');
            exit;
        }
        $this->view->render('auction/view');
    }

    function bid() {
        if(!Session::Get('is_active')) 
            header('location: ' . URL . 'user/message/1' );
        $this->view->js = array('auction/js/jquery.creditCardValidator.js');
        $bid_id = $_GET['auction_id'];
        $user_id = $_GET['user_id'];
        $this->view->setBreadcrumb('<a href="/">' . $this->view->lang['auctions'] . '</a>');
        $this->view->auction = $this->model->getAuction($bid_id);
        $this->view->bids = $this->model->getBids($this->view->auction);
        $this->model->resultVerif=true;
        if (isset($_POST['name_code_ver'])) {
            $this->model->resultVerif = $this->model->verifyCode($user_id, $bid_id);
        }
        $code = $this->model->getCodes($user_id, $bid_id);
        if ($code['try'] >= 3) {
            $this->model->generateCode($user_id, $bid_id);
            header('location: ' . URL . 'auction/view/' . $bid_id);
        }
        if (!$code['verify'] == 1 && !isset($_POST['name_code_req']) && !isset($_POST['name_code_ver'])) {
            $this->view->code_request = $this->model->code_request();
        }
        if (!$code['verify'] == 1 && (isset($_POST['name_code_req']) && !isset($_POST['name_code_ver']))) {
            $this->model->generateCode($user_id, $bid_id);
        }
        if (!$code['verify'] == 1 && (isset($_POST['name_code_req']) || isset($_POST['name_code_ver']))) {
            $this->view->code_verification = $this->model->code_verification();
        }
        $this->view->auctionForm = $this->model->auctionForm();
        $this->view->setBreadcrumb('<a href="' . URL . 'auction/view/' . $this->view->auction['auction_id'] . '/' . $this->view->auction['name'] . '">' . $this->view->auction['name'] . '</a>');
        $this->view->render('auction/bid');
    }

    function dobid() {
        try {
            if ($_POST['card'])
                $this->model->saveCard();
        } catch (Exception $e) {
            
        }
        $id = $_POST['auction_id'];
        if (isset($_POST['dobid'])) {
            $this->view->doBid = $this->model->doBid($id);
        }
        header('location: ' . URL . 'auction/view/' . $id);
    }

    function favorites() {
        $this->model->getFavorites($_GET['auction_id'], $_GET['user_id']);
    }

    function search() {
        $this->view->setBreadcrumb('<a class="capitalize" href="/">' . $this->view->lang['home'] . '</a>', true);
        $this->view->setBreadcrumb('<span class="capitalize">' . $this->view->lang['results'] . '</span>');
        $this->view->bids = $this->model->getSearch($_GET['search']);
        $this->view->render('auction/lista');
    }

}
