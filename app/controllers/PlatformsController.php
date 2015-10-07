<?php
class PlatformsController extends Controller {

    public function index()
    {
        $platform = new Platform($this->db);
        $this->f3->set('sites',$platform->all());
        $this->f3->set('page_head','Список площадок');
        $this->f3->set('view','sites/list.html');
    }

    public function edit() {
        $platform = new Platform($this->db);

        if($this->f3->exists('POST.update')) {
            $this->f3->set('POST.display_rule', serialize($this->f3->get('POST.display_rule')));
            $platform->edit($this->f3->get('POST.id'));
            $this->f3->reroute('/');

        } else {
            $platform = $platform->getById($this->f3->get('PARAMS.id'));
            $this->f3->set('POST.display_rule', unserialize($this->f3->get('POST.display_rule')));
            $this->f3->set('site', $platform);
            $this->f3->set('page_head','Изменить настройки');
            $this->f3->set('view','sites/edit.html');
        }
    }


}