Základní business objekty / pojmy s nimiž se pracuje.

Zdroje:
* https://www.pirati.cz/rules/ropr
* https://www.pirati.cz/rules/prah

#Rozpočet

Rozpočet přísluší nějaké **rozpočtové jednotce** (centrála, konkrétní krajské sdružení, konkrétní místní sdružení), z čehož vyplývají nějaké **schvalující orgány** (centrála: republikové předsednictvo a republikový výbor, sdružení: fórum sdružení a předsednictvo sdružení). Rozpočet je určen pro nějaké **rozpočtové období**, odpovídající kalendářnímu roku.

Rozpočet by měl obsahovat datum schválení rozpočtu daným schvalujícím orgánem a odkaz na takové schválení. Dále datum registrace rozpočtu finančním odborem.

Rozpočet se skládá z jednotlivých **rozpočtových položek**.

Rozpočet bůže ještě obsahovat nějaké doplňující informace (financovní salda apod.) - řešit prostým textem.

##Rozpočtové položky

Položky jsou tří **druhů**; *příjmové*, *výdajové* a *položky salda*; Položky salda mohou být buď *přebytkové*, nebo *schodkové*.

Každá položka má svůj vymezující **název**, rozpočtový **limit**, s položkou **hospodařící tým** (seznam osob/uživatelů? Přebírat z LDAP?) a **datum registrace** rozpočtové položky finančním odborem.

U každé položky může být dále nepovinně uveden **účel peněz**(viz záměry?), případně **vazba**(odkaz) na jinou položku.
Vazby existují toliko mezi příjmovými a výdajovímy položkami.

### Příjmové položky
V (některých) příjmových rozpočtových položkách by se mělo sledovat jejich plnění z účtu(účtů). 

Pokud plnění příjmové položky přesáhne její rozpočtový limit, je třeba:
a) zvýšit limit této položky na její plnění
b) pokud má položka vazbu na výdajovou položku, zvýšit o tento rozdíl(mezi původním a novým limitem) limit navázané výdajové položky. (nice to have: Pokud existuje vazeb více, rozděl rozdíl rovnoměrně mezi vázané výdajové položky) 
c) pokud položka nemá vazbu, zvýší se o tento rozdíl limit rezervy daného rozpočtu
d) (nice to have:) pokud by tímto zvýšením měla rezerva přesáhnout 1/5 rozpočtu, zvýší se o tento rozdíl přebytek daného rozpočtu

### Výdajové položky
Výdajové položky jsou ty, z nichž čerpá. 
U výdajových položek může být navíc uveden **Hospodář položky**. Nice to have: Pokud uveden není považuje se za hospodáře vedoucí hospodařícího týmu (LDAP).

Výdajové položky by měli zobrazovat seznam příslušných žádostí, včetně jejich stavu a seznam příslušných záměrů, včetně jejich stavu.

Viz žádosti o proplacení.

#### Rezerva předsednictva
Speciálním typem výdajové rozpočtové položky je rezerva předsednictva.

Rezerva předsednictva může být v každém rozpočtu pouze jedna. Limit rezervy nesmí nikdy přesahovat pětinu celkové velikosti rozpočtu. Z rezervy předsednictva nelze čerpat.

### Položky schodku
Z položek schodku též nelze čerpat.

## Rozpočtové kapitoly
Nice to have: Rozpočtové položky mohou být uvnitř rozpočtu v rámci jednoho druhu uspořádány do stromové struktury rozpočtových kapitol. Nejvyššími kapitolami každého rozpočtu by měla být přijmová rozpočtová kapitola, výdajová rozpočtová kapitola a schdková rozpočtová kapitola.

## Rozpočtové změny
Nice to have: Ke každému rozpočtu by měl být též **seznam změn**. (Změna se skládá z informace o datumu provedení změny, typu změny, u některých typů odkazu na rozhodnutí, a seznamu položek jejichž limit byl touto změnou upraven.)

# Záměry
Záměr má unikátní **název**, případně doplňující **popis**, **limit** a svého **Hospodářa záměru**. (Hospodářem záměru může být kdokoliv - kdokoliv si může nějaký založit.)

Nice to have: Záměr by dále měl obsahovat seznam *příslušných výdajových položek záměru*. (Všechny položky vy měli být z jednoho rozpočtu.) Pro každou tuto položku by měl záměr obsahovat souhlas hospodáře dané položky. (Doplňovat automaticky, pokud zakládající hospodář je ten samej.)

Pokud je limit záměru do 5 000,- včetně, je pro schválení třeba souhlasu Hospodáře alespoň jedné položky. - pokud je vyřešen předchozí odstavec, netřeba implementovat.
Pokud je limit záměru do 50 000,- včetně, je pro schválení třeba usnesení schvalujícího předsednictva (viz rozpočet).
Pokud je limit záměru nad 50 000,- je pro schválení třeba usnesení schvalujícího orgánu (viz rozpočet, zadávají odkazem pověřené osoby - předsedající.)

Potřebujeme vědět **stav záměru** - zda je záměr *schválen* (schválení Hospodářů položek + schválení schvalují), případně, jestli je *ukončen* (i před vyčerpáním - může rozhodnout Hospodář záměru, nebo schvalující orgán).

Záměr by běl zobrazovat seznam příslušných výdajů s jejich částkou a stavem.

# Žádost o proplacení

Žádost o proplacení podáva kdokoliv libovolné registrované výdajové položky. Žádost o proplacení obsahuje:
* Nice to have: Do žádosti by měl zadat **zákonný druh výdaje**(z číselníku: Volební výdaje, mzdové výdaje, provozní výdaje, daně a poplatky), případně podrobnější třídění dle podkladů FO.
* **Příslušný záměr** - vybírá se záměrů příslušných dané položce. (Nice to have: Pro hospodáře položek možnost jej rovnou odsud založit.)
* **Souhlas** hospodáře záměru + Datum souhlasu
* **Doklad**
* **Částku**
* **Poznámky žadatele** - může editovat i hospodář záměru a FO
* **Poznámky FO** - může editovat FO
* **Datum podání**
* **Datum proplacení**
* další údaje potřební k provedení platby (osoba, účet, SS, VS, ...)

Každá žádost by měla mít svůj **stav** - *podáno* -> *schváleno* / *zamítnuto* -> *připraveno k proplacení* -> *proplaceno* / *zamítnuto*

Žádost by se měla automaticky přesunout ze stavu **podáno** do **schváleno**, pokud na ni dá Hospodář záměru souhlas. To by mělo být možné pouze pokud je ještě dostatek prostředků v limitu záměru.

Žádost by se měla automaticky přepnout ze stavu **schváleno** do **připraveno k proplacení**, pokud - má doklad, v rozpočtové položce jsou prostředky k proplacení(proplacení částky nepovede k překročení limitu), v záměru je vyhrazeno dostatek prostředků(proplacení částky nevede k překročení limitu).

## Vnitřní převod
Nice to have: Vnitřní převod je typ žádosti o proplacení, je tak označen, neobsahuje doklad a nemusí obsahovat údaje o platbě. Kromě výdajové položky z níž je placeno obsahuje i položku, do níž má bát převedeno.
