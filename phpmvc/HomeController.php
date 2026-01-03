<?php
class HomeController extends Controller {
    public function index(){
        $userModel = $this->model('User');
        $users = $userModel->getUsers();
        $this->view('home', ['users' => $users]);
    }
}
