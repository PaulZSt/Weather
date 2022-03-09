<?php

namespace Elogic\WeatherInfo\Controller\Test;

use Magento\Framework\App\Action\Action;

class Getweather extends Action
{
    public function execute()
    {
        echo 'Test controller';

        $api = $this->_objectManager->create('Elogic\WeatherInfo\Service\Weather\WeatherApi');
        $data = $api->getWeather();
        $temp = $data['main']['temp'];

        echo 'Temp: '.$temp." C <br/>";
        echo 'Detailed:'."<br/>";
        foreach($data as $key => $val) {

            echo "<br/>".$key."<br/>";
            if($key == 'main') {
                foreach($val as $key1 => $val1) {
                    echo "<br/>".$key1."<br/>";
                    print_r($val1);
                }
            }
            else {
                print_r($val);
            }

        }
    }
}
