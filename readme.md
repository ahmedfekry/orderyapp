### What is orderyapp ?

It is a website like Otlb.com where users can order food. it hase a dashboard where admins can manage the app content

### configration

1- Clone the rep

2- cd the_app_directroy

3- composer install 

4- php artisan key:generate 

5- create the database called orderyapp

6- create .env file and set DB_DATABASE=orderyapp and set the database username and password

7- php artisan migrate

8- you can login to the dashboard using http://localhost/orderyapp/

	Email:- admin@admin.com
	password:-123456

### API Documentation
[API Documetation](https://documenter.getpostman.com/collection/view/1994153-2c2e1e6f-2222-389f-700c-d87aad8bdf60)

The APIs uses the [JWT Auth](https://github.com/tymondesigns/jwt-auth/) blugin to authenticate every request, the token must exist in all the api http:://xxxx.com?token=sdfsd123wd .