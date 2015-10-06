<?php
class UserController extends Controller {
    public function index()
    {
        $user = new User($this->db);
        $this->f3->set('users',$user->all());
        $this->f3->set('page_head','User List');
        $this->f3->set('view','user/list.html');
    }
}
