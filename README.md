**Usage**: [-t **_token_**] [-p **_provider_**] [-d **_domain_**] [[-record-id **_id_**] [-record-type **_type_**] [-record-name **_name_**] [-record-data **_data_**] [-record-priority **_priority_**] [-record-port **_port_**] [-record-weight **_weight_**]] [--ignore-errors [true|false]

**Example**: `-t 'bN1OItRMMVbgeOzu...' -p 'DigitalOceanProvider' -d 'example.com' -record-id 9584342995 -record-type 'A' -record-name 'www' -record-data '127.0.0.1' --ignore-errors false`

Flags | Description | Example
--- | --- | ---
-t | The token used by the selected provider. | `-t 'bN1OItRMMVbgeOzu...'`
-p | The selected provider. | `-p 'DigitalOceanProvider'`
-d | The domain to update. | `-d 'example.com'`
-record-id | The record ID, if required. | `-record-id 9584342995`
-record-type | New record type. | `-record-type 'A'`
-record-name | New record name. | `-record-name 'www'`
-record-data | New record data. | `-record-data '127.0.0.1'`
-record-priority | New record priority. | `-record-priority null`
-record-port | New record port. | `-record-port null`
-record-weight | New record weight. | `-record-weight null`
--ignore-errors | Ignore errors, will not output anything. | `--ignore-errors false`