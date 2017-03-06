---
author: mos
category:
    - databas
    - kurs dbjs
revision:
    "2017-03-06": (A, mos) Första utgåvan inför kursen dbjs.
...
Lagrade procedurer i databas
==================================

[FIGURE src=/image/snapvt17/lagrad-procedur.png?w=c5&a=0,20,70,0 class="right"]

Ibland räcker det inte till med SQL utan man behöver någon form av ytterligare programmeringsmässig hantering av informationen. Säg att man vill flytta pengar från ett konto till ett annat, men bara om det finns tillräckligt mycket pengar på kontot.

Man kan naturligtvis koda detta i godtyckligt externt programmeringsspråk. Men kan det finnas en möjlighet att koda sådant direkt i databasen?

Lagrade procedurer kommer till vår hjälp.

<!--more-->



Förutsättning {#pre}
--------------------------------------

Artiklen bygger löst vidare på det exemplet som beskrevs i artikeln "[Transaktioner i databas](kunskap/transaktioner-i-databas)".

Exemplet visar hur du jobbar med lagrade procedurer i MySQL.

SQLite stödjer inte lagrade procedurer.

[SQL-koden som visas i exemplet](https://github.com/dbwebb-se/dbjs/blob/master/example/sql/stored_procedure.sql) finner du på GitHub.



Att skriva små program i databasen {#prog}
--------------------------------------

Databasen MySQL stödjer något de kallar [compound statements i MySQL](https://dev.mysql.com/doc/refman/5.7/en/begin-end.html) som är det "programmeringsspråk" som används för att skriva lagrade procedurer, funktioner och triggers. Det är icke SQL-kod som kan användas tillsammans med ren SQL-kod.

Det ger oss en möjlighet att skriva små program i databasen.

Låt oss kika på hur en lagrad procedur kan se ut, skriven med både SQL och med compound statements.



Exampel {#exempel}
--------------------------------------

Vi tar samma exempel vi använde i "[Transaktioner i databas](kunskap/transaktioner-i-databas)". Adam och Eva skall flytta pengar mellan varandra. SQL-koden för exemplet ser ut så här.

```sql
--
-- Example transactions
-- 
DROP TABLE IF EXISTS Account;
CREATE TABLE Account
(
	`id` CHAR(4) PRIMARY KEY,
    `name` VARCHAR(8),
    `balance` DECIMAL(4, 2)
);

DELETE FROM Account;
INSERT INTO Account
VALUES
	("1111", "Adam", 10.0),
    ("2222", "Eva", 7.0)
;

SELECT * FROM Account;
```

Sen är det själva flytten av pengarna, från ett konto till ett annat, som är omslutet av en transaktion.

Eva skall få 1.5 pengar av Adam.

```sql
--
-- Move the money, within a transaction
--
START TRANSACTION;

UPDATE Account 
SET
	balance = balance + 1.5
WHERE
	id = "2222";

UPDATE Account 
SET
	balance = balance - 1.5
WHERE
	id = "1111";
    
COMMIT;

SELECT * FROM Account;
```

Vad kan en lagrad procedur göra för oss här?



En lagrad procedur för att flytta {#sp}
--------------------------------------

Vi kan bara flytta pengar om det finns några pengar. Vi behöver alltså kontrollera om Adam har så mycket pengar på kontot som han nu är benägen att flytta till Eva.

Men, detta är inget vi direkt kan skriva i SQL.

Nåväl, då gör vi en lagrad procedur som flyttar pengarna, förutsatt att de finns.



###CREATE PROCEDURE {#create}

För att skapa en lagrad procedur så omsluter vi dess kod på följande sätt, med en [`CREATE PROCEDURE`](https://dev.mysql.com/doc/refman/5.7/en/create-procedure.html).

```sql
--
-- Procedure moveMoney()
--
DROP PROCEDURE moveMoney;

DELIMITER //

CREATE PROCEDURE moveMoney(
	fromAccount CHAR(4),
    toAccount CHAR(4),
    amount NUMERIC(4, 2)
)
    -- Here comes SQL and compund statements
//

DELIMITER ;
```

Proceduren tar tre parametrar som berättar från konto, till konto och summan som skall flyttas.

Koden ändrar *delimiter* för att koden inuti den lagrade proceduren inte skall krocka med det semikolon som avslutar själva proceduren. Det finns även [beskrivet i manualen](https://dev.mysql.com/doc/refman/5.7/en/stored-programs-defining.html) om varför man gör så här.

Låt oss göra en minimal procedur för att anropa den, som ett litet test.

```sql
CREATE PROCEDURE moveMoney(
	fromAccount CHAR(4),
    toAccount CHAR(4),
    amount NUMERIC(4, 2)
)
BEGIN
    SELECT fromAccount, toAccount, amount;
END
//
```

Då anropar vi proceduren.

```sql
CALL moveMoney("1111", "2222", 1.5);
```

Resultatet blir att parametrarna skrivs ut i SQL-satsen, som en form av resultat från proceduren. En enkel procedur kan alltså vara att samla en eller flera SELECT-satser och skriva ut dem.

Bra, då kan vi skapa och anropa en lagrad procedur, och även skicka parametrar till den.



###Procedur för moveMoney {#move}

Då plockar vi in koden som flyttar pengarna, in i proceduren. Det kan se ut så här.

```sql
CREATE PROCEDURE moveMoney(
	fromAccount CHAR(4),
    toAccount CHAR(4),
    amount NUMERIC(4, 2)
)
BEGIN
    START TRANSACTION;

    UPDATE Account 
    SET
    	balance = balance + amount
    WHERE
    	id = toAccount;

    UPDATE Account 
    SET
    	balance = balance - amount
    WHERE
    	id = fromAccount;
        
    COMMIT;

    SELECT * FROM Account;
END
//
```

Nu kan jag anropa proceduren, om och om igen. Om jag kör den tillräckligt många gånger så kommer Eva att bli riktigt rik och Adam något fattig.

```sql
CALL moveMoney("1111", "2222", 1.5);
```

Att jag väljer att skriva ut behållningen i slutet med SELECT-satsen är bara för att det skall vara enklare att utveckla, det blir lite som en `console.log()` eller `echo`.

Så här långt har vi åstakommit en lagrad procedur som omsluter en större kodsekvens som jag troligen vill utföra många gånger. Det blir som ett API mot min databas. Om man vill flytta pengar mellan konton så är det rätta sättet att göra det via den lagrade proceduren, inte att skriva egen SQL-kod. Lagrade procedurer kan alltså vara ett sätt att bygga API mot databasen.

Men kom ihåg att lagrade procedurer och koden som skrivs inte är kompatibel mellan olika databasmotorer. Det kan vara en nackdel, eller inte.



Kolla om pengar finns {#kolla}
--------------------------------------

Då skall vi se om vi kan uppdatera den lagrade proceduren för att kontrollera att det verkligen finns pengar på kontot, innan flyttan av pengar utförs.

Det första jag vill ha är en lokal variabel som jag tänker fylla med nuvarande balans på kontot. Om balansen inte är tillräcklig så kommer jag att avbryta transaktionen med en ROLLBACK.



###Lokal variabel {#lokal}

Låt oss börja kika på den lokala variabeln `currentBalance` och hur den får sitt värde.

```sql
BEGIN
	DECLARE currentBalance NUMERIC(4, 2);
    
    START TRANSACTION;

	SET currentBalance = (SELECT balance FROM Account WHERE id = fromAccount);
    SELECT currentBalance;

    -- Some code omitted
```

Notera att den får sitt värde inuti transaktionen, för att även den delen skall kunna dra nytta av transaktionens atomära princip.



###IF-sats {#if}

Då kan vi skapa en if-sats som kontrollerar om nuvarande balansen är tillräcklig för att flytta pengarna.

```sql
IF currentBalance - amount < 0 THEN
    ROLLBACK;
    SELECT "Amount on the account is not enough to make the transaction.";

ELSE

    UPDATE Account 
    SET
        balance = balance + amount
    WHERE
        id = toAccount;

    UPDATE Account 
    SET
        balance = balance - amount
    WHERE
        id = fromAccount;
        
    COMMIT;

END IF;
```

Jag valde att omsluta koden i IF-satsen, det finns nämligen ingen `RETURN` i en lagrad procedur, vilket hade varit ett alternativ när man väl förstod att transaktionen inte kunde utföras.



SHOW PROCEDURE {#show}
--------------------------------------

När man vill se vilka procedurer som finns i databasen så kan man visa dem.

```sql
SHOW PROCEDURE STATUS;
```

Svaret blir en lista med alla de procedurer som finns och till vilken databas de är kopplade.

Vill du sedan titta på koden som ligger bakom den lagrade proceduren så frågar du efter den.

```sql
SHOW CREATE PROCEDURE moveMoney;
```

Fram kommer källkoden för proceduren.



Avslutningsvis {#avslutning}
--------------------------------------

Detta var grunderna i hur du kan jobba med lagrade procedurer som ett sätt att programmera i en databas. Kanske kan detta även vara ett sätt att bygga ett API mot en databas.

Har du [tips, förslag eller frågor om artikeln](t/6292) så finns det en specifik forumtråd för det.
