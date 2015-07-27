## Requirements

- PHP v5.6
  - cURL Extension

## Configuration
The default configuration file is `config.json`.

## Usage

```
php ~/dyndns/dyndns.php -config-file 'config.json' -update -validate -record-type 'A' -record-name 'www' -record-data '127.0.0.1'
[DynDNS] Loading configuration file.
[DynDNS] No configuration file supplied, using 'config.json'.
[DynDNS] The record '@' with type 'A' for 'bizbink.ca' with '127.0.0.1' successfully updated.
[DynDNS] The record '@' with type 'A' for '@' with '127.0.0.1' matches with '127.0.0.1'.
```

Flags | Description | Example
--- | --- | ---
-config-file | Set configuration file. | `-config-file 'config.json'`
-update | Update record using configuration/argument. | `-update true`
-validate | Validate the record matches configuration/argument or external address. | `-validate true`
-record-id | Record ID, if required. | `-record-id 9584342995`
-record-type | Record type, if required. | `-record-type 'A'`
-record-name | Record name, if required. | `-record-name 'www'`
-record-data | New record data. | `-record-data '127.0.0.1'`
