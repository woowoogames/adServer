<?php
    class Controller {

        protected $f3;
        protected $db;

        function beforeroute() {
        }

        function afterroute() {
            echo Template::instance()->render('layout.html');
        }

        function __construct($need_roles = false) {

            $f3=Base::instance();

            $db=new DB\SQL(
                $f3->get('db_dns') . $f3->get('db_name'),
                $f3->get('db_user'),
                $f3->get('db_pass')
            );

            $this->f3=$f3;
            $this->db=$db;

            $this->f3->set('is_authentificated', (!empty($_COOKIE['__ad_ctrl_is_auth']) && !empty($_COOKIE['__ad_ctrl_pass']) && $_COOKIE['__ad_ctrl_pass'] === md5('qwedcxzas_')));

            if ($this->f3->get('is_authentificated')) {
                // Silence is gold
            } else {

                if ($need_roles) $this->f3->reroute('/login');
            }
        }
    }
