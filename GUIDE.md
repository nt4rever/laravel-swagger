Run temporary container in Powershell

```bash
docker run --rm `
    -v "${PWD}:/var/www/html" `
    -w /var/www/html `
    laravelsail/php82-composer:latest `
    composer install --ignore-platform-reqs
```
