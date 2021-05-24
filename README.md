<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Payments with OPENPAY

<a href="https://www.openpay.mx/">resource: https://www.openpay.mx/</a>

# Sanbox Account:

email:jesusgeneral2021@gmail.com <br>
password:Programacionweb_25

# Cards Availables with Mode Sanbox

card / credit card : 4111111111111111 <br>
Visit de testing cards : <a href="https://www.openpay.mx/docs/testing.html">https://www.openpay.mx/docs/testing.html</a>

Expiration year : the expiration year must be greater than the current year <br>
Expiration Month : the expiration month must be greater than the current month

cvv: 110

# Run to start with the project

- Composer install
- copy .env.example .env
- php artisan key:generate
- php artisan migrate --seed
- php artisan passport:install

# .env credentials OPENPAY

OPENPAY_ID = m9zdcsf5bpnd6azrybqq

OPENPAY_SK = sk_c399c0e284ed40748ac41f173ec9386a

OPENPAY_PRODUCTION_MODE =  false

# default user credentials

# Admin
seller@test.com | seller2021

# Buyer
buyer@test.com | buyer2021

# Api documentation
<a href="https://documenter.getpostman.com/view/4791942/TzRXARwK">
    Documentation
</a>
