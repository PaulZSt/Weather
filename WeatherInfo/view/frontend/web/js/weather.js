define([
    'jquery',
    'uiComponent',
    'mage/url'
], function($, Component, url) {
    'use strict';

    return Component.extend({
        
        getWeatherInfo: (
            function ()  {
                getWeather();
                
                function getWeather() {
                    $.get(
                        url.build('weather/weather'),
                        function (data) {
                            if (!data) {
                                return ;
                            }
                        let weather = JSON.parse(data);
                            console.log(weather);
                        let temp = weather.temp ? weather.temp : null;
                         if(temp) {
                             $('.temperature .data').text(temp ? parseInt(temp) : "-");
                             $('.temperature').show();
                         } else {
                            $('.message .data').text(weather.error);
                            $('.temperature').hide();
                        }
                    });
                }
                
                setInterval(function() {
                    getWeather();
                }, 600000);
        })(),
    });
});
