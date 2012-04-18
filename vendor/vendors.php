#!/usr/bin/env php
<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

set_time_limit(0);

if (isset($argv[1])) {
    $_SERVER['SYMFONY_VERSION'] = $argv[1];
}

$vendorDir = __DIR__;
$deps = array(
    array('symfony', 'https://github.com/symfony/symfony.git', isset($_SERVER['SYMFONY_VERSION']) ? $_SERVER['SYMFONY_VERSION'] : 'origin/master'),
    array('twig', 'https://github.com/fabpot/Twig.git', 'origin/master'),
    array('swiftmailer', 'https://github.com/swiftmailer/swiftmailer.git', 'origin/master'),
    array('doctrine-common', 'https://github.com/doctrine/common.git', 'origin/master'),
    array('doctrine-dbal', 'https://github.com/doctrine/dbal.git', 'origin/master'),
    array('doctrine', 'https://github.com/doctrine/doctrine2.git', 'origin/master'),
    array('doctrine-mongodb-odm', 'https://github.com/doctrine/mongodb-odm.git', 'origin/master'),
    array('doctrine-mongodb', 'https://github.com/doctrine/mongodb.git', 'origin/master'),
    array('doctrine-couchdb', 'https://github.com/doctrine/couchdb-odm.git', 'origin/master'),
    array('propel', 'https://github.com/propelorm/Propel.git', 'origin/master'),
    array('propel-behavior', 'https://github.com/willdurand/TypehintableBehavior.git', 'origin/master'),
    array('phing', 'https://github.com/Xosofox/phing.git', 'origin/master'),
);

foreach ($deps as $dep) {
    list($name, $url, $rev) = $dep;

    echo "> Installing/Updating $name\n";

    $installDir = $vendorDir.'/'.$name;
    if (!is_dir($installDir)) {
        $return = null;
        system(sprintf('git clone -q %s %s', escapeshellarg($url), escapeshellarg($installDir)), $return);
        if ($return > 0) {
            exit($return);
        }
    }

    $return = null;
    system(sprintf('cd %s && git fetch -q origin && git reset --hard %s', escapeshellarg($installDir), escapeshellarg($rev)), $return);
    if ($return > 0) {
        exit($return);
    }
}
