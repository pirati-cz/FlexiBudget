FlexiBudget
===========


_Softwarová podpora finančního odboru a transparence u Pirátů_

Proces schvalování faktur:

  *  Je zadána **žádost o proplacení** (záměr na fakturu, předběžná faktura), to může zadat poměrně široká skupina lidí (LDAP skupina 100+)
  *  **Hospodář kapitoly zkontroluje věcnou správnost** (správná rozpočtová položka, výdaj je předem domluvený, přiměřený, zboží bylo doručeno etc.)
  *  Hospodář nechá žádost **schválit příslušným orgánem** (hospodář, RP, RV, kraj dle částky)
  *  Po úspěšném schválení hospodář **předává žádost FO**
  *  **FO provede kontrolu**, problémy řeší s hodpodářem.
  *  FO dává **příkaz k proplacení** a **zanáší fakturu do účetnictví** (popřípadě jí z předběžné mění na zaúčtovanou)

 
Database Init
=============

    su postgres
    psql 
    CREATE USER flexibudget WITH PASSWORD 'flexibudget';
    CREATE DATABASE flexibudget OWNER flexibudget;
    \q
    vendor/bin/phinx migrate
    
Testovací data:

    vendor/bin/phinx seed:run -v

Konfigurace
-----------

dpkg-reconfigure flexibudget

