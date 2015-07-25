Requirements:
------
- PHP v5.6
  - cURL Extension

Configuration:
------
The default configuration file is `config.json`.

Example:
------
```
php ~/dyndns/dyndns.php -update -validate -record-type 'A' -record-name 'www' -record-data '127.0.0.1'
[DynDNS] Loading configuration file.
[DynDNS] No configuration file supplied, using 'config.json'.
[DynDNS] The record '@' with type 'A' for 'example.com' with '24.150.195.69' successfully updated.
[DynDNS] The record '@' with type 'A' for 'example.com' matches with '24.150.195.69' matches.
```

Flags | Description | Example
--- | --- | ---
-config-file | Set configuration file. | `-record-id 9584342995`
-update | Update record using configuration/argument. | `-record-id 9584342995`
-validate | Validate the record matches configuration/argument or external address. | `-record-id 9584342995`
-record-id | Record ID, if required. | `-record-id 9584342995`
-record-type | Record type, if required. | `-record-type 'A'`
-record-name | Record name, if required. | `-record-name 'www'`
-record-data | New record data. | `-record-data '127.0.0.1'`