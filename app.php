<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require __DIR__ . '/src/bizbink/DynDNS/Autoload.php';

$credentials = null;
$provider = null;

$Record = new \bizbink\DynDNS\Record();
$Domain = new \bizbink\DynDNS\Domain();

for ($x = 1; $x <= $argc - 1; $x++) {
    switch ($argv[$x]) {
        case '-t':
            $credentials = array('token' => $argv[$x + 1]);
            $x += 1;
            break;
        case '-p':
            $provider = $argv[$x + 1];
            $x += 1;
            break;
        case '-d':
            $Domain->setName($argv[$x + 1]);
            $x += 1;
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
    }
}

if ($ignoreErrors) {
    error_reporting(0);
}

switch ($provider) {
    case 'DigitalOceanProvider':
        $provider = new bizbink\DynDNS\Provider\DigitalOceanProvider($credentials);
        break;
    default:
        throw new \bizbink\DynDNS\Exception\NullProviderException("Provider missing: check usage documentation");
}

$DynDNS = new \bizbink\DynDNS\DynDNS($provider);

$response = $DynDNS->getProvder()->updateRecord($Record, $Domain);

print "[DynDNS] The domain '{$domain}' was updated.\n";