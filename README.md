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

## License

> The MIT License (MIT)
> 
> Copyright (c) 2015 Matthew Vanderende <matthew@vanderende.ca>
> 
> Permission is hereby granted, free of charge, to any person obtaining a copy
> of this software and associated documentation files (the "Software"), to deal
> in the Software without restriction, including without limitation the rights
> to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
> copies of the Software, and to permit persons to whom the Software is
> furnished to do so, subject to the following conditions:
> 
> The above copyright notice and this permission notice shall be included in all
> copies or substantial portions of the Software.
> 
> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
> IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
> FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
> AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
> LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
> OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
> SOFTWARE.
