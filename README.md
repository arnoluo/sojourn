# Sojourn
## notes
### autoload files format
```
"autoload": {
    "psr-4": {
        "App\\": "app/"
    },
    "files": [
        "app/Helpers.php"
    ]
}
```
### after add autoload files, you need to run:
```
composer dump-autoload
```
to make it work;

### for product, optimize autoload:
```
composer dump-autoload --optimize
```
[details](https://segmentfault.com/a/1190000000355928)