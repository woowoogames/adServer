<?php
    class Platform extends DB\SQL\Mapper {
        
        public function __construct(DB\SQL $db)
        {
            parent::__construct($db,'platforms');
        }
        public function all()
        {
            $this->load();
            return $this->query;
        }
        public function add()
        {
            $this->copyFrom('platform');
            $this->save();
        }
        public function getById($id)
        {
            $this->load(array('id=?',$id));
            $this->copyTo('POST');
        }

        public function getByDomain($domain)
        {
            $this->load(array('domain=?',$domain));
            $this->copyTo('platform');
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
    }
