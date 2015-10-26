(function($){

  $(function(){

        // Loading ads

        var $adsSelect     = $(document).find('#ads'),
            platformId     = $adsSelect.data('platform-id'),
            adList         = null,
            platformAdList = null,
            adListLength   = 0;

        if ($adsSelect.length && platformId > 0) {

            $.get('/ads/json', function(resAdList){
                adList = JSON.parse(resAdList);
                adListLength = adList.length
                if (adListLength) {

                    $.get('/ads/json/' + platformId, function(resplatformAdList){
                        platformAdList = JSON.parse(resplatformAdList);

                        console.log('platformAdList', platformAdList);

                        var html = '';

                        $.each(adList, function(i, ad) {

                            var relatedAd = ad;

                            if (!_.isEmpty(_.find(platformAdList, 'ad_id', ad.id))) {

                                relatedAd.selected = true;

                            }

                            html += '<option value="' + ad.id + '" ' + (relatedAd.selected ? 'selected' : '') + '>' + ad.title + '</option>';

                        });

                        $adsSelect.append(html).prop('disabled', false).prop('size', adListLength);

                    });

                }
            });

        }

        // Save platform ads

        $(document).on('click', '.upd_platform_ads', function(e){

            e.preventDefault();

            var postData = {ads: JSON.stringify($adsSelect.val())};

            $.post('/ads/bind/' + platformId, postData, function(res){
                alert('Изменения сохранены!');
            }).fail(function(){
                alert('Ошибка');
            });

        });

        // Check module statuses

        $('.refresh_module_status__btn').each(function(i, el){

                var $el = $(el);

                var domain = $el.data('domain');

                var params = {
                    utm_ad_task: 'check_module_install',
                    adcontrol: ''
                };

                if (domain) {

                        $.get('http://' + domain, params, function(res){

                                if (res && res.indexOf('utm_ad_controller') > -1) {

                                        $el.removeClass('btn-warning').addClass('btn-success disabled');
                                        $el.find('.glyphicon').removeClass('glyphicon-refresh spin').addClass('glyphicon-ok');

                                } else {

                                        $el.removeClass('btn-warning').addClass('btn-danger disabled');
                                        $el.find('.glyphicon').removeClass('glyphicon-refresh spin').addClass('glyphicon-remove');

                                }

                        });

                }

        });

  });

})(jQuery)