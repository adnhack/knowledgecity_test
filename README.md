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
