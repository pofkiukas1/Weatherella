# Weatherella


This project was created to generate (currently fake) product recommendations based weather in Lithuanian cities,towns, cities around Lithuania etc..
The api returns a json as an end result.


Requirements
------------

* PHP 7.2.9 or higher;
* [the usual Symfony application requirements][1].


Installation
------------

Clone this repo to your local machine using https://github.com/pofkiukas1/Weatherella.git

If you do not want to install the application, you use it online [here][2]

Usage
-----

There's no need to configure anything to run the application. If you have [installed Symfony][3] binary, run this command:

```bash
$ cd Weatherella/
$ symfony serve
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`
to use the built-in PHP web server in the folder instead of symfony serve.




To retrieve data from the online hosted api use:
https://weatherella.herokuapp.com/api/products/recommended/{city}

Instead of {city} type the name of the city. An example: 

<https://weatherella.herokuapp.com/api/products/recommended/vilnius>

If hosted on localhost use:
https://localhost:8000/api/products/recommended/{city}
An example: 
<https://localhost:8000/api/products/recommended/vilnius>

To preview a list of available cities use: 


<https://weatherella.herokuapp.com/api/city/list>


Note: The database is hosted online (PostgreSQL Version 12.3)

Used Libraries and Data
-----------------------
[Faker][4] - To generate fake product data into the database

[LHMT][5] - Forecast data was used from LHMT api


[1]: https://symfony.com/doc/current/reference/requirements.html
[2]: https://weatherella.herokuapp.com/
[3]: https://symfony.com/download
[4]: https://github.com/fzaninotto/Faker
[5]: http://www.meteo.lt/lt
