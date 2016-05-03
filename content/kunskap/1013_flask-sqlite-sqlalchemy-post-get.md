---
author: lew
revision:
    "2016-04-19": (PA, lew) Pre-release.
category:
    - oopython
...
Flask, SQLite, SQLAlchemy, POST och GET
===================================

[FIGURE src=/image/oopython/kmom04/cars_table1.png caption="Så här kan det se ut med alla delarna på plats."]

Vi ska titta närmare på hur man kan jobba med POST och GET i Flask. Till vår hjälp har vi SQLAlchemy för att hantera databasen. Målet är att presentera en tabell, med data hämtad från databasen, i en Flask-applikation.  

När vi hämtar en webbsida används HTTP-metoden GET. Det man skickar hamnar då synligt i adressfältet, tex: `http://localhost:5000?id=2&car=volvo`.    

Vill vi däremot inte att datan, eller informationen vi skickar, ska synas, så kan vi använda metoden POST. POST kan bland annat inte bokmärkas, cachas eller sparas i historiken till skillnad från GET-metoden. POST-data skickas i headern

Vi ska som sagt gå igenom båda två och se hur de kan användas tillsammans med Python, Flask och SQLAlchemy. Innan vi börjar flyttar vi in cars.sqlite och flask-appen in i en ny mapp.

[FIGURE src=/image/oopython/kmom04/tree_flask2.png]



Förutsättning {#pre}
-------------------------------

Du har läst delen om GET och POST i guiden "[Php på 20 steg](kunskap/kom-i-gang-med-php-pa-20-steg#globals)" eller vet vad det innebär.  
Du har läst artikeln om "[Flask och Jinja2](kunskap/flask-och-jinja2)".  
Du har läst artikeln om "[SQLAlchemy](kunskap/sqlalchemy)".  



###Strukturera funktionerna {#strukturera-funktionerna}

Vi kommer använda en del egna funktioner så vi skapar en ny fil, "functions.py", där vi samlar alla funktioner. I "app.py" importerar vi filen så vi kan använda dess funktioner. Vi kan även ge importen ett alias:  

```python
import functions as func
```

I functions.py importerar vi det vi behöver från SQLAlchemy, Cars-klassen samt modulen "request" från flask:

```python
from flask import request
from sqlalchemy import *
from sqlalchemy.orm import sessionmaker
from cars import Cars
```

Vi skapar också sessionen till SQLAlchemy i functions.py:

```python
engine = create_engine("sqlite:///db/cars.sqlite")

Session = sessionmaker(bind=engine)
session = Session()
```

Vi behöver även request-modulen i app.py. Nu är vi redo att köra igång.  



###Tabell i Bootstrap {#tabell-i-bootstrap}

Vi använder ju [Bootstrap](https://getbootstrap.com/examples/theme/) i Flask-appen och följer vi länken ser vi att de har en mall för en tabell, ett "table". Högerklickar vi och visar källkoden kan vi kopiera den för att hålla appen responsiv och enligt temat.  

Vi behöver en ny flik i nav-baren. Den döper vi till "Cars" och sätter den till routen "/cars" och skickar med data-variabeln som innehåller bland annat länkarna till headern och footern.  

I mappen "/templates" skapar vi en fil, "cars.html" som vi servar via routen.  

Tittar vi nu på temats tabell ser vi att det är i `<tbody>` det händer grejjer. Vi kan ta strukturen runtom och klistra in i cars.html så genererar vi innehållet baserat på datan i databasen.  

cars.html:

```html
{% include 'header.html' %}

<div class="container" role="main">
    <div class="row">
        <div class="col-md-6">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Modell</th>
                <th>Pris</th>
                <th>Land</th>
                <th>Tillverkare</th>
              </tr>
            </thead>
            <tbody>
                <!-- Här kommer datan -->
            </tbody>
          </table>
        </div>
    </div>
</div>

{% include 'footer.html' %}
```



###Generera tabell utifrån databasen {#generera-tabell}  

Vi skapar en funktion i "functions.py" som hämtar all data från databasen och returnerar en html-sträng som passar in i tabellens "<tbody>" med innehållet:  

```python
def fixCarTable():
    carsTable = ""
    all_cars = session.query(Cars).all()
    for car in all_cars:
        carsTable += """<tr><td>{id}</td><td>{model}</td>
                    <td>{price}</td><td>{country}</td>
                    <td>{manu}</td>
                    </tr>""".format(id=car.id, model=car.model, price=car.price, country=car.country, manu=car.manufacturer)
    return carsTable
```

Funktionen har ju ett returvärde så vi skickar med den i routen till "/cars" och använder den i "cars.html":  

app.py
```python
...

@app.route('/cars'):
    return render_template('cars.html', data=data, car_table=func.fixCarTable())
```

cars.html  
```html
...
<tbody>
    {{ car_table|safe }}
</tbody>
...
```

Använder vi `|safe` så talar vi om att det är OK att det är html-kod. Utan den får vi resultatet som en sträng som skrivs ut.  



###GET {#get}

Vi testar GET-metoden för att ta bort en rad ur databasen. Först och främst måste vi ordna till en länk vid sidan om varje rad i tabellen. Tanken är att när man klickat på den så skickar man med id:t via GET och kan då ta bort den. För att inte behöva använda fler externa lib eller moduler för att ladda om sidan kan vi använda samma route.  

Vi börjar med länken. I funktionen som genererar tabell-datan lägger vi till en länk som skickar med id:t i urlen:  
```python
def fixCarTable():
    carsTable = ""
    all_cars = session.query(Cars).all()
    for car in all_cars:
        carsTable += """<tr><td>{id}</td><td>{model}</td>
                    <td>{price}</td><td>{country}</td>
                    <td>{manu}</td>
                    <td><a href='?del={id}'>Ta bort</a></td>
                    </tr>""".format(id=car.id, model=car.model, price=car.price, country=car.country, manu=car.manufacturer)
    return carsTable
```

Vi kan även lägga till en kolumn i cars.html:
```html
...
<tr>
    <th>#</th>
    <th>Modell</th>
    <th>Pris</th>
    <th>Land</th>
    <th>Tillverkare</th>
    <th></th> <!-- En till kolumn -->
</tr>
```

Nu återstår bara att hantera detta i routen. Vi behöver tala om för routen "/cars" att den ska kunna ta hand om GET-parametrar. Om man klickar på länken för att ta bort data nu så ser vi i URL:en att det skickas med en parameter, till exempel: `?del=2`  

Det gör vi på följande sätt i app.py:
```python
...
@app.route('/cars', methods=["GET"])
...
```

Tack vare modulen `request` som vi importerat kan vi göra en koll i routen om det finns några:  
```python
@app.route('/cars', methods=["GET"])
def show_cars():
    if request.method == "GET":
        delThisCar = request.args.get("del")    # Här tar vi hand om parametern 'del'
        if delThisCar != None:                  # Om den är satt...
            func.removeCar(delThisCar)          # ...så kallar vi på en funktion som tar bort raden

    return render_template('cars.html', data=data, car_table=func.fixCarTable())
```

Nu skickar vi id:t till funktionen "removeCar(...)". Funktionen behöver få tag på raden med korrekt id och sedan ta bort den:  

functions.py:
```python
def removeCar(delCar):
    session.query(Cars).filter(Cars.id == delCar).delete()
    session.commit()
```

Routen returnerar oss tillbaka till cars.html och på vägen kallar vi på "func.fixCarTable()" som hämtar det som finns i databastabellen. Det gör att sidan laddas om med rätt innehåll.  

[FIGURE src=/image/oopython/kmom04/cars_table2.png caption="Resultatet kan se ut så här."]




Avslutningsvis {#avslutning}
------------------------------

Det finns bra verktyg online för att rita uml diagram, kolla in https://www.draw.io och https://www.websequencediagrams.com/.

För att läsa mer om class diagram kolla här: http://www.uml-diagrams.org/class-diagrams-overview.html.

För att läsa mer om sequence diagram och vad man mer kan göra med dem kolla här: http://www.uml-diagrams.org/sequence-diagrams.html.
