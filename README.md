<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.monotech.group/_nuxt/img/logo2.26f5433.png" width="200"></a></p>

## Gaming Application

It is a simple game and wallet application

- docker-compose up -d
- docker exec -it nginx_php bash
- cd /var/www/html
- cp .env.example .env
- composer install
- ph artisan key:generate
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

## Gaming

- First of all, you must access the project via the browser and log in with the player account.
- Press the "Play Now" Button when you see the T-Rex game on the homepage
- You will come across two selection tools, the interest is for betting, the second is the maximum distance you aim for.
- After selecting these options, press the space key to start the game. The bet is made when the game starts.
- If you reach and pass your target distance, it offers you a win. The farther you go, the more win rate you get.
- If you do not reach your target distance, you cannot get your bet back.

  ### Have Fun :)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
