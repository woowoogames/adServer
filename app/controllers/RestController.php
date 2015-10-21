<?php
    class RestController {

        protected $f3;
        protected $db;

        function beforeroute() {
        }

        function afterroute() {
            if ($this->f3->get('serialize_mode')) {

                echo serialize($this->f3->get('_data'));

            } else {

                echo json_encode($this->f3->get('_data'));

            }
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
            
        }
    }
