<?php
function my_autoload($className)
{       //echo $className;die; // отладка   Users_advertisingController
    // file_exists — Проверяет наличие указанного файла или каталога
    if (file_exists(__DIR__ . '/controllers/' . $className . '.php'))
    {    //1 час 34 переименование переменной
        require __DIR__ . '/controllers/' . $className . '.php';
    }
    elseif (file_exists(__DIR__ . '/models/' . $className . '.php'))
    {
        require __DIR__ . '/models/' . $className . '.php';
    }
    elseif (file_exists(__DIR__ . '/classes/' . $className . '.php'))
    {
        require __DIR__ . '/classes/' . $className . '.php';
    }
}
//spl_autoload_register — Регистрирует заданную функцию в
// качествe реализации метода. Позволяет задать несколько
// реализаций метода автозагрузки описаний классов и интерфейсов.
spl_autoload_register('my_autoload');