<?php

define('DS', DIRECTORY_SEPARATOR);

require 'vendor' . DS . 'autoload.php';

// Required bootstraps
$templates = new League\Plates\Engine('web' . DS . 'templates', 'phtml');
$templates->loadExtension(new League\Plates\Extension\URI($_SERVER['REQUEST_URI']));
$templates->addFolder('gems', 'web' . DS . 'templates' . DS . 'gems', 'phtml');
$templates->addFolder('body', 'web' . DS . 'templates' . DS . 'body', 'phtml');
$templates->addFolder('modules', 'web' . DS . 'templates' . DS . 'modules', 'phtml');

// 'router' logic
$parts = explode('/', strtolower(trim($_SERVER['REQUEST_URI'], '/')));

$file = strtolower($parts[0]);

// basic pages


echo $templates->render('layout/header');
if ( !isset($parts[1]) || 'preview' != $parts[1]) {
    echo $templates->render('gems::header');
}
echo $templates->render('gems::body_start');

switch ( (isset($parts[0]) ? $parts[0] : 'home') )
{
    ## Modules ...
    case 'katai-css-js-merge-version':
        echo $templates->render('modules::' . $file);
    break;

    case 'katai-ekomi':
        echo $templates->render('modules::' . $file);
        break;

    case 'katai-belgium-local-in-checkout':
        echo $templates->render('modules::' . $file);
        break;

    case 'katai-geolocatecheckout':
        echo $templates->render('modules::' . $file);
        break;



    ## others
    case 'cv' :
        switch ( (isset($parts[1]) ? $parts[1] : 'home') ) {
            case 'work-experience':
                echo $templates->render('body::cv/workexperience');
                break;
            default:
                echo $templates->render('body::cv');
                break;
        }
        break;
    case 'contact-us':
        echo $templates->render('body::' . $file);
        break;
    default:
        echo $templates->render('body::home');
        break;
}



echo $templates->render('gems::body_end');
if ( !isset($parts[1]) || 'preview' != $parts[1]) {
    echo $templates->render('gems::footer');
}
echo $templates->render('layout/footer');