<?php
    class RestPlatformController extends RestController {
        public function create() {

            $platform = new Platform($this->db);

            if ($this->f3->exists('PARAMS.domain')) {

                $dCfg = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config/defaul_cfg.json'), true);

                $dCfg['domain'] = $this->f3->get('PARAMS.domain');

                $platform->getByDomain($this->f3->get('PARAMS.domain'));

                if ($this->f3->exists('platform.id')) {

                    print_r($this->f3->get('platform'));

                    $this->f3->set('serialize_mode', true);

                    $this->f3->set('_data', $dCfg);

                } else {

                    $this->f3->set('platform', $dCfg);

                    $platform->add();

                    $this->f3->set('serialize_mode', true);

                    $this->f3->set('_data', $dCfg);

                }

            } else {



            }
            
        }

    }
