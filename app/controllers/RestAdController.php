<?php
    class RestAdController extends RestController {

            public function list_json () {
                $ad = new Ad($this->db);
                $this->f3->set('_data', $ad->all_json());
                $this->mapperToJson();
            }

            public function related_list_json () {
                if ($this->f3->exists('PARAMS.platform_id')) {
                    $platformHasAds = new PlatformHasAds($this->db);
                    $this->f3->set('_data', $platformHasAds->all($this->f3->get('PARAMS.platform_id')));
                    $this->mapperToJson();
                }
            }

            public function bind_ads () {
                if ($this->f3->exists('PARAMS.platform_id') && $this->f3->exists('POST.ads')) {
                    $platformHasAds = new PlatformHasAds($this->db);
                    $platformHasAds->bindAds($this->f3->get('PARAMS.platform_id'), $this->f3->get('POST.ads'));
                    echo '{status:"success"}';
                    die();
                }
            }

    }