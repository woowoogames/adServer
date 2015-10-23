<?php

class PlatformHasAds extends DB\SQL\Mapper {

    public function __construct(DB\SQL $db)
    {
        parent::__construct($db,'platform_has_ad');
    }

    public function getPLatformAds($id) {
        $this->load(array('platform_id=?', $id));
        return $this->query;
    }

}