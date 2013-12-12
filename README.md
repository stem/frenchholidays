frenchholidays
==============

Parce qu'il y en a marre de pas trouver les jours fériés français, voici une API JSON simple d'utilisation valable entre 1970 et 2037 inclus.

Exemples d'utilisation :

```
$ curl http://frenchholidays.herokuapp.com/years/2013,2014,2015
[
    "2013-01-01",
    "2013-04-01",
    "2013-05-01",
    "2013-05-08",
    "2013-05-09",
    "2013-05-20",
    "2013-07-14",
    "2013-08-15",
    "2013-11-01",
    "2013-11-11",
    "2013-12-25",
    "2014-01-01",
    "2014-04-21",
    "2014-05-01",
    "2014-05-08",
    "2014-05-29",
    "2014-06-09",
    "2014-07-14",
    "2014-08-15",
    "2014-11-01",
    "2014-11-11",
    "2014-12-25",
    "2015-01-01",
    "2015-04-06",
    "2015-05-01",
    "2015-05-08",
    "2015-05-14",
    "2015-05-25",
    "2015-07-14",
    "2015-08-15",
    "2015-11-01",
    "2015-11-11",
    "2015-12-25"
]


$ curl http://frenchholidays.herokuapp.com/check/2013-01-01
true
```
