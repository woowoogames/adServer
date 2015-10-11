<?php

class LoginController extends Controller {

    public function __construct () {
        parent::__construct(false);
    }

    public function index() {
        if ($this->f3->get('is_authentificated')) $this->f3->reroute('/');

        $this->f3->set('page_head','Авторизация');
        $this->f3->set('view','login.html');
    }

    public function login() {
        if ($this->f3->get('POST.pass') == 'qwedcxzas_') {

            $expires = ($this->f3->get('POST.remember')) ? time() + (60 * 60 * 24 * 365) : time() + (60 * 60 * 24);

            setcookie('__ad_ctrl_is_auth', TRUE, $expires, '/');
            setcookie('__ad_ctrl_pass', md5($this->f3->get('POST.pass')), $expires, '/');

            $this->f3->reroute('/');

        } else {

            $this->f3->set('alert_error','Неверный пароль!');
            $this->index(); 
        }
    }

    public function logout() {
        $expires = time();

        setcookie('__ad_ctrl_is_auth', TRUE, $expires, '/');
        setcookie('__ad_ctrl_pass', md5($this->f3->get('POST.pass')), $expires, '/');

        $this->f3->reroute('/login');
    }

}
