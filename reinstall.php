<?php

echo "<-------- Migrando Tabelas -------->\r\n";
exec('php artisan migrate --seed');

//pause
sleep(5);

echo "<-------- Setando Permissoes Forum -------->\r\n";
exec('php artisan forums:permissions');

//pause
sleep(5);

echo "<-------- Setando Permissoes User:3 -------->\r\n";
exec('php artisan user:permissions');

//TODO
//delete this after all the project is completed
