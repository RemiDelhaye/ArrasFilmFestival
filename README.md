***

![Arras Film Festival](http://arras-film-festival.fr/bundles/ressources/img/arras-film-festival.png "Arras Film Festival")

***

[![Build Status](https://travis-ci.org/RemiDelhaye/ArrasFilmFestival.png?branch=master)](https://travis-ci.org/RemiDelhaye/ArrasFilmFestival)

What is this ?
--------------

*Online website of the Arras Film Festival (French & international cinema).*

> [Website here](http://arras-film-festival.fr)

How to build me ?
-----------------

```
curl -s https://getcomposer.org/installer | php
php composer.phar install
```

```
http://localhost/path-to-project/config.php
http://localhost/path-to-project/app_dev.php
```

#### Requirements

 * **Symfony2 is only supported on PHP 5.3.3 and up.**
 * Be warned that PHP versions before 5.3.8 are known to be buggy and might not work for you:
 * before PHP 5.3.4, if you get "Notice: Trying to get property of non-object", you've hit a known PHP bug (see https://bugs.php.net/bug.php?id=52083 and https://bugs.php.net/bug.php?id=50027);
 * before PHP 5.3.8, if you get an error involving annotations, you've hit a known PHP bug (see https://bugs.php.net/bug.php?id=55156).
 * PHP 5.3.16 has a major bug in the Reflection subsystem and is not suitable to run Symfony2 (https://bugs.php.net/bug.php?id=62715)

#### Documentation

 * The "[Quick Tour](http://symfony.com/get_started)" tutorial gives you a first feeling of the framework. If, like us, you think that Symfony2 can help speed up your development and take the quality of your work to the next level, read the official [Symfony2 documentation](http://symfony.com/doc/current).

Contributors
------------

 * Thomas Leduc (https://github.com/AlderDev)
 * Rémi Delhaye (https://github.com/RemiDelhaye)
 * Pôlecom EPSI Arras
