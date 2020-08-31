# Installation

## Enviroment required

* php 7.2
* mysql 5.7

## Database initial

* Create new DB with name `okayama_anket_db`
* Import file`okayama_anket_db.sql` to `okayama_anket_db`

## Source code setup
```
git clone git@bitbucket.org:Radical-Opti/sol_okayamauniversity_site.git
cd sol_okayamauniversity_site
checkout origin/develop
```
### .env file
* Create env file
```
cp .env.example .env
```

* Config production setting
```
APP_NAME="岡山大学病院管理"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST={DB_HOST}
DB_PORT={DB_PORT}
DB_DATABASE=okayama_anket_db
DB_USERNAME={DB_USERNAME}
DB_PASSWORD={DB_PASSWORD}
```

### Artisan command

```
composer install
php artisan key:generate
php artisan migrate

rm public/storage
php artisan storage:link
```
### Apache config

```
<VirtualHost *:80>		
    ServerAdmin okayama@localhost		
    DocumentRoot "/var/www/sol_okayamauniversity_site/public"		
    DirectoryIndex index.html index.php		
    ServerName localhost
		<Directory "/var/www/sol_okayamauniversity_site/public">	
		AllowOverride all
		Order Deny,Allow
		Allow from all
		Require all granted
	</Directory>	
</VirtualHost>
```
### Apache start 
```
service httpd start
```
# Usage

## Login

http://localhost/login
* User name: doctor
* Password: doctor!@#$

※「doctor」というのはマスターアカウントなので、http://localhost/admin/users でパスワードを更新する必要になります。

## Anket accesses

http://localhost/admin/anket-accesses

## Doctor

http://localhost/admin/users

## Anket results

http://localhost:8000/admin/anket-results

## Anket survey

http://localhost/admin/ankets
