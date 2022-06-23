<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.monotech.group/_nuxt/img/logo2.26f5433.png" width="200"></a></p>

## Gaming Application

It is a simple game and wallet application

- docker-compose up -d
- docker exec -it nginx_php bash
- cd /var/www/html
- composer install
- php artisan migrate --seed
- enter [localhost](http://127.0.0.1) or add [http://monogame.test](http://monogame.test) to hosts file then enter domain;

### [Click Here for Api Documentation](https://documenter.getpostman.com/view/7847803/UzBqoQHd)

## Features

- With this application, you can play games, bet and win in the web environment.
- In the API environment, you can create, update and delete players. You can also add or subtract from the player's balance.
  - You must be logged in as an administrator for these operations.
- You can add promotional codes and share them with the user.
  - Users can use promo codes themselves. It is available in the api documentation.
  - The same promo code cannot be applied to the same user more than once.
  - Promo codes are limited to limits. Cannot be used when out of stock.
  - No changes can be made to a promotion that has been used.
  - Promotions have availability timeframes. Cannot be used before or after!

Laravel is accessible, powerful, and provides tools required for large, robust applications.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
