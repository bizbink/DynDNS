<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require __DIR__ . '/src/bizbink/DynDNS/Autoload.php';

function matches(\bizbink\DynDNS\Entity\RecordEntity $recordEntity1, \bizbink\DynDNS\Entity\RecordEntity $recordEntity2) {
    if ($recordEntity1->getData() === $recordEntity2->getData()) {
        return true;
    }
    return false;
}

function fileLogger($file, $message) {
    file_put_contents($file, print_r('[' . date('m/d/Y h:i:s a', time()) . '] ' . $message . "\n", true), FILE_APPEND);
}

$arguments = [];
for ($x = 1; $x <= $GLOBALS['argc'] - 1; $x++) {
    switch ($GLOBALS['argv'][$x]) {
        case '-config-file':
            $arguments['config-file'] = $GLOBALS['argv'][$x + 1];
            $x += 1;
            break;
        case '-update':
            if (isset($GLOBALS['argv'][$x + 1])) {
                if ($GLOBALS['argv'][$x + 1] == false) {
                    $aruments['update'] = false;
                    break;
                }
            }
            $arguments['update'] = true;
            break;
        case '-validate':
            if (isset($GLOBALS['argv'][$x + 1])) {
                if ($GLOBALS['argv'][$x + 1] == false) {
                    $aruments['validate'] = false;
                    break;
                }
            }
            $arguments['validate'] = true;
            break;
        case '-record-id':
            $arguments['record-id'] = $GLOBALS['argv'][$x + 1];
            $x += 1;
            break;
        case '-record-type':
            $arguments['record-type'] = $GLOBALS['argv'][$x + 1];
            $x += 1;
            break;
        case '-record-data':
            $arguments['record-data'] = $GLOBALS['argv'][$x + 1];
            $x += 1;
            break;
        case '-record-name':
            $arguments['record-name'] = $GLOBALS['argv'][$x + 1];
            $x += 1;
            break;
        default:
            print '[DynDNS] see usage: -update [-validate]';
            exit(0);
    }
}
$message = "[DynDNS] Loading configuration file.";
print $message . "\n";
if (isset($arguments['config-file'])) {
    $configFileLocation = $arguments['config-file'];
} else {
    $message = "[DynDNS] No configuration file supplied, using 'config.json'.";
    print $message . "\n";
    $configFileLocation = 'config.json';
}
if (file_exists($configFileLocation)) {
    $configFile = file_get_contents($configFileLocation);
    if ($configFile) {
        $configFile = json_decode(file_get_contents($configFileLocation), true); // initialize using configuration
    } else {
        $message = "[DynDNS] Failed loading configuration file.";
        print $message . "\n";
        exit(0);
    }
} else {
    $message = "[DynDNS] Could not load configuration file.";
    print $message . "\n";
    exit(0);
}
$config = array_merge($configFile, $arguments);
$newRecordEntity = false;
if (isset($config['update']) || isset($config['validate'])) {
    $dynDNS = new bizbink\DynDNS\DynDNS(); // initialize dynDNS class
    $dynDNS->setAuthentication($config['authentication']); // set dynDNS 'authentication'
    try {
        $dynDNS->setProvder($config['provider']); // set dynDNS 'provider'
    } catch (\bizbink\DynDNS\Exception\NullProviderException $ex) {
        $message = "[DynDNS] Check your configuration, 'provider' is invalid or missing.";
        fileLogger($config['log-file'], $ex);
        fileLogger($config['log-file'], $message);
        print $message . "\n";
        exit(0);
    }

    $domainEntity = new \bizbink\DynDNS\Entity\DomainEntity(); // initialize domainEntity class
    if (isset($config['domain'])) {
        $domainEntity->setName($config['domain']); // set 'name' from options
    } else {
        $message = "[DynDNS] Check your configuration, 'domain' is invalid or missing.";
        fileLogger($config['log-file'], $message);
        print $message . "\n";
        exit(0);
    }

    $recordEntity = new \bizbink\DynDNS\Entity\RecordEntity(); // initilize recordEntity class
    $recordEntity->setId($config['record-id']); // set id from configuration
    $recordEntity->setType($config['record-type']); // set 'type' from options
    $recordEntity->setName($config['record-name']); // set 'name' from options
    $recordEntity->setData($config['record-data']); // set 'data' from options

    $foundRecordEntity= null;
    if (is_null($recordEntity->getId())) { // if Record class property id is NULL
        try {
            $foundRecordEntity = $dynDNS->getProvder()->findRecordEntity($domainEntity, $recordEntity);
        } catch (\bizbink\DynDNS\Exception\UnauthorizedAcessException $ex) {
            $message = "[DynDNS] Unauthorized access, check your arguments/configuration.";
            fileLogger($config['log-file'], $ex);
            fileLogger($config['log-file'], $message);
            print $message . "\n";
            exit(0);
        } catch (\bizbink\DynDNS\Exception\RecordNotFoundException $ex) {
            $message = "[DynDNS] Failed to updated record, check 'record-id', 'record-type', 'record-name' in arguments/configuration.";
            fileLogger($config['log-file'], $ex);
            fileLogger($config['log-file'], $message);
            print $message . "\n";
            exit(0);
        }
        if (!$foundRecordEntity) {
            $message = "[DynDNS] Failed to find record.";
            fileLogger($config['log-file'], $message);
            print $message . "\n";
            exit(0);
        }
        $recordEntity->setId($foundRecordEntity->getId()); // find and inilize foundRecordEntity
    }
    if (is_null($recordEntity->getData())) {
        $ip = $dynDNS->getProvder()->getExternalIp();
        if (!$ip) {
            $message = "[DynDNS] Failed to get external IP Address.";
            fileLogger($config['log-file'], $message);
            print $message . "\n";
            exit(0);
        }
        $recordEntity->setData($ip); // get external IP foundRecordEntity 'data'
    }
    if (isset($config['update']) && $config['update']) {
        try {
            $newRecordEntity = $dynDNS->getProvder()->updateRecordEntity($domainEntity, $recordEntity); // update record, and inilize newRecordEntityc
        } catch (\bizbink\DynDNS\Exception\RecordNotFoundException $ex) {
            $message = "[DynDNS] Failed to updated record, check 'record-id', 'record-type', 'record-name' in arguments/configuration.";
            fileLogger($config['log-file'], $ex);
            fileLogger($config['log-file'], $message);
            print $message . "\n";
            exit(0);
        } catch (\bizbink\DynDNS\Exception\UnauthorizedAcessException $ex) {
            $message = "[DynDNS] Unauthorized access, check your arguments/configuration.";
            fileLogger($config['log-file'], $ex);
            fileLogger($config['log-file'], $message);
            print $message . "\n";
            exit(0);
        } catch (\bizbink\DynDNS\Exception\UnprocessableEntityException $ex) {
            $message = "[DynDNS] Unprocessable entity, check 'record-data' in arguments/configuration.";
            fileLogger($config['log-file'], $ex);
            fileLogger($config['log-file'], $message);
            print $message . "\n";
            exit(0);
        }
        if ($newRecordEntity) {
            $message = "[DynDNS] The record '{$newRecordEntity->getName()}' with type '{$newRecordEntity->getType()}' for '{$domainEntity->getName()}' with '{$newRecordEntity->getData()}' successfully updated.";
            fileLogger($config['log-file'], $message);
            print $message . "\n";
        } else {
            $message = "[DynDNS] The record '{$newRecordEntity->getName()}' '{$newRecordEntity->getType()}' with type '{$newRecordEntity->getType()}' for '{$domainEntity->getName()}' with '{$newRecordEntity->getData()}' failed updating.";
            fileLogger($config['log-file'], $message);
            print $message . "\n";
        }
    }
    if (isset($config['validate']) && $config['validate']) {
        if ($newRecordEntity) { // if record was recently updated
            $comparison1 = $newRecordEntity; // use that record
            $comparison2 = $recordEntity;
            $matches = matches($comparison1, $comparison2); // check if record matches
        } else { // otherwise
            if (is_null($foundRecordEntity)) {
                try {
                    $foundRecordEntity = $dynDNS->getProvder()->findRecordEntity($domainEntity, $recordEntity);
                } catch (\bizbink\DynDNS\Exception\UnauthorizedAcessException $ex) {
                    $message = "[DynDNS] Unauthorized access, check your arguments/configuration.";
                    fileLogger($config['log-file'], $ex);
                    fileLogger($config['log-file'], $message);
                    print $message . "\n";
                    exit(0);
                } catch (\bizbink\DynDNS\Exception\RecordNotFoundException $ex) {
                    $message = "[DynDNS] Failed to updated record, check 'record-id', 'record-type', 'record-name' in arguments/configuration.";
                    fileLogger($config['log-file'], $ex);
                    fileLogger($config['log-file'], $message);
                    print $message . "\n";
                    exit(0);
                }
                if (!$foundRecordEntity) {
                    $message = "[DynDNS] Failed to find record.";
                    fileLogger($config['log-file'], $message);
                    print $message . "\n";
                    exit(0);
                }
            }
            $comparison1 = $foundRecordEntity; // keep the one found
            $comparison2 = $recordEntity;
            $matches = matches($comparison1, $comparison2); // check if record matches
        }
        if ($matches) {
            $message = "[DynDNS] The record '{$foundRecordEntity->getName()}' with type '{$comparison1->getType()}' for '{$comparison1->getName()}' with '{$comparison1->getData()}' matches with '{$comparison2->getData()}'.";
            fileLogger($config['log-file'], $message);
            print $message . "\n";
        } else {
            $message = "[DynDNS] The record '{$foundRecordEntity->getName()}' with type '{$comparison1->getType()}' for '{$comparison1->getName()}' with '{$comparison1->getData()}' does not matches with '{$comparison2->getData()}'.";
            fileLogger($config['log-file'], $message);
            print $message . "\n";
        }
    }
}
    