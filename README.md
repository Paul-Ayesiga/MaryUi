### Project packages
# requirements
php 8.2 > 
laravel 11.2
livewire 3
maryui
breeze for auth 

## steps to have the project start

use database of your choice
then run
< php artisan migrate >

then we need seed roles
< php artisan db:seed --class="RolesAndPermissionSeeder"

configure MAIL in .env to use any platform of your choice
i used Mailtrap

Pusher for Notifications 
visit pusher.com for credentials 

# update .env file

PUSHER_APP_ID =""
PUSHER_APP_KEY =""
PUSHER_APP_SECRET =""
PUSHER_APP_CLUSTER =""
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME="https"

VITE_PUSHER_APP_KEY ="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST ="${PUSHER_HOST}"
VITE_PUSHER_PORT ="${PUSHER_PORT}"
VITE_PUSHER_SCHEME = "${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"


#### after setup 

run the following command
< composer update >


### Now everything setup 
we are using vite 

so we start a vite development server in the terminal
< npm run dev >

# open another terminal
< php artisan serve >


