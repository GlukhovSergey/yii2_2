<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@img'   => "@frontend/web/img"
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
//        'bot' => [
//            'class' => \SonkoDmitry\Yii\TelegramBot\Component::class,
//            'apiToken' => '865834835:AAErfQTuZtUwbnSiSqCokYeNoe1mpXaJ12o',
//        ],
        'bot' => [
            'class' => \SonkoDmitry\Yii\TelegramBot\Component::class,
            'apiToken' => '709083177:AAFFvJyyJphKcQU0MpGrs4wjiU_01phBpR0',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
