---
author: lew
revision:
    "2017-03-13": (A, lew) First version.
category:
    - oophp
...
Logga in med sessioner och cookies
===================================

[FIGURE src=/image/oophp/v3/login-top.png?w=c5 class="right"]

Vi ska titta närmare på sessioner och cookies och hur man kan skapa login-funktionalitet med hjälp av dem tillsammans med en databas.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du kan grunderna i php och du vet vad variabler, typer och funktioner innebär.  
Du har kännedom om SQL och databashantering.  
Du har gått igenom sessioner och cookies i artikeln "[Kom i gång med PHP på 20 steg](kunskap/kom-i-gang-med-php-pa-20-steg#sessioner)"



En klass för sessionen {#klass-session}
------------------------------

Jag väljer att skapa en klass `Session` som ska hantera sessionen. I många lägen klarar man sig med att använda $\_SESSION men det blir trevligt med en klass som hanterar funktionaliteten. En variant är att använda `static`-metoder i klassen. Då behöver den inte instansieras, utan kan användas rakt av:

```php
<?php

class Session {
    
    public static function start()
    {
        session_start();
    }
    
    public static function set($name, $val)
    {
        $_SESSION[$name] = $val; 
    }
}

// Use the class
Session::start();
Session::set("name", "John");

```

Smaken är som baken så jag väljer att instansiera min klass.



Så, vad behöver vi kunna göra i sessionen? Vi måste såklart kunna starta den, avsluta den, sätta och hämta variabler. Vi börjar med en konstruktor:

```php
<?php

class Session {
    private $name;
        
    public function __construct($name="MYSESSION")
    {
        $this->name = $name;
        
        $this->start();
    }
    
    public function start()
    {
        session_name($this->name);
        
        if (!empty(session_id())) {
            session_destroy();
        }    
        session_start();
    }
}

```

Konstruktorn tar emot ett argument, $name, som sätts till "MYSESSION" om inget annat anges. Det är enbart namnet på sessionen. Tanken är att start() ska sparka igång maskineriet. Det är möjligt att man vill hantera fler variabler än sessionens namn i konstruktorn i framtiden.  

Vi fyller på med resten av metoderna: 

```php
...

    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public function get($key, $default=false)
    {
        return (self::has($key)) ? $_SESSION[$key] : $default;
    }
            
    public function destroy() 
    {    
        session_destroy();
    }

```

Stiligt. Vad behöver vi mer? Jo, en databas...



Databasen {#databasen}
------------------------------

Vi kör på en SQLite-databas för enkelhetens skull. Jag väljer att skapa databasen med hjälp av [SQLite manager](kunskap/kom-igang-med-databasen-sqlite#sqliteman). Tabellen heter `users` och kolumnerna blir användarnamn och lösenord (`name`, `pass`).

Här är tanken att användarens namn ska lagras tillsammans med dennes krypterade lösenord. Vi ska sikta på att inte behöva hantera lösenordet i klartext, utan hela tiden jämföra den krypterade versionen med hjälp av php's inbyggda funktioner.

Jag sparar databasen i mappen `db` som `oophp.sqlite`. 



Hantera lösenord {#hantera-losenord}  
-------------------------------

Php har bra inbyggt stöd för att hantera lösenord och kryptering. I en labb i kursen htmlphp testar vi på lite kryptering. Det är dags att öppna locket och damma av den kunskapen nu. Ett test-script kan se ut så här:  
  
```php
<?php 

$pass = "test123";

// Kryptera lösenordet. PASSWORD_DEFAULT använder den starkaste algoritmen.
$crypt_pass = password_hash($pass, PASSWORD_DEFAULT);

// Hur ser hashen ut då? Den ser lite olika ut varje gång man kör den. 
echo "hashed password: " . $crypt_pass;

// Utskriften blir på ett ungefär: hashed password: $2y$10$.f7Occu3KqJgOEY12VSsIOHMVdCx632Efa9hQQQnAoLwEWfpPgtnK
```

Det är alltså informationen i `$crypt_pass` som vi sparar i databasen. När vi sedan ska jämföra värdet, gör vi det på följande sätt:

```php
$user_pass = "test123";

password_verify($user_pass, $crypt_pass); // Returnerar true om de är likadana, annars false.

```

Du kan läsa mer om password_hash [här](http://php.net/manual/en/function.password-hash.php).  



Puh...Det var det! Resten kvar.  



En klass för databaskopplingen {#databas-klass}
------------------------------

Vi kikar på en klass som hanterar databaskopplingen. Vi kör vidare med PDO som vi lärde oss i htmlphp. Om vi letar upp koden för anslutningen kan vi i stort sett stoppa den rakt in i en klass. På rätt plats förstås. En första ansats kan bli som följer:  
  
```php
<?php 

class Connect {
    private $db;
    
    public function __construct($dsn)
    {
        try {
            $db = new PDO($dsn);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $db;
        } catch (PDOException $e) {
            echo "Failed to connect to the database using DSN:<br>$dsn<br>";
        }
    }
    
    public function add_user($user, $pass)
    {
        $stmt = $this->db->prepare("INSERT into users (name, pass) VALUES ('$user', '$pass')");
        $stmt->execute();
    }
    
    public function get_hash($user)
    {
        $stmt = $this->db->prepare("SELECT pass FROM users WHERE name='$user'");
        $stmt->execute();
        
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $res["pass"];
    }
    
    public function change_password($user, $pass)
    {
        $stmt = $this->db->prepare("UPDATE users SET pass='$pass' WHERE name='$user'");
        $stmt->execute();
    }
    
    public function exists($user)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name='$user'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return !$row ? false : true;
    }
}

```

Inget nytt och inga konstigheter. Ta en extra minut och se över vad som händer i metoderna.  

...58...59...60...klar? Bra, då går vi vidare. 



Filerna {#filerna}
------------------------------

Nu har vi många pusselbitar på plats för att skapa ett egen variant av login-system, som även blir hyfsat säkert. Nästa steg blir att skapa de nödvändiga filerna. Vi ställer oss i roten.  

```bash
# Skapa filerna vi ska använda
$ touch login.php logout.php validate.php welcome.php 
```

Vad ska vi ha filerna till?  

| Fil           | Funktion                                  |
|---------------|-------------------------------------------|
| login.php     | Sidan som hanterar login-formuläret.      |
| logout.php    | Sidan som hanterar utloggningen.          |
| validate.php  | Processing-sida för formuläret.           |
| welcome.php   | Sidan man enbart kan nå om man loggar in. |



###login.php {#login}  

Vi behöver ett formulär som användaren kan använda för inloggning. Formulärets metod kan med fördel vara `POST` då vi inte vill visa lösenordet i webbläsarens adressfält.

```html
<!doctype html>
<head>
    <meta charet="utf-8">
    <title>Login</title>
</head>
<body>
    <form action="validate.php" method="POST">
        <table>
            <legend><h3>Login form</h3></legend>
            <tr>
                <td>Enter name:</td><td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Enter pass:</td><td><input type="password" name="pass"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submitForm" value="Login"></td>
            </tr>
        </table>
    </form>
</body>
</html>
```

Vi skickar formuläret till `validate.php` för vidare hantering. Överst i `login.php` behöver vi dock lägga till lite funktionalitet i form av php-kod:  

```php
<?php
// Include Session
require_once("Session.php");

// Start the session
$session = new Session("MYSESSION");

$user_loggedin = "";

// Make sure no one is logged in
if ($session->has("name")) {
    echo "<p>You are already logged in as " . $session->get('name') . "</p>";
    echo "<p><a href='logout.php'>Logout</a></p>";
    $user_loggedin = "disabled";
}

?>
```

Vi inkluderar sessionen och startar den. Vi gör sedan en kontroll om någon redan är inloggad och stänger då möjligheten att logga in igen. Lägg till `$user_loggedin` som attribut på input-elementen samt knappen:  

```html
...
<!-- $user_loggedin innehåller 'disabled' om någon är inloggad -->
<td>Enter name:</td><td><input type="text" name="name" <?=$user_loggedin?>></td>
...
<td>Enter pass:</td><td><input type="password" name="pass" <?=$user_loggedin?>></td>
...
<td><input type="submit" name="submitForm" value="Login" <?=$user_loggedin?>></td>
...
```

###logout.php {#logout}  





###validate.php {#validate}  





###welcome.php {#welcome}  





Avslutningsvis {#avslutning}
------------------------------

Det här var lite om grunderna av sessioner, cookies och hantering av lösenord. Läs gärna på mer om tillfälle ges.
