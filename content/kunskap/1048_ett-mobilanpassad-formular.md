---
author: efo
category: javascript
revision:
  "2017-03-15": (A, efo) Första utgåvan inför kursen webapp v2.
...
Ett mobilanpassad formulär
==================================

Vi ska i denna övning titta på hur vi med hjälp av HTML5 input göra våra mobila appar mer användarvänliga och säkra.


<!--more-->



HTML5 input typer {#html5}
--------------------------------------

I och med introduktionen av HTML5 introducerades även ett antal nya [input typer](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input). Dessa typer specificerar vilken sorts data som inputfältet kan ta som indata. Detta gör det möjligt att hindra användaren från att fylla i fel sorts data, men även att anpassa användargränssnittet till det data som användaren skall fylla i. Nedan finns en listning av 4 intressanta input typer och hur den mobila enheten anpassas för input typen.

Det helt vanliga text input fältet ger ett vanligt tangentbord och ingen klient validering av vilka värden som fylls i.

```html
<input type="text">
```

[FIGURE src="/image/snapvt17/input-text.png?w=200" caption="Text input"]



Om man har ett fält där användaren bara ska ange siffror kan man använda sig av `number`. Detta gör att tangentbordet på mobila enheter bytts ut mot ett numerisk och att det inte går att fylla i annat än karaktärar relaterade till siffror.

```html
<input type="number">
```

[FIGURE src="/image/snapvt17/input-number.png?w=200" caption="Number input"]



Om användaren skall fylla i sin e-postadress kan det vara bra med et input av typen `email`. Det underlättar för användaren när man skall använda @.

```html
<input type="email">
```

[FIGURE src="/image/snapvt17/input-email.png?w=200" caption="Email input"]



Vid ifyllning av telefonnummer kan det vara fördelaktigt att använda input av typen `tel`. Där får användaren upp ett numerisk tangetbord, som ser ut som det man använder när man skall ringa från en telefon.

```html
<input type="tel">
```

[FIGURE src="/image/snapvt17/input-tel.png?w=200" caption="Telephone input"]



Ett formulär i mithril {#mithril}
--------------------------------------

När vi skapar formulär i mithril användar vi oss som vanligt av `m` för att skapa våra virtuella noder. Längst ut lägger vi ett formulär element och inuti formulär elementet våra formulärfält. Vi användar oss av en livscykel metod `onsubmit` för formuläret för att förhindra att formuläret laddar om sidan när vi trycker på spara-knappen. För att de ändringar vi gör i formulärfältet ska sparas användar vi oss av livscykel metoden `oninput` och funktionen `m.withAttr` ([Dokumentation](http://mithril.js.org/withAttr.html)). `oninput` och `m.withAttr` sätter värdet på den nuvarande dator (`Computer.current`) varje gång vi ändrar i fältet. Livscykel metoden `onclick` används för spara knappen och när vi anropar modellens `save` funktion har vi redan satt värdet på den nuvarande dator och kan helt enkelt bara spara den med hjälp av `m.request` och api't som ligger i bakgrunden för appen.

```javascript
var m = require("mithril")
var Computer = require("../models/computer")

module.exports = {
    oninit: function(vnode) { Computer.load(vnode.attrs.id) },
    view: function() {
        return m("form", {
                onsubmit: function(event) {
                    event.preventDefault();
                } }, [
            m("label.label", "Name"),
            m("input.input[type=text][placeholder=Name]", {
                oninput: m.withAttr("value", function(value) { Computer.current.name = value }),
                value: Computer.current.name
            }),
            m("label.label", "Year"),
            m("input.input[type=number][placeholder=Year]", {
                oninput: m.withAttr("value", function(value) { Computer.current.year = value }),
                value: Computer.current.year
            }),
            m("button.button", { onclick: Computer.save }, "Save")
        ])
    }
}
```



Avslutningsvis {#avslutning}
--------------------------------------

Detta var en genomgång av ett antal olika input typer i HTML5, som ger bättre använderbarhet speciellt på mobila enheter. Genom att tala om vilken sorts data, som varje formulärfält är gjort för, kan den mobila enhet anpassa tangentbord och användargränssnitt för den specifika användningen.
