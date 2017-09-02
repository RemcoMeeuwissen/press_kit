<?php

require __DIR__ . '/../vendor/autoload.php';

Flight::route('/(@page)', function($page) {
    $url = new PressKit\Url(__DIR__ . '/../');
    $page = $url->get($page);

    if ($page) {
        echo 'Show ' . $page;
    } else {
        echo 'Show error';
    }
});

Flight::start();
