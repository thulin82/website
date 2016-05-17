---
author: lew
revision:
    "2016-04-12": (PA, lew) Pre-release.
category:
    - oopython
...
Sorteringsalgoritmer
===================================

[FIGURE src=/image/oopython/kmom05/soert_top.png?w=c5 class="right"]

De flesta programmeringsspråk har inbyggda sorteringsfunktioner. De använder antingen en specifik eller en kombination av flera sorterings algoritmer. Pythons sort()-metod använder till exempel [Timsort](https://en.wikipedia.org/wiki/Timsort) som är en blandning av "merge sort" och "insertion sort". Vi ska titta närmare på de vanligaste sorteringsalgoritmerna och se hur de är impementerade och vad som kan dölja sig bakom exempelvis `array.sort()`.

<!--more-->



Förutsättning {#pre}
-------------------------------

Du kan grunderna i Python och du vet vad variabler, typer och funktioner innebär.



De vanligaste sorteringsalgoritmerna {#de-vanligaste-sorteringsalgoritmerna}
------------------------------

###Quick sort {#quick-sort}  

Quick sort använder sig utav ett [pivot-värde](https://en.wikipedia.org/wiki/Quicksort#Choice_of_pivot). Efter valet av pivot är gjort så delar man upp listan i två delar. Den ena delen hanterar värdena som är mindre än pivot och den andra delen hanterar värdena som är större än pivot. Quick sort arbetar med fördel rekursivt där varje anrop till funktionen hanterar ett nytt pivot-värde baserat på den nya listan som skickats in. Bas-fallet är när listans längd har nått 1. Till slut så slår man samman de tre delarna.  

```python
def quick_sort(items):
    """ Quick sort """
    if len(items) > 1:
        pivot_index = len(items) // 2
        smaller_items = []
        larger_items = []

        for i, val in enumerate(items):
            if i != pivot_index:
                if val < items[pivot_index]:
                    smaller_items.append(val)
                else:
                    larger_items.append(val)

        quick_sort(smaller_items)
        quick_sort(larger_items)
        items[:] = smaller_items + [items[pivot_index]] + larger_items

    return items
```

Här används `//` för att returnera en integer. (Enkel division `/` kan returnera en float). Även "enumerate()" för att loopa igenom listan med hjälp av tuples (i, val).  

[Quick sort dance](https://www.youtube.com/watch?v=3San3uKKHgg)



###Bubble sort {#bubble-sort}  

Bubble sort är en av de enklaste sorteringsalgoritmerna, både att implementera och att förstå. Det största (eller minsta) värdet "bubblas" upp i listan följt av det näst största värdet. Varje "bubbla" går igenom hela listan en gång. En implementation kan se ut som följer:  

```python
def bubble_sort(items):
    """ Bubble sort """
    for i in range(len(items)):
        for j in range(len(items)-1-i):
            if items[j] > items[j+1]:
                items[j], items[j+1] = items[j+1], items[j]     # Byt plats

    return items
```  

Som ni ser så går bubble sort utmärkt att implementera utan rekursiv metod. Här används istället en nästad for-loop.

[Bubble sort dance](https://www.youtube.com/watch?v=Iv3vgjM8Pv4)



###Insertion sort {#insertion-sort}  

Insertion sort använder en osorterad lista och en sorterad lista. Värdet från den osorterade listan sätts in i den sorterade listan på rätt plats. Värdena i den sorterade listan flyttas baserat på det nya värdet som ska placeras på rätt plats. Då båda listorna är lika stora så samma lista representera båda fallen:  

```python
def insertion_sort(items):
    """ Insertion sort """
    for i in range(1, len(items)):
        j = i
        while j > 0 and items[j] < items[j-1]:
            items[j], items[j-1] = items[j-1], items[j]
            j -= 1

    return items
```

[Insertion sort dance](https://www.youtube.com/watch?v=ROalU379l3U)  



###Merge sort {#merge-sort}  

Merge sort fungerar snarlikt quick sort. Den använder också ["divide and conquer"-metoden](https://en.wikipedia.org/wiki/Divide_and_conquer_algorithms) med att dela upp listan till fler och sortera del-listorna separat, baserat på ett pivotvärde. Merge sort använder rekursion för att sortera del-listorna och när listan är nere på en längd av 1 ses den som klar.

```python
def merge_sort(items):
    """ Merge sort """
    if len(items) > 1:

        mid = len(items) // 2        # Dela vid mitten
        left = items[0:mid]
        right = items[mid:]

        merge_sort(left)            # Sortera den vänstra listan "in-place"
        merge_sort(right)           # Sortera den högra listan "in-place"

        l, r = 0, 0
        for i in range(len(items)):     # Sätt ihop båda listorna

            lval = left[l] if l < len(left) else None
            rval = right[r] if r < len(right) else None

            if (lval is not None and rval is not None and lval < rval) or rval is None:
                items[i] = lval
                l += 1
            elif (lval is not None and rval is not None and lval >= rval) or lval is None:
                items[i] = rval
                r += 1

    return items
```

[Merge sort dance](https://www.youtube.com/watch?v=XaqR3G_NVoo)



Avslutningsvis {#avslutning}
------------------------------

Bra finish, länka till forumtråd eller liknande?
