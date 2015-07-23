Configuration:
------
You'll need to edit `config.json` before using this package.

Example:
------
```
php ~/dyndns/dyndns.php -record-id 9584342995 -record-type 'A' -record-name 'www' -record-data '127.0.0.1' --ignore-errors false
[DynDNS] The domain 'bizbink.ca' was updated in 1.418023109436 seconds.
```

Flags | Description | Example
--- | --- | ---
-record-id | The record ID, if required. | `-record-id 9584342995`
-record-type | New record type. | `-record-type 'A'`
-record-name | New record name. | `-record-name 'www'`
-record-data | New record data. | `-record-data '127.0.0.1'`
-record-priority | New record priority. | `-record-priority null`
-record-port | New record port. | `-record-port null`
-record-weight | New record weight. | `-record-weight null`
--ignore-errors | Ignore errors, will not output anything. | `--ignore-errors false`
