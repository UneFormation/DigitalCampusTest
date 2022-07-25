# Digital Campus Test

## Commands

### Before

```shell
alias dc="docker-compose"
alias dcr="docker-compose run --rm"
```

### Commands
```shell
dc build
dcr php -f app/app.php
dcr composer install    
dcr phpunit --coverage-html dist
```