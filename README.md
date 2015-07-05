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

## Usage ##

#### News list ####
```sh
/news
```

#### News list with page number ####
```shnews?page=1&per_page=1
/news?page=1&per_page=3
```

#### News item ####
```sh
/news/3
```

### News list(XML) ###
```sh
/news.xml
```
