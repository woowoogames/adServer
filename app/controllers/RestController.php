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

        function mapperToJson() {
            $json_data = array();
            $_mapper = $this->f3->get('_data');

            while($_mapper->next()) {
                $_mapper->copyTo('__tmp_obj');
                $json_data[] = $this->f3->get('__tmp_obj');
            }

            $this->f3->set('_data', $json_data);

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
