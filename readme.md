# Laravel API connection sample
## Work-flow
Send a shipment reference using the form. <br>
A script will send the code through Ajax. <br>
The Controller check if the code has been sent, it sends the code to the API and receive a data JSON with an error 
or shipment data. A rendered data or errors view will be returned to the browser.

## Files
### Routes
```routes/web```
### Controllers
```app/Http/ShipmentController```
### Models
```app/Http/Apis/ApiService```
### Views
```
resources/views/welcome.blade
resources/views/form.blade
resources/views/shipmentData.blade
resources/views/errors.blade
```

## Requirement
PHP version
```
PHP version >= 7.1
```
cacert.pem file [downloaded](https://curl.haxx.se/docs/caextract.html) and php.ini configured properly like:
```
php.ini
[curl]
; A default value for the CURLOPT_CAINFO option. This is required to be an
; absolute path.
curl.cainfo ="{$path}\php-7.1\extras\cacert.pem"
```

## Installation
Clone the repo and install it via composer
```
composer install
```

When it is finished visit the localhost project path like:
```
http://localhost/ajax-api-connection-sample/public
```