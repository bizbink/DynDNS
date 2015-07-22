<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require __DIR__ . '/src/bizbink/DynDNS/Autoload.php';

$credentials = null;
$provider = null;
$domain = null;
$recordId = null;
$recordType = null;
$recordName = null;
$recordData = null;
$recordPriority = null;
$recordPort = null;
$recordWeight = null;
$ignoreErrors = false;
for ($x = 1; $x <= $argc - 1; $x++) {
    if ($argv[$x] === '-t') {
        $credentials = array('token' => $argv[$x + 1]);
        $x += 1;
    } elseif ($argv[$x] === '-p') {
        $provider = $argv[$x + 1];
        $x += 1;
    } elseif ($argv[$x] === '-d') {
        $domain = $argv[$x + 1];
        $x += 1;
    } elseif ($argv[$x] === '--ignore-errors') {
        if ($x + 1 < $argc) {
            if (!$argv[$x + 1] == false) {
                $ignoreErrors = true;
            }
        } else {
            $ignoreErrors = true;
        }
    } elseif ($argv[$x] === '-record-id') {
        $recordId = $argv[$x + 1];
    } elseif ($argv[$x] === '-record-type') {
        $recordType = $argv[$x + 1];
    } elseif ($argv[$x] === '-record-name') {
        $recordName = $argv[$x + 1];
    } elseif ($argv[$x] === '-record-data') {
        $recordData = $argv[$x + 1];
    } elseif ($argv[$x] === '-record-priority') {
        $recordPriority = $argv[$x + 1];
    } elseif ($argv[$x] === '-record-port') {
        $recordPort = $argv[$x + 1];
    } elseif ($argv[$x] === '-record-weight') {
        $recordWeight = $argv[$x + 1];
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

$Record = new \bizbink\DynDNS\Record();
$Record->setId($recordId);
$Record->setName($recordName);
$Record->setData($recordData);
$Record->setPriority($recordPriority);
$Record->setPort($recordPort);
$Record->setWeight($recordWeight);

$Domain = new \bizbink\DynDNS\Domain();
$Domain->setName($domain);

$response = $DynDNS->getProvder()->updateRecord($Record, $Domain);

print "[DynDNS] The domain '{$domain}' was updated.\n";