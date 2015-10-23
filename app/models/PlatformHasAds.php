<?php

class PlatformHasAds extends DB\SQL\Mapper {

    public function __construct(DB\SQL $db) {
        $GLOBALS['__DB'] = $db;
        parent::__construct($db,'platform_has_ad');
    }

    public function all($id) {
        $this->load(array('platform_id=?', $id));
        return $this;
    }

    public function getAdList($id) {

        $ads = $GLOBALS['__DB']->exec('SELECT a.id, a.ad_code FROM `platform_has_ad` p JOIN `ads` a ON p.ad_id = a.id WHERE p.platform_id = ' . (int) $id);

        return json_encode($ads);

    }

    public function bindAds($id, $ads) {

        $GLOBALS['__DB']->exec('DELETE FROM `platform_has_ad` WHERE platform_id=' . (int) $id);

        $ads = json_decode($ads);

        if (is_array($ads) && count($ads)) {

            foreach($ads as $ad) {

                $GLOBALS['__DB']->exec('INSERT INTO `platform_has_ad` (platform_id, ad_id) VALUES(:platform_id,:ad_id)', array('platform_id' => $id,'ad_id' => $ad));

            }

            $this->getAdList($id);
            
        }
    }

}