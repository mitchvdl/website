<?php

define('DS', DIRECTORY_SEPARATOR);

require 'vendor' . DS . 'autoload.php';

$templates = new League\Plates\Engine('web' . DS . 'templates', 'phtml');
$templates->addFolder('gems', 'web' . DS . 'templates' . DS . 'gems', 'phtml');
$templates->addFolder('body', 'web' . DS . 'templates' . DS . 'body', 'phtml');
$templates->addFolder('modules', 'web' . DS . 'templates' . DS . 'modules', 'phtml');

echo $templates->render('layout/header');

echo $templates->render('gems::header');

echo $templates->render('gems::body_start');


// Very simple file_exist logic.


$parts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$file = strtolower($parts[0]);

switch ( $file )
{
    case 'katai-css-js-merge-version':
        echo $templates->render('modules::' . $file);
    break;

    case 'katai-ekomi':
        echo $templates->render('modules::' . $file);
        break;

    case 'cv' :

        switch ( (isset($parts[1]) ? strtolower($parts[1]) : 'home') ) {
            case 'work-experience':
                echo $templates->render('body::cv/workexperience');
                break;
            default:
                echo $templates->render('body::cv');
                break;
        }
        break;
    default:
        echo $templates->render('body::home');
        break;
}



echo $templates->render('gems::body_end');

echo $templates->render('layout/footer');