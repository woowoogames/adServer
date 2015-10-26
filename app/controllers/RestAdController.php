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

            public function collect_display () {
                header('Access-Control-Allow-Origin: *');

                if ($this->f3->exists('PARAMS.adId')) {
                    $ad = new Ad($this->db);
                    $ad->collect_display($this->f3->get('PARAMS.adId'));
                }
            }

            public function collect_click () {
                header('Access-Control-Allow-Origin: *'); 
                
                if ($this->f3->exists('PARAMS.adId')) {
                    $ad = new Ad($this->db);
                    $ad->collect_click($this->f3->exists('PARAMS.adId'));
                }
            }

    }