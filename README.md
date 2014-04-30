# PHP Javascript Proxy

The folowing script uses parts from [cristidraghici / starfish](https://github.com/cristidraghici/starfish)

**PHP Javascript Proxy** acts like a PHP proxy, expecially for avoiding javascript cross domain issues.

## Example usage

```php
<?php
/*
 Init the script
*/
require_once( 'http.class.php' );
require_once( 'proxy.class.php' );

/*
 Run the script
*/
$proxy = new proxy();
$proxy->init();
?>
```