<?php

class AdController extends Controller {

    public function __construct () {
        parent::__construct(true); // Needed authentification
    }

    public function index() {

        $ad = new Ad($this->db);

        $this->f3->set('ads', $ad->all());
        $this->f3->set('page_head','Список объявлений');
        $this->f3->set('view','ads/list.html');

    }

    public function edit()
    {
        $ad = new Ad($this->db);

        if($this->f3->exists('POST.update'))
        {
            $ad->edit($this->f3->get('POST.id'));
            $this->f3->reroute('/ads');

        } else
        {
            $ad->getById($this->f3->get('PARAMS.id'));
            $this->f3->set('ad',$ad);
            $this->f3->set('page_head','Изменить объявление');
            $this->f3->set('view','ads/edit.html');
        }
    }

    public function create()
    {
        if($this->f3->exists('POST.create')) {
            
            $ad = new Ad($this->db);
            $ad->add();

            $this->f3->reroute('/ads');

        } else {

            $this->f3->set('page_head','Создание объявления');
            $this->f3->set('view','ads/create.html');
        }
    }


}