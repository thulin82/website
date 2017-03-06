---
author: mos
category:
    - databas
    - kurs dbjs
revision:
    "2017-03-06": (A, mos) Första utgåvan inför kursen dbjs.
...
Triggers i databas
==================================

[FIGURE src=/image/snapvt17/triggers.png?w=c5&a=0,50,0,0 class="right"]

Ibland vill man att en händelse skall trigga en annan. Säg att man flyttar pengar mellan konton (i en bank) och man vill att varje sådan flytt skall loggas i en loggtabell.

En flytt, eller en UPDATE av kontotabellen skall trigga igång en händelse som loggar information till loggtabellen.

Till vår hjälp kommer triggers.

<!--more-->



Förutsättning {#pre}
--------------------------------------

Artiklen bygger löst vidare på det exemplet som beskrevs i artikeln "[Lagrade procedurer i databas](kunskap/lagrade-procedurer-i-databas)".

Artikeln visar grunderna i [triggers i MySQL](https://dev.mysql.com/doc/refman/5.7/en/triggers.html).

Om du jobbar i [SQLite så fungerar triggers](https://www.sqlite.org/lang_createtrigger.html) även där.

[SQL-koden som visas i exemplet](https://github.com/dbwebb-se/dbjs/blob/master/example/sql/triggers.sql) finner du på GitHub.



Nuvarande exempel {#ex}
--------------------------------------

Låt oss kika på vårt nuvarande exempel som är en lagrad procedur som flyttar pengar mellan två konton, förutsatt att det finns pengar.

Följande kod skapar tabell och innehåll.

```sql
--
-- Example
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

Sedan har vi den lagrade proceduren som utför flytten mellan två konton, i skydd av en transaktion.

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
BEGIN
	DECLARE currentBalance NUMERIC(4, 2);
    
    START TRANSACTION;

	SET currentBalance = (SELECT balance FROM Account WHERE id = fromAccount);
    SELECT currentBalance;

	IF currentBalance - amount < 0 THEN
		ROLLBACK;
        SELECT "Amount on the account is not enough to make transaction.";

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

    SELECT * FROM Account;
END
//

DELIMITER ;

CALL moveMoney("1111", "2222", 1.5);
```

Låt det vara vår startpunkt när vi nu går vidare och bygger ut exemplet med en loggtabell.



En tabell för loggar {#logg}
--------------------------------------

Tanken är att vi har en tabell som loggar alla förändringar i tabellen Account. På det viset kan man se samtliga förändringar i balansen och återskapa alla transaktioner som skett.

Det kan vara bra att ha om något går snett. Som felsökning och extra kontroll. Det låter som en bra grej, speciellt när pengar eller annan känslig data är inblandad.

Vi behöver en loggtabell.

```sql
--
-- Log table
--
DROP TABLE IF EXISTS AccountLog;
CREATE TABLE AccountLog
(
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
    `when` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `what` VARCHAR(20),
    `account` CHAR(4),
    `balance` DECIMAL(4, 2),
    `amount` DECIMAL(4, 2)
);

DELETE FROM AccountLog;
SELECT * FROM AccountLog;
```

Det blir en tabell med autoincrementerande id och en kolumn som automatiskt loggar en tidsstämpel för när en rad läggs till i tabellen. I övrigt så loggar vi en anledning till förändringen tillsammans med kontot och det belopp som förändras.

Bra, då är det bara att börja logga.



Logga MED SQL i den lagrade proceduren {#loggasp}
--------------------------------------

Bara som ett exempel, innan jag visar triggern, så visar jag hur jag kan utföra loggningen i den lagrade proceduren.

Det handlar om att utföra följande INSERT inom ramen för den lyckade transaktionen.

```sql
INSERT INTO AccountLog (`what`, `account`, `amount`)
VALUES
    ("moveMoney from", fromAccount, -amount),
    ("moveMoney to", toAccount, amount);
```

Det är en enkel INSERT-sats som lägger till två rader, en rad för varje förändring som gjorts. I den lagrade proceduren kan jag lägga koden direkt innan COMMIT.

Här väljer jag att inte logga nuvarande balans för kontona, det hade krävt att jag läste av balansen på kontona i en SELECT-sats.

Jag vill logga saker, men inte krångla alltför mycket.



Logga med triggers {#loggatri}
--------------------------------------

Låt oss nu se hur vi kan göra samma sak med en databastrigger. Vi kopplar en trigger till Account-tabellen och vid varje UPDATE på Account så lägger vi till en ny rad i AccountLog-tabellen.

En [trigger](https://dev.mysql.com/doc/refman/5.7/en/create-trigger.html) alltså.

```sql
--
-- Trigger for logging updating balance
--
DROP TRIGGER IF EXISTS LogBalanceUpdate;

CREATE TRIGGER LogBalanceUpdate
AFTER UPDATE
ON Account FOR EACH ROW
    INSERT INTO AccountLog (`what`, `account`, `balance`, `amount`)
        VALUES ("trigger", NEW.id, NEW.balance, NEW.balance - OLD.balance);
```

Vad vi ser är en trigger som utförs varje gång någon gör UPDATE på tabellen Account.

Triggern tar emot samtliga rader som är på gång att uppdateras, det kan vara flera rader som uppdateras på en gång. I en loop får vi då möjlighet att utföra compound statements.

I mitt exempel är det bara en INSERT-sats som jag utför i bodyn, så jag behöver inte ändra delimiter som jag gjorde i exemplet med lagrade procedurer.

När man är inne i triggern, inuti loopen, så har man tillgång till den nya raden `NEW` som är den som skall bli, man har också tillgång till den gamla raden `OLD`, den befintliga raden som är på väg att uppdateras.

Det visade sig vara enklare att logga nuvarande balans i en trigger, vi hade tillgång både till den befintliga balansen och den uppdaterade balansen. Här gäller det bara att välja den som är mest logisk i sammanhanget. Som du ser så valde jag `NEW.balance`, den uppdaterade balansen.

I triggern kan jag välja att den skall exekveras före (BEFORE) eller (AFTER) själva uppdateringen är gjord. Ibland spelare det ingen roll, som i vårt exempel, men ibland kan det spela roll. Ett exempel på en BEFORE trigger kan vara en valideringstrigger som kontrollerar om en ändring kan utföras.

Vi gjorde en UPDATE trigger. Man kan även göra trigger som agerar på INSERT och/eller DELETE. I en INSERT trigger har man enbart tillgång till `NEW` och i en DELETE trigger når man endast `OLD`. Men det kanske säger sig självt, om man funderar på det.

Flytta nu lite pengar mellan dina konton för att se att det fungerar med loggningen.

```sql
CALL moveMoney("1111", "2222", 1.5);
```

Kontrollera att loggningen fungerar genom att kika i loggtabellen. Troligen får du nu loggar både från den lagrade proceduren och från triggern. Dubbellogging. Du kan uppdatera din lagrade procedur och ta bort loggningen därifrån, du har ju din trigger som löser detta nu.



SHOW TRIGGERS {#show}
--------------------------------------

När man vill se vilka triggers som finns i databasen, och hur de är definierade, så kan man visa dem.

```sql
SHOW TRIGGERS;
```

Svaret blir en lista med triggers och definitionerna för dem.

Eftersom triggers inte "syns" utan de bara verkställer i bakgrunden, så kan det ibland vara lätt att glömma bort att de finns där, i bakgrunden, och utför ett jobb.

Glöm inte bort `SHOW TRIGGERS` för att se vilken eventuell magi som kan dölja sig bakom den vanliga SQL-koden.



Avslutningsvis {#avslutning}
--------------------------------------

Detta var grunderna i hur triggers fungerar och hur du skapar dem. Kanske kan triggers vara ett sätt att hålla konsistens i din databas och ett sätt att få saker att hända utan att exekvera SQL-kod från klientprogrammen.

Liksom lagrade procedurer erbjuder även triggers ett sätt att tänka i form av API mot en databas. Triggern kan ju utföra flera uppdateringar som användaren inte behöver fundera på.

Det kan vara en nackdel när en databas blir alltför magisk och automatisk. Saker händer utan att man har kol på vad som sker. Felsökningen blir mer utmanande när man behöver ha koll på alla triggers som ligger i bakgrunden.

Har du [tips, förslag eller frågor om artikeln](t/6293) så finns det en specifik forumtråd för det.
