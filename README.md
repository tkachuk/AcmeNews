# News, Symfony test project #

## Installation ##

### 1. Install core and vandors ###

```sh
$ php composer.phar install
```

Now, Composer will automatically download all required files, and install them


### 2. Create database (MySQL) ###

```sh
$ mysqladmin -u USER -pPASSWORD create NEWDATABASE
```

### 3. Restore data from dump ###

```sh
$ mysql -u USER -p NEWDATABASE < ./dump/news.sql
```
