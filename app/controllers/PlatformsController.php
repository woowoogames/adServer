<?php
class PlatformsController extends Controller {

    public function __construct () {
        parent::__construct(true); // Needed authentification
    }

    public function index() {
        $platform = new Platform($this->db);
        $this->f3->set('sites',$platform->all());
        $this->f3->set('page_head','Список площадок');
        $this->f3->set('view','sites/list.html');
    }

    public function delete() {
        if ($this->f3->exists('PARAMS.id')) {
            $platform = new Platform($this->db);
            $platform->delete($this->f3->get('PARAMS.id'));
            $this->f3->reroute('/');
        }
    }

    public function edit() {
        $platform = new Platform($this->db);

        if($this->f3->exists('POST.update')) {
            // Send config

            $postdata = http_build_query(
                array(
                    'utm_ad_task'          => 'update_config',
                    'utm_ad_configuration' => serialize($this->f3->get('POST'))
                )
            );

            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $context  = stream_context_create($opts);

            $res = file_get_contents('http://' . 'xn----gtbdmonb5ako1g.xn--p1ai?utm_adcontrol', false, $context);

            $sync = (stripos($res, '<!--update_config: true-->') !== false) ? true : false;

            $this->f3->set('POST.sync', $sync);

            $platform->edit($this->f3->get('POST.id'));

            $this->f3->reroute('/');

        } else {
            $platform = $platform->getById($this->f3->get('PARAMS.id'));
            $this->f3->set('site', $platform);
            $this->f3->set('page_head','Изменить настройки');
            $this->f3->set('view','sites/edit.html');
        }
    }

    public function create() {
        $platform = new Platform($this->db);

        if ($this->f3->exists('PARAMS.domain')) {

            $dCfg = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config/defaul_cfg.json'), true);

            $dCfg['domain'] = $this->f3->get('PARAMS.domain');

            $this->f3->set('platform', $dCfg);

            $platform->add();

            $this->f3->reroute('/');

        } else {



        }
        
    }


}