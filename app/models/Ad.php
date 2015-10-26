<?php

class Ad extends DB\SQL\Mapper {

    public function __construct(DB\SQL $db)
    {
        $GLOBALS['__DB'] = $db;
        parent::__construct($db,'ads');
    }

    public function all()
    {
        $this->load();
        return $this->query;
    }

    public function all_json()
    {
        $this->load();
        return $this;
    }

    public function add()
    {
        $this->copyFrom('POST');
        $this->save();
    }
    public function getById($id)
    {
        $this->load(array('id=?',$id));
        $this->copyTo('POST');
    }
    public function edit($id)
    {
        $this->load(array('id=?',$id));
        $this->copyFrom('POST');
        $this->update();
    }
    public function delete($id)
    {
        $this->load(array('id=?',$id));
        $this->erase();
    }

    public function collect_display ($adId) {
        if (0 < (int) $adId) {
            $f3=Base::instance();

            $this->load(array('id=?', $adId));
            $this->copyTo('__ad');
            $views = $f3->get('__ad.views');
            $views = ($views > 0) ? $views + 1 : 1;
            $f3->set('__ad.views', $views);
            $this->copyFrom('__ad');
            $this->update();
        }  
    }

    public function collect_click ($adId) {
        if (0 < (int) $adId) {
            $f3=Base::instance();

            $this->load(array('id=?', $adId));
            $this->copyTo('__ad');
            $transitions = $f3->get('__ad.transitions');
            $transitions = ($transitions > 0) ? $transitions + 1 : 1;
            $f3->set('__ad.transitions', $transitions);
            $this->copyFrom('__ad');
            $this->update();
        }  
    }

}