(function($){

  $(function(){

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