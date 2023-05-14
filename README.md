# docker_laravel

For Ubuntu 

1. docker-compose up -d --build

if you need to change your network name change the APP_NAME from root folder && change the network name in docker-compose.yml file

if you need to create new laravel project:
1. clone the repo
2. remove app folder
3. go inside the app container : docker-compose exec app bash
4. run composer create-project command
NOTE: use the name "app" for your project 
