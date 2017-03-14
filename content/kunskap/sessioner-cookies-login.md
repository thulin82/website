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
$ touch login.php validate.php create_user.php handle_new_user.php logout.php welcome.php 
```

Vad ska vi ha filerna till?  

| Fil           | Funktion                                  |
|---------------|-------------------------------------------|
| login.php     | Sidan som hanterar login-formuläret.      |
| config.php     | Konfigurationsfil. Inkluderas i alla sidor.|
| validate.php  | Processing-sida för inloggningsformuläret.|
| create_user.php  | Formulär för skapande av användare     |
| handle_new_user.php  | Processing-sida för ny användare.  |
| logout.php    | Sidan som hanterar utloggningen.          |
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

###config.php {#config}

Nu är det ett bra läge att tänka på DRY kod. Vi kommer behöva ansluta till databsen samt starta sessionen ett flertal gånger. Vi lägger till det i `config.php`, så kan vi bara inkludera den i övriga filer. Smart. 

```php
<?php
// Include Session
require_once("Session.php");
require_once("Connect.php");

$fileName = __DIR__ . "/db/oophp.sqlite";
$db = new Connect("sqlite:$fileName");

// Start the session
$session = new Session("MYSESSION");
```

Nu har vi tillgång till `$session` och `$db` om vi vill. Vi går tillbaka till `login.php` och lägger till lite funktionalitet:  

```php
<?php
// Include config
require_once("config.php");

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
<!-- $user_loggedin holds 'disabled' if someone is logged in -->
<td>Enter name:</td><td><input type="text" name="name" <?=$user_loggedin?>></td>
...
<td>Enter pass:</td><td><input type="password" name="pass" <?=$user_loggedin?>></td>
...
<td><input type="submit" name="submitForm" value="Login" <?=$user_loggedin?>></td>
...
```

Vi skickar formuläret till `validate.php` för vidare hantering. 



###validate.php {#validate}  

Formuläret skickas hit, till `validate.php` för hantering av de inkomna variablerna. Här behöver vi vår databasklass och sessionsklassen.

```php
<?php
// Include config
require_once("config.php");

// Handle incoming POST variables
$user_name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : null;
$user_pass = isset($_POST["pass"]) ? htmlentities($_POST["pass"]) : null;


// Correspond according to input
// Check if both fields are filled
if ($user_name != null && $user_pass != null) {
    // Check if username exists
    if ($db->exists($user_name)) {
        $get_hash = $db->get_hash($user_name);
        // Verify user password
        if (password_verify($user_pass, $get_hash)) {
            $session->set("name", $user_name);
            header("Location: welcome.php");
        } else {
            // Redirect to login.php
            echo "User name or password is incorrect. <a href='login.php'>Try again.</a>";
        }
    } else {
        // Redirect to login.php
        echo "No such user. <a href='login.php'>Try again.</a>";
    }
}
?>
```

Kika igenom koden och se hur klasserna underlättar hanteringen.  

Bra. Nu kan vi logga in. Men vi måste ju ha någon användare i databasen. Vi ordnar en möjlighet att skapa en användare. 



###create_user.php {#create-user}  

Här passar det bra med ett formulär till. Vi skickar det till en egen processing-sida, `handle_new_user.php`. Man kan såklart trycka ihop viss kod och då minska antalet filer. Välj själv vad du tycker passar bäst. 

Om vi återgår till användarskapandet kan filen se ut som följer. Ett enkelt formulär:  

```html
<!doctype html>
<head>
    <meta charet="utf-8">
    <title>Create user</title>
</head>
<body>

    <form action="handle_new_user.php" method="POST">
        <table>
            <legend><h3>Create user</h3></legend>
            <tr>
                <td>Enter name:</td><td><input type="text" name="new_name"></td>
            </tr>
            <tr>
                <td>Choose pass:</td><td><input type="password" name="new_pass"></td>
            </tr>
            <tr>
                <td>Re-enter pass:</td><td><input type="password" name="re_pass"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submitCreateForm" value="Create"></td>
            </tr>
        </table>
    </form>
    <p><a href='login.php'>Back to login</a></p>
    
</body>
</html>
```

Vi ska skicka lösenordet så vi använder återigen metoden POST. Användaren måste även skriva in sitt lösenord två gånger. Sedan skickar vi informationen till `handle_new_user.php`.  



###handle_new_user.php {#handle-user}  

Precis som i `validate.php` så använder vi här databasklassen och sessionsklassen för att styra upp hanteringen. 

```php
<?php
/// Include config
require_once("config.php");

// Handle incoming POST variables
$user_name = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
$user_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
$re_user_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;

// Check if username exists
if (!$db->exists($user_name)) {
    // Check passwords match
    if ($user_pass != $re_user_pass) {
        echo "Passwords do not match!";
        header("Refresh:2; create_user.php");
    } else {
        // Make a hash of the password
        $crypt_pass = password_hash($user_pass, PASSWORD_DEFAULT);
        
        // Add user to database
        $db->add_user($user_name, $crypt_pass);
        
        echo "<p>Successfully added " . $user_name . "!</p><p><a href='login.php'>Login</a></p>";
    }
} else {
    echo "User already exists! Choose another username.";
    header("Refresh:2; create_user.php");
}
```

Som du märker har vi en del kod återupprepas och som med fördel kan flyttas till en konfigurationsfil. Man kan även hasha namn och lösenord tillsammans, `$crypt_pass = password_hash($user_name . $user_pass, PASSWORD_DEFAULT);`. Gör som du känner fungerar bäst. Nu kan vi skapa ett par användare.  

Vi kikar på hur tabellen kan se ut:

[FIGURE src=/image/oophp/v3/users.png]

Nu har vi några användare med krypterade lösenord. Vi har även undvikit att hantera lösenordet i klartext. Om du någon gång klickar på "Glömt lösenordet?" och det skickas till dig i klartext, ska du fundera på hur säkerheten ser ut hos dem.  

Tillbaka till ämnet! Vi måste ju kunna logga ut också.  



###logout.php {#logout}  

Vi använder våra metoder i sessionsklassen. Vi gör några kontroller på om en användare är inloggad och om sessionen verkligen finns.

```php
<?php
// Include config
require_once("config.php");

// Check if someone is logged in
if ($session->has("name")) {
    $session->destroy();
} else {
    echo "<p>No active user.</p>";
    echo "<p><a href='login.php'>Login again.</a></p>";
    die();
}

// Check if session is active
$has_session = session_status() == PHP_SESSION_ACTIVE;

if (!$has_session) {
    echo "<p>The session no longer exists. You have successfully logged out!</p>";
}

echo "<p>Destroyed session.</p>";

echo "<a href='login.php'>Login again.</a>";
?>
```

`session_status()` kan returnera tre saker.  

| Returvärde           | Betydelse                                      |
|----------------------|------------------------------------------------|
| PHP_SESSION_DISABLED | Sessioner är avstängda.                        |
| PHP_SESSION_NONE     | Sessioner är tillgängliga, men det finns ingen.|
| PHP_SESSION_ACTIVE   | Sessioner är tillgängliga och det finns en.    |

Bra, nu har vi koll på det. Nu återstår bara `welcome.php`. Tanken är att man inte ska kunna nå den om man inte är inloggad. Vi tar en titt på hur det kan se ut.



###welcome.php {#welcome}  

Det är egentligen en kontroll som behövs. "Finns det en användare aktiv? Om inte - gör en redirect.":  

```
if (!$session->has("name")) {
    header("Location: login.php");
}

// Resten av sidan
```

Ett försök till en testsida kan se ut så här:  

```php
<?php
// Include config
require_once("config.php");

if (!$session->has("name")) {
    header("Location: login.php");
}

$last_visit = isset($_COOKIE[$session->get('name') . '_timestamp']) ? $_COOKIE[$session->get('name') . '_timestamp'] : "First visit!";

echo "<h1>Welcome!</h1>";

echo "<p>You are logged in as " . $session->get('name') . "</p>";

echo "<p>Last visit: " . $last_visit . "</p>";

echo "<p><a href='info.php'>View session</a></p>";

echo "<p><a href='logout.php'>Logout</a></p>";

echo "<p><a href='change_password.php'>Change password</a></p>";

?>
```

Som du kan se har vi `$last_visit`. Det är en [cookie](kunskap/kom-i-gang-med-php-pa-20-steg#cookie) som jag valt att spara undan. När användaren loggar ut, sparas en cookie med namn och klockslag. Filen lagras lokalt på datorn i 30 dagar och kan då användas när man loggar in igen. Vill man lägga till sparandet av cookies, lägger man till följande i metoden destroy() i `Session.php`:  

```php
// Set cookie, exists 30 days
setcookie($this->get("name") . "_timestamp", date("d-m-Y h:i:s"), time()+86400*30);
```

Filen `info.php` skriver ut variablerna $\_SESSION och $\_COOKIE. Inga konstigheter. 

Det finns även en möjlighet att byta lösenord om man är inloggad. Det rör den sista delen av artikeln.



###change_password.php {#change-password}  

Vi har redan metoden klar i klassen Connect. Vi skapar filen `change_password.php` och tittar på hur det kan se ut i den:  

```php
<?php 
// Include config
require_once("config.php");

$user = $session->get("name");
$status = "Change password";

// Handle incoming POST variables
$old_pass = isset($_POST["old_pass"]) ? htmlentities($_POST["old_pass"]) : null;
$new_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
$re_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;

// Check if all fields are filled
if ($old_pass != null && $new_pass != null && $re_pass != null) {
    // Check if old password is correct
    if (password_verify($old_pass, $db->get_hash($user))) {
        // Check if new password matches
        if ($new_pass == $re_pass) {
                $crypt_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                $db->change_password($user, $crypt_pass);
                $status = "Password changed.";
        } else {
            $status = "The passwords do not match.";
        }
    } else {
        $status = "Old password is incorrect.";
    }
} else {
    $status = "All fields must be filled.";
}

?>

<!doctype html>
<head>
    <meta charet="utf-8">
    <title>Change password</title>
</head>
<body>
    <form action="change_password.php" method="POST">
        <table>
            <legend><h3><?=$status?></h3></legend>
            <tr>
                <td>Old pass:</td><td><input type="password" name="old_pass"></td>
            </tr>
            <tr>
                <td>New pass:</td><td><input type="password" name="new_pass"></td>
            </tr>
            <tr>
                <td>Re-enter pass:</td><td><input type="password" name="re_pass"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submitForm" value="Change password"></td>
            </tr>
        </table>
    </form>
    <p><a href='login.php'>Back to login</a></p>
    
</body>
</html>
```

Här valde jag att ha allt i samma fil, men återigen - strukturera på ett sätt som fungerar för dig. 



Avslutningsvis {#avslutning}
------------------------------

Tillslut har vi ett litet fungerande inloggningssystem. Om du följer artikeln - sikta på att göra koden DRY och återanvänd koden om möjligt.
