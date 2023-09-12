<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */


    'diginet' => array(
        'url' => 'http://10.0.0.1:8000/ServiceModelSamples/service?wsdl',
        'connect_interval' => '2',//This config have to be less than connect_interval_limit
        'connect_interval_limit' => '5' //limit config
    ),
    'enableLanguage' => array('showChinese' => false,
                              'showJapanese' => false),

    'showModule' => array('W75' => true,
                          'W76' => true),

    'path_video' => '%5C%5C10.0.0.10%5Cref documents%5C',
    'path_audio' => '%5C%5C10.0.0.148%5CMedia%5Caudios%5C'

);
