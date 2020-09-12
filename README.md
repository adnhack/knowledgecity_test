# Aaron Aceves - Simple Restful API
This system is a representation of a small Restful API for login and display students list

## Live demo
Take a look at a functional live demo at [My Personal Website](http://www.adnhack.com/knowledgecity).

## Installation

1. Download the code or clone the repo
```
git clone https://github.com/adnhack/knowledgecity_test.git
```

2. Review and Install the SQL (make sure you have create privilages). File is located on db/db.sql. Using mysql command line
```
mysql -u root -p testdb < db.sql
```

3. Review the app/Database.php and update with your DB credentials
```
$host = '127.0.0.1'; //getenv('DB_HOST');
$port = 3306; //getenv('DB_PORT');
$db   = 'testdb'; //getenv('DB_DATABASE');
$user = 'root'; //getenv('DB_USERNAME');
$pass = '12345678'; //getenv('DB_PASSWORD');
```

## Usage

1. Go to [Project Home](http://www.adnhack.com/knowledgecity) or use your own personal url
2. Log with credentials
```
email: aaron.aceves@gmail.com
pass:  swordfish
```
3. Select if you want "Remember Me" option. If selected you'll remain logged in for 30 days, otherwise until you close the browser or logout.
4. Navigate using the << (prev) or (next) >> buttons
5. For log out click on the log out link on the footer of the page
6. To test the redirect on login sessions, click Back Home on the footer

### Additional installation tips
1. If you are using or want to install it on virtual host, copy paste this code on your apache.conf or httpd-vhosts.conf file
```
<VirtualHost *:80>
    ServerAdmin aaron.aceves@gmail.com
    DocumentRoot "/path/to/your/files/knowledgecity"
    <Directory "/path/to/your/files/knowledgecity">
      Allowoverride All
    </Directory>
    ServerName knowledgecity.local #Change for whatever you want to call it
    ErrorLog "/var/log/apache2/knowledgecity-error_log"
    CustomLog "/var/log/apache2/knowledgecity-access_log" common
</VirtualHost>
```
2. I use URL rewrite, please make sure you have enable rewrite module on apache
```
sudo a2enmod rewrite
sudo systemctl restart apache2

On Windows
remove the # from LoadModule rewrite_module modules/mod_rewrite.so module on the http.conf file

```
3. To allow the use of the .htaccess file and mod_rewrite change all the ocurrence of
```
AllowOverride None
for
AllowOverride All

NOTE: If you are using the code for the virtual host from this guide, you don't need to change it, it is already there the change
```
4. Restart apache 
```
sudo systemctl restart apache2
```
5. Make sure the .htaccess file on the root folder has this content
```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.*)$ $1.php
```

## Thanks for your consideration and use of this system
Your comments and opinions are welcome at **aaron.aceves@gmail.com**
