<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Getting Started

- First, Clone this project using ssh key.

```bash
git clone git@github.com:abubakarchaudhary731/Ecommerce-Backend.git
```
- Go to the project directory, e.g `Ecommerce-Backend/`.

- Run the following command to install all packages & dependancies:

```bash
composer install
```

- Create a `.env` file.
- Copy the `.env.example` file & paste it into the `.env` file.
- Connect through `Database` using `.env` file.
- Generate your AppKey using this command.
```bash
php artisan key:generate
```

- Now, Run the development server:

```bash
php artisan serve
```

All Routes define in the `api.php` file.