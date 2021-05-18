<?php
if(isset($_POST['InputAddress'])) {
    $parameters = array(
        'apikey' => '25083547-8492-410e-b0aa-14a972b1198b',
        'geocode' => $_POST['InputAddress'],//$_POST['InputAddress'], # Самара,улица+22+Партсъезда,+15
        'format' => 'json'
    );

    $response = file_get_contents('https://geocode-maps.yandex.ru/1.x/?'. http_build_query($parameters));
    $obj1 = json_decode($response, true);
    //print_r($obj);

    $cord=str_replace(" ", ",", $obj1['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']);
    $parameters=array(
        'apikey' => '25083547-8492-410e-b0aa-14a972b1198b',
        'geocode' => $cord,
        'kind' => 'metro',
        'format' => 'json'
    );
    $response = file_get_contents('https://geocode-maps.yandex.ru/1.x/?'. http_build_query($parameters));
    $obj2 = json_decode($response, true);
    $metro = $obj2['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['name'];
    //echo $metro;
    $result=array(
        'index'=> $obj1['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['postal_code'],
        'country'=>$obj1['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][0]['name'],
        'region'=>$obj1['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][2]['name'],
        'local'=>$obj1['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][4]['name'],
        'street'=>$obj1['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][5]['name'],
        'house'=>$obj1['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['Components'][6]['name'],
        'firstCord'=>trim(stristr($cord, ','),','),
        'secondCord'=>stristr($cord, ',', true),
        'metro'=>$metro
    );
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}
