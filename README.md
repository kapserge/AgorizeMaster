#Requirements :

Docker
Docker-compose
How to start :

cp .env.dist .env

docker-compose up -d
docker-compose exec web composer install

#Ouvrir le web-browser et type 'localhost'. (le port * 84 pour éviter les conflits) :

#Create an admin by php bin/console with :

commande            params
app:create-admin    (pseudo) (email) (password)

Accès à la base de données : (id -> root | password -> root)

http://localhost:84

Turn application from DEV environnement to PROD environnement :

#in file .env
[...]
APP_ENV=prod
[...]

