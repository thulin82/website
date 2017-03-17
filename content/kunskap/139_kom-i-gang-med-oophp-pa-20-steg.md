---
author: mos
category:
    - php
    - kursen oophp
revision:
    "2015-04-01": "(G, mos) Länk till exempelprogram rättat i sektion 8."
    "2015-02-01": "(F, mos) Tog bort bildlänk till Dilbert."
    "2014-11-26": "(E, mos) Uppdaterade länkar till php.net."
    "2014-09-13": "(D, mos) Ändrade $name till $method."
    "2014-09-08": "(C, mos) Ändrade __construct till _destruct."
    "2013-11-12": "(B, mos) Uppdatering inför campus-kursen ht13."
    "2013-08-14": "(A, mos) Första utgåvan som en del av kursen oophp, endast del 1-11, del 12-20 kvarstår."
...
Kom igång med objektorienterad PHP-programmering på 20 steg
==================================

Denna guide hjälper dig att komma igång med objektorienterad programmering i PHP. Via 20 steg så leds du in i ett objektorienterat tankesätt och du får möjlighet att på egen hand pröva de vanligaste objektorienterade konstruktionerna i PHP. 

Det bästa sättet att gå igenom guiden är att läsa exemplen och sedan pröva dem själv. Skapa en egen exempelsida där du testar olika kod-konstruktioner. Du måste testa själv för att lära dig. 

<!--more-->

> **Du måste själv skriva koden, det finns inga genvägar.**



Förkunskaper {#forkunskaper}
-------------------------------------------------------------------------------

Guiden förutsätter att du har kunskaper i PHP och webbutveckling. Känner du dig osäker på PHP så bör du först läsa igenom guiden ["Kom i gång med PHP på 20 steg"](kunskap/kom-i-gang-med-php-pa-20-steg).



1. Objektorienterad programmering {#om}
-------------------------------------------------------------------------------

Objektorienterad programmering är *en* programmeringsparadigm [^1] bland flera. Ett programmeringsspråk sorteras vanligen in i en programmeringsparadigm för att beskriva hur man kan koda i det. Fler och fler språk stödjer flera programmeringsparadigmer, man kan alltså välja hur man skriver sin kod. Ett vanligt sätt att lära sig programmera är "procedural programmering" [^2]. Det är på det sättet du programmerar i guiden ["Kom i gång med PHP på 20 steg"](kunskap/kom-i-gang-med-php-pa-20-steg). Men nu handlar det alltså om den objektorienterade programmeringsparadigmen [^3]. 

I objektorientering finns det objekt. Ett objekt har medlemsvariabler (properties) och metoder (jämför med funktioner). Medlemsvariablerna används för att lagra ett *state* av ett objekt, ett visst läge som definieras av värdet på medlemsvariablerna. När man vill ändra ett läge för objektet, eller bara använda objektet för att utföra en uppgift, då använder man dess metoder. Metoderna är en förteckning över vad objektet kan göra.

Ett objekt har all sin förmåga samlad i metoder och properties. Allt som objektet behöver lagra finns i dess medlemsvariabler och allt man kan göra med objektet exponeras via dess metoder. Exakt hur objektet verkställer saker och ting är objektets ansvar. Man kan säga att objektet *kapslar in* detaljerna för implementation och erbjuder endast ett publikt API [^9] i form av metoderna. Själva implementationen av metoderna är en sak för objektet själv. 

Ett objekt skapas utifrån en klass. En klass är en mall utifrån vilken man kan skapa nya objekt. När man skapat ett objekt kallas det en instans av klassen. Att skapa ett objekt kan kallas att instansiera [^10] klassen till ett objekt, eller att instansiera ett objekt av klassen.

PHP stödjer objektorientering via klasser, objekt och de vanliga objektorienterade konstruktionerna som normalt förekommer i objektorienterade programmeringsspråk. Objektmodellen i PHP kom i version 5 av språket, i tidigare versioner fanns en förenklad implementation av objektorientering. 


Vår bästa vän är som vanligt manualen som har beskrivningar över datatypen ["object"](http://php.net/manual/en/language.types.object.php) och en översikt över det som hör till [objekt och klasser](http://php.net/manual/en/oop5.intro.php) i övrigt.

> *Referensmanualen är din bästa vän.*

Låt oss skriva en klass.



2. Klasser och objekt i PHP {#klasser}
-------------------------------------------------------------------------------

Låt oss kika på grunden i PHP och klasser.



###Visa felutskrifter {#fel}

Innan vi börjar så sätter vi på visning av felutskrifter, vi vill kunna se de fel som händer.

Jag väljer att göra en fil `config.php` där jag lägger sådan generell konfiguration.

```php
<?php
/**
 * Set the error reporting.
 */
error_reporting(-1);              // Report all type of errors
ini_set("display_errors", 1);     // Display all errors
```

Bra, det blir enklare om vi kan se felen. Då börjar vi.



###En klass i PHP {#en-klass}

Så här ser en klass enkel klass `Simple` i PHP. Ta koden och spara i filen `Simple.php`.

```php
class Simple
{
    /**
     * Property declaration
     */
    public $var = "A default value ";
    public $val = 0;

    /**
     * A method declaration.
     */
    public function displayVar()
    {
        $this->val++;
        echo $this->var . $this->val;
    }
}
```

Exemplet är taget från stycket ["The Basics"](http://php.net/manual/en/language.oop5.basic.php) i manualen (och lite modifierat). Om du redan kan ett annat objektorienterat språk så är det vara en god idé att läsa igenom manualen. Det ger dig snabbt en känsla av hur PHP fungerar med objektorienterade konstruktioner.



###Använda klassen i ett testprogram {#test-klass}

Nu är det dags att skapa ett testprogram som använder klassen. Jag behöver en testfil där jag kan inkludera klassfilen, skapa ett objekt av klassen och sedan använda objektets metoder och medlemsvariabler.

Så här kan ett enkelt testprogram se ut.

Skapa en ny fil `test_Simple.php` och lägg dit följande kod.

```php
<?php
// Get general settings
require "config.php";

// Get the class file for Simple
require "Simple.php";

// Create an object of the class
$obj = new Simple();

// Use the class
echo "<p>";
$obj->displayVar();
echo "</p>";

// Change the state of the object and use it again
$obj->var = "Hello World (should now be 2) = ";
echo "<p>";
$obj->displayVar();
echo "</p>";
```

Om du kör testprogrammet så kan det se ut som följer.

[FIGURE src=/image/snapvt17/oophp20-1.png?w=w2 caption="Utskrift från testprogrammet."]

Så, där är grunderna. Nu ser du hur du skapar en klass tillsammans med dess medlemsvariabler och metoder. Du ser hur du skapar ett objekt av klassen och hur du använder det genom att anropa metoden och genom att ändra värdet på dess medlemsvariabel.



###Felmeddelanden {#fel}

Innan vi går vidare så dubbelkollar vi att felmeddelanden verkligen visas. Du kan simulera ett fel genom att gå in i klassmetoden `Simple::DisplayVar()` och ta bort ett semikolon.

Din PHP-installation kan visa felen på olika sätt, i min installation ser det ut så här.

[FIGURE src=/image/snapvt17/oophp20-2.png?w=w2 caption="Felmeddelanden visas."]

Bra, då vet vi att felmeddelanden visas.



###Vad är $this? {#this}

Variabeln `$this` är en referens till nuvarande objekt och används i klassens metoder för att referera det objekt som anropar metoden.

En metod anropas med ett objekt, så här:

```php
$obj->displayVar();
```

När anropet befinner sig i metoden så används `$this` för att referera till det objekt som anropade metoden, i detta fallet `$obj`.

```php
    public function displayVar() {
        $this->val++;
        echo $this->var . $this->val;
    }
```

Så, i detta fallet så är alltså `$this` samma sak som `$obj`. Klassens metoder innehåller generell kod som fungerar för alla objekt av klassen och `$this` är alltså sättet att referera till den anropande klassen och dess specifika medlemsvariabler.

För att komma åt medlemsvariabeln `$var` så skriver du `$this->var` i din metod.



3. En klass för en tärning {#oophp}
-------------------------------------------------------------------------------

Man måste koda själv, annars lär man sig föga.

Jag behöver ett exempelprogram och känner för att göra en tärning. Det blir ett bra exempel på hur en klass kan byggas upp. Jag tänkte bygga upp den steg för steg så att den fungerar som ett exempel på olika objektorienterade konstruktioner i PHP.


###En tärningssida med PHP och HTML {#dicepage}

För att simulera en tärning så räcker det gott med följande traditionella kod som rullar en tärning sex gånger och visar upp resultatet.

Jag lägger fölande kod i filen `test_dice1.php`.

```php
<?php
require "config.php";
?><!doctype html>
<meta charset="utf-8">
<title>Tärning</title>
<h1>En tärning</h1>
<p>Tärningen kastas 6 gånger, här är resultatet.</p>

<?php
// To save the outcome of each dice roll
$rolls = [];

// Roll the dice
$times = 6;
for ($i = 0; $i < $times; $i++) {
  $rolls[] = rand(1, 6);
}

// Print out the results
$html = "<ul>";
foreach ($rolls as $val) {
  $html .= "<li>{$val}</li>";
}
$html .= "</ul>";
?>
<?= $html ?>
```

Koden skapar en HTML-sida steg för steg och blandar med PHP-kod som simulerar en tärning.

Om man kör exemplet kan man få följande resultat.

[FIGURE src=image/snapvt17/oophp20-3.png?w=w2 caption="Tärningen slås sex gånger, ladda om sidan för en ny runda."]

Så, det var grunden för en tärning.



###Skapa en tärningsklass {#diceclass}

Låt oss nu göra om delar av koden, till en klass, steg för steg. Vi ser i koden att vi har en array där vi lagrar alla tärningskast och en loop där vi kastar tärningen och slutligen skrivs resultatet ut. Nu är det fritt fram hur du kan organisera din kod för att göra den objektorienterad med klasser och objekt.

Jag gör så här, först en klass som jag döper till `Dice` och sparar i filen `Dice.php`.

```php
<?php
/**
 * A Dice class to play around with a dice.
 */
class Dice
{

  // Here comes properties & methods

}
```

Detta är grunden till klassen.


###Klass med properties och metoder {#diceprop}

Nu kan jag stoppa in arrayen som en medlemsvariabel och koden som kastar tärningen blir en metod. 

Jag uppdaterar min kod.

```php
class Dice
{
    /**
     * Properties
     */
    public $rolls = [];


    /**
     * Roll the dice
     *
     * @param integer $times number of times to roll the dice.
     *
     * @return void
     */
    public function roll($times) {
        $this->rolls = [];

        for ($i = 0; $i < $times; $i++) {
            $this->rolls[] = rand(1, 6);
        }
    }
}
```

När du är i en metod och vill peka ut en medlemsvariabel så använder du `$this` som är en referens till nuvarande objekt, det objekt som användes för att anropa metoden. Vi har alltså en medlemsvariabel `$rolls` och för att komma åt den i en metod så använder vi `$this->rolls`. Det är så det funkar.

Du kan läsa om medlemsvariabler, eller [properties](http://php.net/manual/en/language.oop5.properties.php), i manualen.



###Exempelprogram som använder Dice {#usedice}

Så, det får räcka, jag tar en kopia av mitt gamla exempelprogram och skriver om det så att det använder klassen istället. Jag sparar det som `test_Dice2.php`.

Poängen är att skapa ett objekt av klassen och använda det. Så här ser min uppdatering ut.

```php
<?php
require "config.php";
require "Dice.php";
?><!doctype html>
<meta charset="utf-8">
<title>Tärning</title>
<h1>En tärning</h1>
<p>Tärningen kastas 6 gånger, här är resultatet.</p>

<?php
// Create an instance of the class
$dice = new Dice();

// Roll the dice
$times = 6;
$dice->roll($times);
$rolls = $dice->rolls;

// Print out the results
$html = "<ul>";
foreach ($rolls as $val) {
  $html .= "<li>{$val}</li>";
}
$html .= "</ul>";
?>
<?= $html ?>
```

Kärnan i uppdateringen är att skapa ett objekt av klassen och använda det.

```php
// Create an instance of the class
$dice = new Dice();

// Roll the dice
$times = 6;
$dice->roll($times);
$rolls = $dice->rolls;
```

Utskriften av resultatet kunde jag återanvända. Det var bra.



###Summan av tärningsslagen {#dicetotal}

Visst vore det trevligt om tärningen själv kunde räkna ut summan av alla slagen? Det innebär att vi bygger ut klassen med en metod som gör beräkningen. 

Metoden `Dice::getTotal()` kan se ut så här.

```php
    /**
     * Get the total from the last roll(s).
     *
     * @return integer as sum of rolled dices.
     */
    public function getTotal() {
        return array_sum($this->rolls);
    }
```

Smidigt med inbyggda funktioner.

Visst kan jag lägga koden utanför klassen, men nu är tanken att tänka objektorienterat och kapsla in all kod som har med tärningen att göra. Jag får all kod som är relaterad till en tärning i en klass. Koden blir enkel att återanvända. Klasser är en bra struktur som underlättar återanvändning av kod.

Du kan nu uppdatera ditt testprogram för att skriva ut summan av alla tärningsskasten.

```php
<p>Summan av alla tärningar är: <?= $dice->getTotal() ?></p>
```

Resultatet kan se ut så här.

[FIGURE src=image/snapvt17/oophp20-4.png?w=w2 caption="Nu summeras alla tärningsslagen."]

Nu kan du grunderna med klasser och objekt och hur de används. Nu är du redo för en övning.



###Övning Dice {#ovning-1}

Fortsätt nu själv att bygga ut din klass. Här är ett par förslag på funktioner som gör exempelprogrammet lite mer avancerat.

1. Skicka in en parameter till sidan, via querystringen `?roll=6`, som säger hur många slag du skall slå.
1. Lägg in en metod i klassen som returnerar antalet slag som slagits.
1. Skriv ut hur många slags som gjordes.
1. Skriv ut summan och medelvärdet (ny metod) av alla tärningsslagen.

Så här kan det se ut.

[FIGURE src=image/snapvt17/oophp20-5.png?w=w2 caption="Tärningar med valfritt antal snittvärdet."]

Bra, nu kan du både skapa en klass, använda den och bygga ut den med nya metoder.



4. Bygg en klass {#klassfil}
-------------------------------------------------------------------------------

Så där ja, då har vi kommit igång. Vi fortsätter och bygger till ett histogram [^4] till tärningen, ett stapeldiagram som visar hur många kast som blir etta, tvåa och så vidare.

Klassen `Histogram` och klassen `Dice` skall inte vara beroende av varandra, de känner inte till varandra, det som knyter ihop dem är användandet i test-filen.



###Övning Histogram {#ovning-2}

Gör följande.

1. Skapa en klass `Histogram` som kan skriva ut statistik om tärningsserien.

1. Skapa metoden `setSerie()` som tar en array med värden som argument.

1. Skapa metoden `getSerie()` som returnerar en strängrepresentation av alla värden i kastserien.

1. Skapa en metod `getHistogram()` som returnerar en strängrepresentation av ett histogram. Sortera utskriften på tärningarna i stigande ordning.

1. (EXTRA) Gör en variant av metoden `getHistogram()`, som sorterar histogrammet i stigande eller sjunkande ordning baserat på antalet tärningar. Mest tärningar börjar, eller omvänt.

Så här kan det se ut, utan extrauppgiften.

[FIGURE src=/image/snapvt17/oophp20-6.png?w=w2 caption="Ett histogram över tärningskast."]

Det var ytterligare en klass. Bra, bra. Det flyter på.



5. Autoload för klassfiler {#autoload}
-------------------------------------------------------------------------------

När antalet klasser växer blir det till slut krångligt att inkludera alla klassfilerna, i rätt ordning, där de behövs. Med hjälp av PHP's [automatiska laddning av klassfiler](http://php.net/manual/en/language.oop5.autoload.php) så blir det mycket lättare, och dessutom snyggare kod.



###Om autoload {#omautoload}

Autoload är en funktion som vi själva skriver och som anropas första gången som ett objekt skapas av en klass. Tanken är då att funktionen laddar in klassfilen, så att vi slipper hantera inkluderingen av klassfilerna. Autoload har alltså koll på var klassfilerna finns någonstans och inkluderar dem vid behov.

I PHP finns det en variant där man skapar funktionen [`__autoload()`](http://php.net/manual/en/function.autoload.php), men ett bättre sätt är att använda [`spl_autoload_register()`](http://php.net/manual/en/function.spl-autoload-register.php).

Fördelen med spl_autoload_register är att man kan ha flera funktioner för autoloading, det är bra när man använder någon annans kod som kan ha en annorlunda struktur för att lagra och namnge klassfilerna.



###En autoloader {#enautoloader}

Låt oss skapa en autoladdare för våra klassfiler, implementationen förutsätter att klassfilerna ligger i samma katalog som det anropande skriptet.

Lägg följande kod i filen `autoload.php`.

```php
<?php
/**
 * Autoloader for classes.
 *
 * @param string $class the name of the class.
 */
spl_autoload_register(function ($class) {
    $path = "{$class}.php";
    if (is_file($path)) {
        include($path);
    }
});
```

Konstruktionen är att jag bifogar en funktion som kan hitta den klassfil som efterfrågas, och inkludera den.



###Var inkludera autoloadern? {#includeauto}

I dina skript kan du nu ta bort alla require av klasserna och ersätta den med din autoloader.

Om du vill så kan du anropa autoloadern i din config.php.

Eller så inkluderar du den i varje testskript. Båda varianterna fungerar.



###Övning autoloader {#ovning-3}

Ta en kopia av ditt exempelprogram med histogrammet och skriv om det så att autoloadern används.

1. För att förstå hur autoloadern anropas så kan du lägga till en utskrift i den. Gör en `echo "$class<br>";` för att skriva ut klassens namna, varje gång autoloadern anropas.

Så här kan det se ut.

[FIGURE src=/image/snapvt17/oophp20-7.png?w=w2 caption="Autoloadern skriver ut klassernas namn."]

En autoloader är en väldigt viktig komponent i PHPs infrastruktur. Det finns en standard som heter [PSR-4](http://www.php-fig.org/psr/psr-4/) som anger hur autoloading skall fungera. Men vår hemmasnickrade autoloader gör ju också sitt jobb, i all enkelhet.

På FIGs hemsida finner du även standarder för hur vi skriver kod, i form av [PSR-1](http://www.php-fig.org/psr/psr-1/) och [PSR-2](http://www.php-fig.org/psr/psr-2/).



6. Konstruktor och destruktor {#construct}
-------------------------------------------------------------------------------

<!--
namespace
exceptions
chainable
-->

Konstruktorn är en metod `__construct()` som anropas när ett objekt skapas. Destruktorn är en metod `__destruct()` som anropas när ett objekt förstörs. En objekt förstörs när programmet avslutas, eller i förtid genom att något gör "delete" på variabeln som innehåller objektet med hjälp funktionen [`unset()`](http://php.net/manual/en/function.unset.php).

**Konstruktor och destruktor anropas när objekt skapas och förstörs.**

```php
// Create a object and the constructor is called
$obj = new CDice();

// Delete the object and the destructor is called
unset($obj);
```

I konstruktorn kan du initiera klassen, du kan ge den en standardinställning, genom att sätta värden på medlemsvariabler. I destruktorn städar du upp, om det behövs. I PHP är det sällan du behöver skriva en destruktor. Ofta sköts uppstädningen i slutet av koden och du behöver inte tänka på minneshantering. Men i vissa fall kan det krävas, till exempel om du har öppnat en fil som du vill stänga eller om du vill logga något i samband med att klassen stängs ned.

Läs snabbt om grunderna för [konstruktorer och destruktorer i manualen](http://php.net/manual/en/language.oop5.decon.php). Sedan kan du själv skapa konstruktor och destruktor i dina klasser. De behöver inte göra något mer än att skriva ut att de anropas. På det viset så ser vi att de verkligen anropas, bakom kulisserna.

Konstanten `__METHOD__` är en PHP konstant som motsvarar namnet på den metod den befinner sig i.

**En konstruktor och en destruktor som skriver ut att de anropas.**

```php
/**
 * Contructor
 */
public function __construct() {
  echo __METHOD__;
}

/**
 * Destructor
 */
public function __destruct() {
  echo __METHOD__;
}
```

Ett exempel på där en konstruktor är användbar är i tärningsklassen. Säg att vi vill göra det konfigurerbart hur många sidor tärningen har. Då behöver vi en medlemsvariabel som lagrar antalet sidor, `$faces`. Standardvärdet skall vara 6, men genom att skicka in en parameter till konstruktorn så kan detta sättas till en valfri siffra, en tärning med flexibelt antal sidor [^5].

**Del av kod för en CDice med valfritt antal sidor.**

```php
<?php
  /**
   * Properties
   *
   */
  public $faces;


  /**
   * Constructor
   *
   * @param int $faces the number of faces to use.
   */
  public function __construct($faces=6) {
    $this->faces = $faces;
  }
```

Konstruktorn tar nu emot ett argument, om du inte skickar med ett argument så får det standard-värdet 6.

För att skapa ett objekt av klassen gör du nu så här.

**Skicka argument till konstruktorn för att skapa flera sidor på en tärning.**

```php
// Create the objects
$dice1 = new CDice();   // Uses default wich is 6 faces
$dice2 = new CDice(12); // Sets the number of faces to 12
```

Se nu till att din klass CDice kan hantera ett flexibelt antal sidor. Du behöver troligen uppdatera metoden som kastar tärningen `Roll()` så att den tar hänsyn till hur många sidor som tärningen har, annars fortsätter den kasta en tärning med sex sidor.



###Övning många sidor {#ovning-4}

Utöka dina klasser på följande sätt och testa att de fungerar.

1. Lägg till konstruktor och destruktor i CDice och CHistogram som skriver ut att den anropas.

2. Gör så att CDice kan ha ett valfritt antal sidor.

3. Utöka testprogrammet så att tärningens sidor skickas som en parameter till sidan (`?roll=6&faces=12`).

4. Gör en ny metod i CHistogram som visar även de staplar som är tomma, döp den till `GetHistogramIncludeEmpty()` och skicka in tärningens antal sidor som ett argument till funktionen.

Så här blev det för mig.

[FIGURE src=/image/snapshot/oophp20-konstruktor.jpg?w=w1&q=70 caption="Ett histogram över en 12-sidig tärning, nu även med tomma värden."]

Du kan [testa mitt exempel](kod-exempel/oophp20/construct/dice.php?roll=12&faces=12), men försök själv först.



7. Rita diagram över dina klasser {#uml}
-----------------------------------------------------------------------------------------------

Vårt exempel växer, än så länge är det bara två klasser och ett fåtal metoder, men det växer. I sista övningen så märkte du hur jag valde att hantera histogrammet och hur jag lät det veta hur många sidor tärningen har. Exakt hur man löser en sak kan man fundera på, det finns många alternativ. När man blir mer varm i kläderna så vet man vilka strukturer som är att föredra, men när man är nybörjare så är det viktigare att lösa problemet. När man väl löst problemet så kan man ta ett steg tillbaka och studera lösningen och kritiskt granska den, blev det tillräckligt bra?

Ett sätt som kan hjälpa dig att få en översikt över dina klasser, är att rita ett diagram över dem. I objektorienterad modellering används ofta Unified Modelling Language (UML) [^11] som en syntax när man ritar diagram. Det finns många typer av diagram i UML. Ett av de vanligare är klassdiagrammet [^12] som visar klasserna med sina medlemsvariabler och metoder samt hur de olika klasserna hänger ihop.

Så här kan ett klassdiagram se ut för vårt exempelprogram, så här långt.

[FIGURE src=/image/snapshot/oophp20-uml-cdice-chistogram.jpg? caption="Ett klassdiagram i UML för CDice och CHistogram."]

Ett klassdiagram kan vara bra att skissa på, om man vill ha en översikt av sina klasser och hur de relaterar till varandra. Våra klasser har inget direkt samband med varandra, de är fristående klasser. Plus-tecknet säger att medlemmen är publik.

Ett klass-diagram är ett statiskt diagram som visar strukturen över koden. Det finns diagram som visar dynamiken i systemet när det arbetar, ett sådant diagram, sekevensdiagrammet, visar hur ett anrop går genom systemet och vilka delar av systemet som berörs.

Så här kan ett sekvensdiagram [^13] se ut över testprogrammet från övning 4.

[FIGURE src=/image/snapshot/oophp20-uml-sekvensdiagram.jpg? caption="Ett sekvensdiagram över övning 4, visar ordningen av flödet mellan komponenterna."]

Klassdiagram och sekvensdiagram är två enkla men kraftfulla verktyg för att få en översyn av vad som händer i ens system.

Du skall få ytterligare ett tips på sekvensdiagram, det går att beskriva sekvensen som sker i skrivet text, så här.

```bash
title Exercise 4

note left of dice.php: ?roll=12&faces=12
dice.php->bootstrap.php: include
dice.php->CDice: new CDice($faces)
dice.php->CHistogram: new CHistogram
dice.php->CDice: Roll($times)
dice.php->CHistogram: GetHistogramIncludeEmpty()
dice.php->CDice: GetTotal()
dice.php->CDice: GetAverage()
```

Sedan kan vi använda webbtjänsten [Web sequence diagrams](https://www.websequencediagrams.com/) för att rita upp diagrammet. Så här kan den resulterande bilden se ut när sekvensdiagrammer ritas ut enligt "servett"-syntax (napkin).

[FIGURE src=/image/snapshot/oophp20-sekvensdiagram-napkin.jpg? caption="Ett snabbt konstruerat sekvensdiagram med webbtjänsten Web sequence diagram."]

Kom i håg att skissa enkla diagram på ett papper, för din egen skull, så fort du behöver en överblick över vad som händer.



8. Synlighet med public, protected och private {#synlighet}
-----------------------------------------------------------------------------------------------

När du gör en klass så bestämmer du hur medlemsvariabler och metoder skall vara synliga utanför klassen. Det gör du med nyckelorden `public`, `private` och `protected`. 

* **Publik** synlighet innebär att klassens användare kan läsa och uppdatera medlemsvariabler och anropa metoder.
* **Privat** synlighet innebär att klassens användare *inte* kan läsa eller uppdatera medlemsvariabler och *inte* kan anropa metoder.
* **Protected** påverkar synlighet i an arvshierarki, mer om det när vi pratar om arv.

Du kan läsa om [synlighet i manualen](http://php.net/manual/en/language.oop5.visibility.php).

I vår tärning så är alla medlemmar och metoder satta till publika. Det innebär att man kan komma åt dem alla via objektet. Normalt vill vi dock skydda vissa delar. Bara det som verkligen behövs skall vara synligt utåt. Det ger oss möjligheten att skriva vår interna kod som vi vill och vi blir inte beroende av hur någon använder klassen. Detta är en klar fördel och inkapslingen hjälper oss att minska beroenden i koden. 

Du kan se det som  att du skapar ett publikt API för den som använder klassen, men den interna representationen av klassen, och hur klassen utför sin logik, behöver ingen utomstående ha koll på.

Låt oss nu studera tärningen och fundera hur den borde se ut. För min del så vill jag nog lägga medlemsvariablerna som skyddade, det vill säga privata. Det innebär att jag måste erbjuda en metod för att hämta ut tärningsslagen och en metod för att ge svaret på hur många sidor tärningen har. Fördelen är att jag då kan själv bestämma hur jag lagrar information i mina medlemsvariabler. Jag kan byta format och namn på dem utan att det stör den som använder klassen. Jag vill inte att någon skall kunna ändra antalet sidor på tärningen så den möjligheten behöver jag inte erbjuda som en metod.

**En uppdaterad klass med privata medlemsvariabler.**

```php
class CDice {

  /**
   * Properties
   *
   */
  private $faces;
  private $rolls = array();
```

Nu behöver jag alltså två metoder, en för att säga hur många sidor tärningen har `GetFaces()` och en för att ge slagserien som en array `GetRollsAsArray()`.

**Metoder för att ersätta de publika medlemsvariablerna.**

```php
  /**
   * Get the number of faces.
   *
   */
  public function GetFaces() {
    return $this->faces;
  }


  /**
   * Get the rolls as an array.
   *
   */
  public function GetRollsAsArray() {
    return $this->rolls;
  }
```

I klassen tärning hittade jag ingen metod som var kandidat till att bli privat. Men om jag kikar i koden för CHistogram så ser jag en möjlighet att skriva om och förbättra min kod. Det är sådant som kallas "code refactoring" [^6] och det innebär att man skriver om sin kod så att den blir bättre, lättare att underhålla och vidareutveckla. Gör om gör bättre, helt enkelt.

I förra uppgiften tog jag en kopia av metoden `GetHistogram()` och modifierade den lite till att bli `GetGistogramIncludeEmpty()`. Min lösning innebar att nu innehåller båda metoderna dubbletter av delvis samma kod. Ibland vill man lösa ett problem snabbt och då är det en enkel väg att gå. [Studera källkoden](kod-exempel/source.php?dir=oophp20/construct&file=CHistogram.php#L32) för min lösning så ser du kanske delar av koden som kan brytas ut från de båda metoderna till i en egen metod. Man vill ju helst inte duplicera kod. Duplicerar man kod så är man inte DRY [^14], och det vill man försöka att vara.

Det är vad jag nu tänker göra, ett försök att vara DRY och bryta ut delar av den duplicerade koden till en egen metod. Jag tar den del av kod som är samma i båda metoderna och lägger i en egen privat metod. Metoden kan bli privat för det är ingen utanför klassen som skall anropa den.

**En privat metod i CHistogram efter uppstädning.**

```php
  /**
   * Prepare the histogram by calculate occurences for each key.
   *
   * @param array $values the values to prepare out the histogram from.
   */
  private function PrepareHistogram($values) {
    $this->res = array();
    foreach ($values as $key => $value) {
      @$this->res[$value] .= '*'; // Use @ to ignore warning for not initiating variabel, not really nice but powerful.
    }
    ksort($this->res);
  }
```

Vi får helt enkelt hålla ögonen öppna för om metoderna skall vara privata (enbart tillgängliga inom klassen) eller om de skall vara publika (objekts användare kan anropa dem). 



###Övning {#ovning-5}

Bygg om din klass CDice så att alla medlemsvariabler blir privata.

1. Lägg till metoderna `GetFaces()` och `GetRollsAsArray()`.

2. Städa upp din kod i CHistogram och skapa en metod `PrepareHistogram()` som är privat.

[INFO]
Du har nu ändrat det publika API:et, gränssnittet, för din CDice, det kan få konsekvenser för användaren, dvs testprogrammet. Lös de konsekvenserna så att ditt testprogram fungerar. För min del fick jag problem med hur jag skrev ut kastserien så jag valde att lösa det med en `public function GetRollsAsSerie()`.
[/INFO]

Så här blev det för mig, ser likadant ut som tidigare i stort sett, men koden bakom är lite annorlunda - allt enligt tanken att *gör om och gör bättre*.

[FIGURE src=/image/snapshot/oophp20-visibility.jpg?w=w1&q=70 caption="Ett histogram över 48 kast med en 12-sidig tärning."]

Du kan [testa mitt exempel](kod-exempel/oophp20/visibility/dice.php?roll=48&faces=12), men försök själv först.



9. Arv {#arv}
-----------------------------------------------------------------------------------------------

Arv [^7] är en vanlig objektorienterad konstruktion. Det handlar om att en klass ärver från en annan klass. Man kan säga att den ärvande klassen utökar, eller specialiserar, basklassen. Basklassen kallas även superklass och den ärvande klassen kallas subklass. Läs om [arv i manualen](http://php.net/manual/en/language.oop5.inheritance.php).

I fallet med tärningen så fick jag precis ett starkt behov av en tärning med en grafisk representation. Låt oss använda det som ett exempel för att visa hur arv fungerar i PHP. Vi skall alltså göra en klass som kan visa en bild på tärningssidan.


###En CSS-sprite för att representera tärningens sidor {#arv-sprite}

Först behöver jag en bild. [Denna blir bra](http://commons.wikimedia.org/wiki/File:Dice-faces_32x32.jpg). Det är en CSS-sprite [^8].

[FIGURE src=/img/dice-faces.jpg caption="En CSS-sprite för en tärning."]

Men en stylesheet kan jag visa rätt bild beroende på vilken tärningssida jag vill se. Det handlar om att hantera bilden som en bakgrundsbild och positionering den så att rätt tärningssida visas.

**Stylesheet med css-klasser för att visa rätt tärningssida.**

```php
/**
 * CSS sprite for a dice with six faces.
 *
 */
ul.dice {
  margin: 0;
  padding: 0;
  list-style: none;
}

ul.dice li {
  display: inline-block;
  padding: 0;
  margin: 0 4px 0 0;
  width: 32px;
  height: 32px;
  background: url(/img/dice-faces.jpg) no-repeat;
}

ul.dice li.dice-1 { background-position: -160px 0px; }
ul.dice li.dice-2 { background-position: -128px 0px; }
ul.dice li.dice-3 { background-position:  -96px 0px; }
ul.dice li.dice-4 { background-position:  -64px 0px; }
ul.dice li.dice-5 { background-position:  -32px 0px; }
ul.dice li.dice-6 { background-position:    0px 0px; }
```

För att rita ut två tärningar i en lista skriver jag följande html-kod.

```html
<ul class='dice'>
<li class='dice-1'></li>
<li class='dice-4'></li>
</ul>
```

Resultatet blir att en etta och en fyra visas. Så funkar det, en mix av html, css och en bild, en lösning som benämns "css-sprite". Fördelen med css-sprite är att alla delar av bilden finns samlade i en bild, webbläsaren behöver bara göra en förfrågan för att hämta bilden, alternativet vore sex separata bilder och sex frågor från webbläsaren. CSS-sprite är ett sätt att optimera och snabba upp en webbplats som har många små bilder.



###Ärva klass med `extends` {#extends}

Så, då väljer jag att göra en ny klass `CDiceImage` och jag gör det genom att ärva klassen `CDice` med *extends*.

**Ny klass genom arv.**

```php
<?php
/**
 * A dice with images as graphical representation.
 *
 */
class CDiceImage extends CDice {

  // Properties and methods extending or overriding base class
}
```

I detta läget har klassen CDiceImage exakt samma funktioner som dess basklass. Men vi är inte riktigt klara, vi måste anropa basklassens konstruktor.

**Anropa basklassens konstruktor.**

```php
  /**
   * Constructor
   *
   */
  public function __construct() {
    parent::__construct();
  }
```

Så, nu är basklassen initierad. Konstruktionen `parent::` är en referens till basklassen, förälderklassen. Det är så man kan anropa basklassens konstruktor, det sker inte automatiskt. 

Vill du gestalta arv i ett klassdiagram så ritar du en pil mellan klasserna.

[FIGURE src=/image/snapshot/oophp20-uml-extends.jpg caption="I UML representeras arv av en pil mellan klasserna."]

Nu kan vi börja använda klassen för att testa. Arv kan vara kraftfullt, låt se.



###Konstant för antalet sidor {#arv-konstant}

Det går att definiera konstanter i en klass med nyckelordet `const`. I vår nya klass passar det utmärkt med att ange antalet sidor på tärningen med en konstant. Den grafiska representationen har sex sidor så jag väljer att den nya klassen har ett fast antal sidor, vi kan kalla det en specialisering av basklassens beteende. Jag skickar med antalet sidor i basklassens konstruktor. Det är bra i sig, annars är jag beroende av basklassen, om någon ändrar i basklassens konstruktor, som nu har ett default-argument om sex sidor, så hade även min nya klass förändrats. Det är på gott och ont. Ibland vill man ha ett beroende mellan klasserna, men oftast inte. Nu blir det bättre.

```php
  /**
   * Properties
   *
   */
  const FACES = 6;

  /**
   * Constructor
   *
   */
  public function __construct() {
    parent::__construct(self::FACES);
  }
```

Jag använder `self::FACES` för att komma åt konstanten. Konstruktionen `self::` är en referens till statiska medlemmar i klassen, det är medlemmar som är tillgängliga för alla instanser av klassen. En konstant har samma värde för alla objekt av klassen, därför använder man `self::` istället för `$this->`. 

Läs mer om [konstanter i klasser i manualen](http://php.net/manual/en/language.oop5.constants.php). 

Att skriva konstantens namn med stora bokstäver är ett val jag gör, det går lika bra med små bokstäver, det handlar bara om vilken kodningsstandard du följer.



###Basklassens medlemsvariabler {#arv-medlem}

Då gör jag en ny metod för att visa upp den grafiska representationen av tärningen, det är en utökning av basklassens funktionalitet. 

**Metod för att skriva ut tärningens sida med grafisk representation.**

```php
  /**
   * Get the rolls as a serie of images.
   *
   */
  public function GetRollsAsImageList() {
    $html = "<ul class='dice'>";
    foreach ($this->rolls as $val) {
      $html .= "<li class='dice-{$val}'></li>";
    }
    $html .= "</ul>";
    return $html;
  }
```

Som du ser så når jag basklassens medlemsvariabel `$rolls` via `$this`, som vanligt, den är som en del av min klass. Men, kommer du ihåg synligheten? Om du gjorde som jag och deklarerade medlemsvariablerna som `private` så blir det problem. Du kommer inte åt dem. Det är därför det finns en synlighetsnivå som heter `protected`. Den är som privat, med tillägget att ärvande klasser får tillgång och det är precis vad vi vill nu. Den ärvande klassen vill ha tillgång till variabler i basklassen, då passar `protected`. 



**Ändra synlighetsnivån till `protected` i basklassen.**

```php
class CDice {

  /**
   * Properties
   *
   */
  private $faces;
  protected $rolls = array();
```

Jag ändrar endast för `$rolls` eftersom det är den enda variabeln som jag behöver för tillfället. Det är onödigt att öppna upp för mycket, om det inte behövs.



###Övning {#ovning-6}

1. Gör en ny klass som ärver från CDice och utökar dess funktionalitet genom att skriva ut en grafisk representation för tärningsslaget.

Så här blev det för mig, visst är det lite roligare när man ser lite bilder?

[FIGURE src=/image/snapshot/oophp20-inheritance.jpg?w=w1&q=70 caption="En sex-sidig tärning med snygga bilder som sidor."]

Du kan [testa mitt exempel](kod-exempel/oophp20/inheritance/dice.php?roll=6). Du försöker själv först, innan du kikar på "facit", snart kan du säkert göra bättre än "facit".



###PHP stödjer inte multipelt arv {#arv-mult}

PHP är ett språk som har stöd för ett arv, en klass kan ärva från en annan klass. I vissa objektorienterade programmeringsspråk, till exempel C++, finns stöd för multipelt arv. Där kan en klass ärva från flera andra klasser. Är man van vid programmeringsspråk som stödjer multipelt arv kan man vid första anblicken känna avsaknaden av det. Men, det handlar om strukturering av koden och i programmeringsspråk som PHP, och andra som inte har valt att implementera multipelt arv, får man ta till andra lösningar för att strukturera sin kod. I PHP heter dessa *[interface](#interface)* och *[trait](#traits)*. 



10. Är-en och har-en {#is-has}
-----------------------------------------------------------------------------------------------



###Objektorienterad terminologi {#ooterm}

I terminologin kring objektorientering används *is-a* och *has-a* för att bestämma vilken relation som finns mellan objekten. Det är inget speciellt för PHP utan mer universiellt när man modellerar en objektorienterad lösning. 

Relationen *is-a* innebär att en *Kolibri* är en *Fågel* eller att ett *Hus* är en *Byggnad*.

Relationen *has-a* innebär att en *Fågel* har *Vingar* eller att ett *Hus* har *Rum*.

Relationen *is-a* implementeras som arv och relationen *has-a* implementeras som en medlemsvariabel.

Vi har tittat på arv så låt oss se hur *has-a* implementeras i PHP. Själva terminologin är alltså vanlig när man modellerar. Relationen *has-a* kallas "[object composition](http://en.wikipedia.org/wiki/Object_composition)" och en variant av den är "object aggregation" där skillnaden mellan de båda är hur stark kopplingen är mellan objekten. 

För att ta ett exempel, ett Hus har ett Rum och när huset förstörs så förstörs även rummet, det är "composition" och ett starkt beroende. Rummet kan inte existera utan Huset. "Aggregation" säger en lösare koppling som att Huset har en Inneboende. När Huset rivs så flyttar den Inneboende till ett annat Hus, den Inneboende har ett liv, även om Huset förstörs.

[FIGURE src=/image/snapshot/oophp20-uml-has-a.jpg caption="Skillnaden mellan aggregation och composition, i ett UML diagram, är om romben är fylld eller ej."]

Siffran anger hur många, antalet. Finns det 10 rum i huset så borde det stå 10. Inneboende kan det finnas i ett hus, men inte säkert, det kan alltså finnas mellan 0 och flera inneboende. Det kan representeras av `0..*` eller bara en `*` i diagrammet. Detta kallas *multiplicity*.



###En tärningshand består av fem tärningar {#dicehand}

Nåväl, låt oss göra ett exempel. Säg att vi vill spela ett tärningsspel och jag väljer att modellera en tärningshand `CDiceHand` som består av så många tärningar som spelaren skall kasta varje runda. Spelar vi [Yatsy](http://sv.wikipedia.org/wiki/Yatzy) så innebär det i praktiken att tärningshanden skall bestå av fem tärningar och man skall kunna kasta tärningarna tre gånger och varje gång väljer man vilka tärningar som skall sparas.

Här har vi ett *has-a* relation där `CDiceHand` består av sex stycken `CDiceImage`. Rent implementationsmässigt kan man välja att kasta en tärning fem gånger, eller att kasta fem tärningar var sin gång. Jag väljer det senare eftersom det känns mer kopplat till hur verkligheten funkar, det blir (troligen) lättare att ha koll på.

[FIGURE src=/image/snapshot/oophp20-cdicehand-aggregate.jpg caption="En CDiceHand består av (aggregat) fem CDice."]



###Övning, en tärningshand {#ovning-7}

Nu är det dags för dig att pröva om dina vingar bär, kan du själv implementera klassen `CDiceHand` tillsammans med ett exempelprogram som visar att det fungerar med fem tärningar? Det räcker om du kan kasta alla tärningarna en gång, du behöver inte implementera så att man kan spara tärningar och kasta flera gånger.

Här är lite ledtrådar till hur jag gjorde, du behöver inte göra på samma sätt, bara det fungerar.

**Först en mall till hur jag löste klassen `CDiceHand`.**

```php
<?php
/**
 * A hand of dices, with graphical representation, to roll.
 *
 */
class CDiceHand {

  /**
   * Properties
   *
   */
  private $dices;
  private $numDices;
  private $sum;


  /**
   * Constructor
   *
   * @param int $numDices the number of dices in the hand, defaults to six dices. 
   */
  public function __construct($numDices = 5) {
  }


  /**
   * Roll all dices in the hand.
   *
   */
  public function Roll() {
  }


  /**
   * Get the sum of the last roll.
   *
   * @return int as a sum of the last roll, or 0 if no roll has been made.
   */
  public function GetTotal() {
  }


  /**
   * Get the rolls as a serie of images.
   *
   * @return string as the html representation of the last roll.
   */
  public function GetRollsAsImageList() {
  }
}
```

Jag fick även ändra lite i klassen `CDice`, numer kastar jag tärningen endast en gång och jag vill ha ut resultatet direkt, utan att gå via en array. Jag lade till en ny metod `CDice::GetLastRoll()` och jag ändrade beteendet på `CDice::Roll()` så att metoden alltid returnerar värdet på senaste kastet. Det var båda ändringar som inte förstörde kompabiliteten eller förändrade klassens API så att det inte blev bakåtkompatibelt. Det är bra, de andra exempelprogrammen kan alltså fortfarande använda min klass `CDice`. Den typen av tankar är överkurs just nu, men i längden är det sådana saker som gör skillnaden mellan en medioker eller duktig programmerare.

Detta blir en lite friare övning och du märker säkert att det finns flera sätt att implemementera lösningen på, inget är mer rätt än det andra, bara olika, så länge resultatet blir rätt.

Så här blev det för mig.

[FIGURE src=/image/snapshot/oophp20-dicehand.jpg?w=w1&q=70 caption="En tärningshand med fem tärningar."]

Du kan [testa mitt exempel](kod-exempel/oophp20/has-a/dice.php). Utseendemässigt ser det ut som man slagit en tärning fem gånger, men implementationsmässigt är det, som du ser i `CDiceHand`, en helt annan sak.



11. Objekt och sessioner {#session}
-----------------------------------------------------------------------------------------------



###Lagra objekt i sessionen {#objektsess}

Ett objekt kan lagras i [sessionen](kunskap/kom-i-gang-med-php-pa-20-steg#sessioner), `$_SESSION`, vilket kan vara en smidig hantering. Du behöver inte göra någon omvandling utan lagringen sköts automatiskt av PHP, om du gör på rätt sätt. 

Principen bakom lagringen är att objektet serialiseras -- kodas om som en ström av byten, innan det läggs i sessionen för att sparas undan på disk eller databas. Datan i sessionen lagras mellan anropen på disk eller i databas. När det  är dags att läsa upp innehållet i sessionen, vid nästa sidanrop, så görs en baklänges serialisering av objektet, *unserialize*, och det blir objekt igen. Detta sköts alltså automatiskt av PHP. Det enda kravet är att klassfilen finns tillgänglig, att den har inkluderats, eller att man använder `auto_load()`som vi gör, innan sessionen startas. Klassens struktur måste vara känd för att det lagrade objektet skall kunna göras `unserialize()` på.

Om du missar att inkludera klassens definition, innan du startar sessionen, så får du ett felmeddelande som kan se ut som följer.

 > *Fatal error: main() [function.main]: The script tried to execute a method or access a property of an incomplete object. Please ensure that the class definition &quot;CDiceHand&quot; of the object you are trying to operate on was loaded _before_ unserialize() gets called or provide a __autoload() function to load the class definition in /usr/home/mos/htdocs/dbwebb.se/kod-exempel/oophp20/session/dice.php on line 58*

Det finns två funktioner som används, bakom scenen, för att sköta hanteringen, `serialize()` och `unserialize()`. Du kan läsa mer om [objekt och serialisering](http://php.net/manual/en/language.oop5.serialization.php) i manualen. Du kan manuellt använda dessa funktioner då du vill spara ett objekt i en fil eller i en databas.



###Övning {#ovning-8}

Vidareutveckla din spelhand så att den kan summera alla tärningslag som du gör i en runda. Säg att du har en tärningshand med två tärningar, du skall slå dem valfritt antal gånger för att komma så nära 21 som möjligt, men inte över, för då blir du "tjock". Du skall alltså kasta din tärningshand valfritt antal gånger i din runda. Spara objektet i sessionen så att den "kommer ihåg" summan mellan kasten. Håll det enkelt, du behöver inte göra någon koll om spelaren är över 21, det får spelaren hålla koll på själv.

Här är några ledtrådar till hur jag löste uppgiften.

Jag kunde valt att ärva CDiceHand till en ny subklass som kunde hantera en spelomgång, men istället valde jag att utöka klassen CDiceHand med ny funktionalitet. Du kan göra som du tycker är bäst. Jag kunde utöka klassen utan att störa dess tidigare publika API, så det var bra.


Så här blev det för mig.

[FIGURE src=/image/snapshot/oophp20-session.jpg?w=w1&q=70 caption="Spela 21 med en tärningshand som hanterar en spelrunda tillsammans med sessionen."]

Du kan [testa mitt exempel](kod-exempel/oophp20/session/dice.php).



12. Statiska medlemmar {#static}
-----------------------------------------------------------------------------------------------



###Deklarera metoder och medlemsvariabler som statiska {#declstat}

Både medlemsvariabler och metoder kan defineras som `static` vilket innebär att de är en del av klassen och inte objektet.

En statisk medlemsvariabel finns en per klass och alla objekt av klassen har tillgång till att läsa och skriva värden till den variabeln. En statisk medlemsvariabel är bra om man vill ha en "klass-global" variabel som skall vara samma för alla instanser av klassen.

En statisk metod är en metod som inte ändrar ett objekts läge, eller behöver läsa objektets värde. En statisk metod är alltså en del av klassen, inte objektet. En statisk metod kan därför inte komma åt ett objekts medlemsvariabler, men det kan komma åt alla konstanter och statiska medlemsvariabler.

Detta innebär att man inte kan använda `$this` inuti en metod som är deklarerad som `static`, det finns helt enkelt inte ett objekt att nå. Man kan endast nå andra statiska metoder eller medlemsvariabler.

Du använder `self::` eller `parent::` för att komma åt en medlemsvariabel, eller metod, som är deklarerad som `static`. Användandet av `static` kan kombineras med synligheten som styrs med `public`, `protected`, och `private`.

Du kan läsa mer om [`static` i manualen](http://php.net/manual/en/language.oop5.static.php).



###Exempel på statisk medlemsvariabel {#exstat}

Säg att vi har en klass där vi vill hålla koll på antalet instanser av klassen. Här passar en statisk variabel utmärkt som räknare. Den kan inkrementeras i konstruktorn och dekrementeras i destruktorn. Så här kan det se ut.

Först klassen.

```php
class SomeClass {
  
  public static $counter = 0;

  public function __construct() {
    self::$counter++;
  }

  public function __destruct() {
    self::$counter--;
  }

}
```

Nu kan vi använda klassen för att se att det fungerar.

```php
$obj1 = new SomeClass();
echo SomeClass::$counter;

$obj2 = new SomeClass();
echo SomeClass::$counter;

unset($obj2);
echo SomeClass::$counter;

unset($obj1);
echo SomeClass::$counter;
```

Kör man programmet blir utskriften:

> 1210



13. Designmönster Singleton använder static {#singleton}
-----------------------------------------------------------------------------------------------

Designmönster [^15], eller "designpattern", är lösningar på återkommande problem. Ett vanligt designmönster som man ofta kommer i kontakt med när man lär sig designmönster, är "Singleton". Här är tanken att det bara får finnas ett objekt av klassen, ett enda objekt som alla kan dela på och det kan inte kan skapas i fler versioner via `new`. Detta designmönster använder sig av en statisk medlemsvariabel och en statisk metod för att skapa, eller hämta, en referens till objektet. Så här kan koden se ut för en klass som implementerar designmönstret "Singleton". Det är ett bra exempel på statiska metoder.

**En "singleton"-klass.**

```php
class CSomeClass {
  
  /**
   * Property for the single instance
   */
  private static $instance = null;

  /**
   * Define the constructor as private to avoid creation of new objects.
   */
  private function __construct() { ; }

  /**
   * Singleton pattern. Get the instance of the latest created object or create a new one. 
   *
   * @return self The instance of this class, or newly created.
   */
  public static function Instance() {
    return is_null(self::$instance) ? self::$instance = new self : self::$instance;
  }

}

// Use the class
$someclass = CSomeClass::Instance();
```

Du kan läsa mer om [designmönstret "singleton" på Wikipedia](http://en.wikipedia.org/wiki/Singleton_pattern). Det finns många fler designmönster, men ta det lite senare, när du är varm i dina objektorienterade kläder.



14. Scope Resolution Operator (::) {#scope}
-----------------------------------------------------------------------------------------------

En sak som kan vara lite trixig är hur man kommer åt variabler inuti en klass. När det gäller medlemsvariabler så används `$this->` med en pil, men som du såg så användes `self::` för att komma åt en konstant i klassen. Dubbelkolon `::` är en operator som används för att välja vilket område som skall användas, `self::` innebär den egna klassen och används för konstanter eller statiska medlemmar.

Det finns också en `parent::` som hänvisar till basklassen, den klassen man ärver ifrån. Som du kanske noterat så använder vi det när vi anropar basklassens konstruktor. 

**Anropar basklassens konstruktor med hjälp av `parent::` och kommer åt en konstant med `self::`.**

```php
  public function __construct() {
    parent::__construct(self::FACES);
  }
```

Du kan läsa mer om ["scope-operatorn" i manualen](http://php.net/manual/en/language.oop5.paamayim-nekudotayim.php).

Det finns också fall där man använder `static::` för att nå metoder eller medlemsvariabler. Men det är specialfall där `self::` och `parent::` inte räcker till. Specialfallet kallas "late static binding" och det är inget vi tar upp i denna artikeln, det är överkurs och du kan läsa om ["late static binding" i manualen](http://php.net/manual/en/language.oop5.late-static-bindings.php).



15. Abstrakta klasser {#abstrakt}
-----------------------------------------------------------------------------------------------

En abstrakt klass är en klass som inte kan instansieras, det kan inte skapas några objekt av den klassen. En abstrakt klass är till för att subklassas och att någon ärver från den och skapar en konkret klass som man kan skapa objekt av.

En abstrakt klass erbjuder ofta ett gränssnitt, en mall för en klass som kan sakna viss implementation, en implementation som måste skapas av den konkreta klassen. 

För att ta ett exempel från djurriket, men katter (CCat) och möss (CMouse) utökar den abstrakta basklassen djur (CAnimal).

```php
abstract class CAnimal {
  
  public function Eat() {
    echo "I'm eating<br/>";
  }

  abstract public function Noice();

}

class CMouse extends CAnimal {

  public function Noice() {
    echo "Piip, piip<br/>";
  }

}

class CCat extends CAnimal {

  public function Noice() {
    echo "Mjauuu, mjauuu<br/>";
  }

}

// Use the class
$cat = new CCat();
$mouse = new CMouse();

$mouse->Eat();
$mouse->Noice();

$cat->Eat();
$cat->Noice();
```

Kör man programmet får man utskriften:

```text
I'm eating
Piip, piip
I'm eating
Mjauuu, mjauuu
```



16. Överlagring {#overload}
-----------------------------------------------------------------------------------------------

Överlagring i PHP innebär att dynamiskt skapa nya metoder eller medlemsvariabler. En klass i PHP är inte fast och bestämd, den kan modifieras efterhand. Det går att lägga till både medlemsvariabler och metoder, även om de inte finns med i klassens definition. Det kallas överlagring enligt PHP.

Säg att vi vill lägga till vissa förmågor till musen (CMouse) i exemplet i stycket ovan. Det kan fungera så här.

**Överlagring kan skapa nya medlemmar.**

```php
$mouse = new CMouse();

$mouse->Eat();
$mouse->Noice();
$mouse->speed = 'fast';
$mouse->size = 'small';
$mouse->weight = 0.5;

echo "<pre>";
var_dump($mouse);
echo "</pre>";
```

Varken speed, size eller weight finns med i klassdefinitionen för CMouse(eller CAnimal).

Utskriften från ett sådant testprogram kan se ut så här.

```text
I'm eating
Piip, piip

object(CMouse)#1 (3) {
  ["speed"]=>
  string(4) "fast"
  ["size"]=>
  string(5) "small"
  ["weight"]=>
  float(0.5)
}
```

Överlagring i PHP-klasser handlar alltså om att lägga till medlemmar dynamiskt.





17. Magiska metoder {#magic}
-----------------------------------------------------------------------------------------------

I PHP och klasser finns ett antal fördefinierade *magiska metoder*. De anropas vid speciella tillfällen och genom att implementera dem kan man få klassen att hantera vissa specialfall. En magisk metod börjar med två underscore. Metoderna för konstruktor och destruktor är alltså exempel på två magiska metoder, `__construct()` och `__destruct()`.

Du kan läsa mer om vilka [magiska metoder som finns i manualen](http://php.net/manual/en/language.oop5.magic.php). Men låt oss kika på några som kan vara bra att veta om.



###Magiska metoder `__call()` {#magic-call}

Metoden `__call()` invokeras när du anropar en icke-befintlig metod på ett objekt. Metoden `__callStatic()` invokeras när du anropar en icke-befintlig statisk metod i en klass. Det innebär alltså att du själv kan definiera dessa metoder för att ge ett standardbeteende när användare anropar en icke-befintlig metod på objektet, eller klassen.

Jag bygger vidare på klassen CAnimal och implementerar `__call()` på klassen.

**Definiera en egen `__call()` i CAnimal.**

```php
abstract class CAnimal {
  
  public function __call($method, $arguments) {
    echo "Calling object method '$method' "
         . implode(', ', $arguments). "<br/>";
  }

}

// Use the class
$mouse = new CMouse();

$mouse->Eat();
$mouse->Noice();
$mouse->Jump('high', 'with head first');
$mouse->Swim('fast');
```

Metoden `__call()` får två argument, det första är metodens namn och den andra är en array med argumenten som skickades till metoden.

Utskriften från detta programmet kan se ut som följer:

```text
I'm eating
Piip, piip
Calling object method 'Jump' high, with head first
Calling object method 'Swim' fast
```



###Magiska metoder `__set()` och `__get()` {#magic-set}

När det gäller medlemsvariabler så finns de magiska metoderna `__get()` och `__set()`. De anropas när du försöker läsa från, eller skriva till, en icke-existerande medlemsvariabel i en klass.

Du kan implementera dessa som felkontroller för att hantera om någon använder din klass på ett sätt som du inte tänkt, eller kan du hantera skapande och läsande av medlemsvariabler på ett dynamiskt sätt. Säg att du vill spara undan alla egenskaper hos djuret i en array, du vill slippa att deklarera alla medlemsvariabler i klassen. Jag säger inte att du ska göra så, det är ett exempel som visar hur du kan göra.

**Definiera `__set()` och `__get()`.**

```php
abstract class CAnimal {

  public $abilities = array();
  
  public function __set($name, $value) {
    $this->abilities[$name] = $value;
  }

  public function __get($name) {
    return isset($this->abilities[$name]) ? $this->abilities[$name] : null;
  }  

}

// Use the class
$mouse = new CMouse();

$mouse->Eat();
$mouse->Noice();
$mouse->speed = 'fast';
$mouse->size = 'small';
$mouse->weight = 0.5;

echo "<pre>";
var_dump($mouse->abilities);
echo "</pre>";
```

Utskriften från exemplet kan se ut så här:

```text
I'm eating
Piip, piip

array(3) {
  ["speed"]=>
  string(4) "fast"
  ["size"]=>
  string(5) "small"
  ["weight"]=>
  float(0.5)
}
```


18. Objekt och Interface {#interface}
-----------------------------------------------------------------------------------------------

Som tidigare nämnts så stödjer PHP inte multipelt arv. Att jobba med *interface* kan lösa en del av detta. Ett interface är en mall för en klass. En klass som *implementerar ett interface* lovar att implementera de funktioner som krävs av interfacet. Ett interface är ett kontrakt och klassen måste uppfylla det kontraktet för att kunna säga att det implementerar ett visst interface. 

Ett interface kan ge ett visst beteende, ett beteende som måste lösas på ett bestämt sätt. Den klassen som implementerar interfacet måste alltså implementera de metoder som specificeras av interfacet. Man använder interface för att vara tydlig och visa att en klass har vissa egenskaper.

Säg, för tydlighetens skull, så skapar vi ett interface ISingelton. Tanken är att alla klasser som implementerar designmönstret skall använda sig av interfacet. Det blir tydligt, alla klasser som implementerar designmönstret ser likadana ut och det är tydligt redan i klassens konstruktion vilket beteende och gränssnitt den har.

**Interface för ISingleton.**

```php
interface ISingleton {
  public static function Instance();
}
```

Interfacet säger alltså att den klass som implementerar interfacet måste implementera metoden `Instance()`, men det finns inget krav på hur implementationen skall se ut, bara på gränssnittet.

**Del av klass som implementerar interfacet ISingleton.**

```php
class CMySingleton implements ISingleton {

  private static $instance = null;

  public static function Instance() {
    return is_null(self::$instance) ? self::$instance = new self : self::$instance;
  }

}
```

Att använda interface ger alltså en tydlighet och styr upp de publika gränssnitten mellan klasserna.

Läs mer om [interface i manualen](http://php.net/manual/en/language.oop5.interfaces.php).



19. Traits {#traits}
-----------------------------------------------------------------------------------------------

Traits är en programmeringskonstruktion för att återanvända kod i programmeringsspråk som är begränsade till en arvshierarki. Det handlar om att lagra kod i en struktur som liknar en klass, men det kallas för *trait* och kan inkluderas i en eller flera klasser. Kod som lämpar sig i en trait är alltså kod som kan återanvändas mellan flera klasser.

För att fortsätta med vårt exempel på designmönstret singleton. Säg att vi vill implementera metoden `Instance()` i en trait och sedan återanvända den i alla klasser som implementerar interfacet ISingleton. Det kan se ut så här.

**En trait för singleton.**

```php
trait Singleton {

  private static $instance = null;

  public static function Instance() {
    return is_null(self::$instance) ? self::$instance = new self : self::$instance;
  }

}
```

Så ser alltså definitionen för en trait ut. Nu kan vi använda den i vår klass.

```php
class CMySingleton implements ISingleton {

  use Singleton;

}
```

Traits ger oss alltså en möjlighet att dela implementationen av kod, som återkommer i flera klasser.

Läs mer om [traits i manualen](http://php.net/manual/en/language.oop5.traits.php).



20. Mer OOPHP {#mer}
-----------------------------------------------------------------------------------------------

Detta var grunderna i objektorienterad PHP. Du kommer långt med grunderna. Underlaget till denna artikel är främst från manualen som beskriver de [objektorienterade konstruktionerna i PHP](http://php.net/manual/en/language.oop5.php).

Allt fick inte plats och det finns ett par närliggande konstruktioner som du kan vilka läsa på, bland annat om [Exceptions](http://php.net/manual/en/language.exceptions.php), [Standard PHP Library (SPL)](http://php.net/manual/en/book.spl.php) och [Namespaces](http://php.net/manual/en/language.namespaces.php).

Men någonstans skall man börja sin objektorienterade resa och med denna artikel har du gjort det, trevlig resa!



<!--

14. Object iteration {#alternativ-struktur}
-----------------------------------------------------------------------------------------------

16. Final keyword {#formular}
-----------------------------------------------------------------------------------------------

17. Object cloning {#sessioner}
-----------------------------------------------------------------------------------------------

18. Comparing objects {#header-func}
-----------------------------------------------------------------------------------------------

19. Type hinting {#funktioner}
-----------------------------------------------------------------------------------------------

-->



Referenser {#referenser}
------------------------

Följande är referenser som använts som fotnötter i texten.

[^1]: [Wikipedia om programmeringsparadigm](https://en.wikipedia.org/wiki/Programming_paradigm).

[^2]: [Wikipedia om "Procedural programmering"](https://en.wikipedia.org/wiki/Procedural_programming).

[^3]: [Wikipedia om objektorienterad programmering](https://en.wikipedia.org/wiki/Object-oriented_programming).

[^4]: [Wikipedia om histogram](http://sv.wikipedia.org/wiki/Histogram).

[^5]: [Wikipedia om tärning](https://sv.wikipedia.org/wiki/T%C3%A4rning).

[^6]: [Wikipedia om "Code Refactoring"](http://en.wikipedia.org/wiki/Code_refactoring).

[^7]: [Wikipedia om arv ("inheritance")](https://en.wikipedia.org/wiki/Inheritance_(computer_science)).

[^8]: [Smashing Magazine om CSS sprites](http://coding.smashingmagazine.com/2009/04/27/the-mystery-of-css-sprites-techniques-tools-and-tutorials/).

[^9]: [Wikipedia om Application Programming interface (API)](http://en.wikipedia.org/wiki/Application_programming_interface).

[^10]: [Wikipedia om att instansiera ett objekt](http://en.wikipedia.org/wiki/Instance_(computer_science)).

[^11]: [Wikipedia Unified Modelling Language (UML)](http://en.wikipedia.org/wiki/Unified_Modeling_Language).

[^12]: [Wikipedia Class diagram](http://en.wikipedia.org/wiki/Class_diagram).

[^13]: [Wikipedia Sequence diagram](http://en.wikipedia.org/wiki/Sequence_diagram).

[^14]: [Wikipedia om Don't Repeat Yourself (DRY)](http://en.wikipedia.org/wiki/Don%27t_repeat_yourself).

[^15]: [Wikipedia om design patterns (designmönster)](http://en.wikipedia.org/wiki/Software_design_pattern).
