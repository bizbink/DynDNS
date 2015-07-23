<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$time_start = microtime(true);

require __DIR__ . '/src/bizbink/DynDNS/Autoload.php';

$config = json_decode(file_get_contents('config.json'));

$Domain = new \bizbink\DynDNS\Entity\DomainEntity();
$Domain->setName($config->{'domain'});

$Record = new \bizbink\DynDNS\Entity\RecordEntity();

for ($x = 1; $x <= $argc - 1; $x++) {
    switch ($argv[$x]) {
        case '-record-id':
            $Record->setId($argv[$x + 1]);
            break;
        case '-record-type':
            $Record->setType($argv[$x + 1]);
            break;
        case '-record-name':
            $Record->setName($argv[$x + 1]);
            break;
        case '-record-data':
            $Record->setData($argv[$x + 1]);
            break;
        case '-record-priority':
            $Record->setPriority($argv[$x + 1]);
            break;
        case '-record-port':
            $Record->setPort($argv[$x + 1]);
            break;
        case '-record-weight':
            $Record->setWeight($argv[$x + 1]);
            break;
        case '--ignore-errors':
            if ($x + 1 < $argc) {
                if (!$argv[$x + 1] == false) {
                    error_reporting(0);
                    break;
                }
            } else {
                error_reporting(0);
                break;
            }
    }
}

$provider = null;
switch ($config->{'provider'}) {
    case 'DigitalOcean':
        $provider = new bizbink\DynDNS\Provider\DigitalOceanProvider($config);
        break;
    default:
        throw new \bizbink\DynDNS\Exception\NullProviderException("Provider missing: check usage documentation");
}

$DynDNS = new \bizbink\DynDNS\DynDNS($provider);

$response = $DynDNS->getProvder()->updateRecord($Record, $Domain);

$time_end = microtime(true);
$time = $time_end - $time_start;

print "[DynDNS] The domain '{$Domain->getName()}' was updated in {$time} seconds.\n";
