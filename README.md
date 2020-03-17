# Symfony 5 Rest Starter

Start project in 4 steps:

1: clone the project with git clone 

2: run the command **composer install**

3: create data base and run all migrations **symfony console doctrine:database:create** and **symfony console doctrine:migrations:migrate**

4: load fixtures **symfony console doctrine:fixtures:load --purge-with-truncate**

Now get the token user with this call in postman **http://localhost:8000/api/login_check** with an username and password ==admin
