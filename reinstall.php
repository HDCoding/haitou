<?php

echo "<-------- Migrando Tabelas -------->";
exec('@php artisan migrate --seed');

//pause
sleep(5);

echo "<-------- Setando Permissoes Forum -------->";
exec('@php artisan forums:permissions');

//pause
sleep(5);

echo "<-------- Setando Permissoes User:3 -------->";
exec('@php artisan user:permissions');

//TODO
//delete this after all the project is completed
