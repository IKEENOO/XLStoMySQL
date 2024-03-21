# XLStoMySQL

## Info
The task is to implement the application parsing data from an excel file into a database.

The parsing file has 4 columns; the program should allow parsing based on user settings, i.e. It should be possible to manually specify what data to look for, or the range and in which columns.

## Installation
1. Clone the repository
```
  https://github.com/IKEENOO/XLStoMySQL.git
```
2. Inside the project directory install PhpSpreadsheet
```
  composer require phpoffice/phpspreadsheet
```

## Connecting to the DB
You can choose one of two ways:
1. Paste the connection information in the db_connect.php file
```
  $hostname = '';
  $user = '';
  $password = '';
  $db_name = '';
```
2. Uncomment the data entry fields in the index.php file (in this case, the data can be entered directly on the site)
```
  <div class="p__setting">
    <input type="text" value="" name="hostname" placeholder="Port">
    <input type="text" value="" name="user" placeholder="User">
    <input type="text" value="" name="password" placeholder="Password">
    <input type="text" value="" name="db_name" placeholder="DB Name">
  </div>
```
