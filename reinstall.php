<?php

echo "<-------- Migrating Tables -------->\r\n";
exec('php artisan migrate --seed');

//pause
sleep(5);

echo "<-------- Set Forum Permissions -------->\r\n";
exec('php artisan forums:permissions');

//pause
sleep(5);

echo "<-------- Set User:3 Permissions -------->\r\n";
exec('php artisan user:permissions');

//TODO
//delete this after all the project is completed
