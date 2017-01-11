---
author: mos
category:
    - python
    - flask
    - kurs oopython
revision:
    "2017-01-06": (A, mos) Första versionen.
...
Flask som CGI-skript
==================================

När man sätter en Flask-applikation i drift tillsammans med en webbserver finns det flera alternativ. Ett av de enklaste är att använda CGI för att köra din Flaskapplikation.

På studentservern kan du köra CGI-skript på detta sättet. Så här gör du för att koppla ett CGI-skript till din Flaskapplikation.

<!--more-->


Du har en Flaskapplikation som är sparad i `app.py`. Den kan se ut så här, enklast möjliga.

```python
#!/usr/bin/env python3
# -*- coding: UTF-8 -*-

"""
Minimal Flask application
"""

from flask import Flask

app = Flask(__name__)

# Make it easier to debug
app.debug = True
app.config.update(
    PROPAGATE_EXCEPTIONS=True
)

@app.route("/")
def home():
    """ Home route """
    return("<h1>Hello World of Flask</h1><p>Rockn Roll...")


if __name__ == "__main__":
    app.run()
```

Du kan spara ovan kod i en fil `app.py` och sedan köra den via `python3 app.py` för att kontrollera att det fungerar.

Du kan nu lägga till en fil `app.cgi` som via webbservern Apache kan köra din Flaskapplikation.

Skriptet `app.cgi` kan se ut så här.

```python
#!/usr/bin/env python3
# -*- coding: UTF-8 -*-

"""
Smallest possible cgi-script to execute a WSGI application like Flask.
"""

from wsgiref.handlers import CGIHandler
from app import app

CGIHandler().run(app)
```

Skapa skriptet och lägg båda filerna i en katalog som ät tillgänglig via en webbserver som har konfigurerat att CGI fungerar och Flask finns installerat.

Om du inte vill köra dem lokalt, så kan du lägga filerna i ditt kursrepo och göra `dbwebb publish` för att publisera på studentservern.

Du kan testköra skriptet på följande platser.

* [dbwebb.se](repo/oopython/example/flask/cgi-minimal/app.cgi/)
* [www.student.bth.se](http://www.student.bth.se/~mosstud/kod-exempel/oopython/example/flask/cgi-minimal/app.cgi/)

Du kan se [källkoden till exemplet i kursrepot för oopython](https://github.com/dbwebb-se/oopython/tree/master/example/flask/cgi-minimal).

I forumet finns ett par trådar som är relevanta att kika i, du hittar dem i [Python FAQ](t/2880) under rubriken "Flask och CGI".
