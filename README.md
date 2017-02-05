FlexiBudget
===========


_Softwarová podpora finančního odboru a transparence u Pirátů_

[![Source Code](http://img.shields.io/badge/source-pirati-cz/FlexiBudget-blue.svg?style=flat-square)](https://github.com/pirati-cz/FlexiBudget)
[![Latest Version](https://img.shields.io/github/release/pirati-cz/FlexiBudget.svg?style=flat-square)](https://github.com/pirati-cz/FlexiBudget/releases)
[![Software License](https://img.shields.io/badge/license-GPL-brightgreen.svg?style=flat-square)](https://github.com/pirati-cz/FlexiBudget/blob/master/LICENSE)
[![Build Status](https://img.shields.io/travis/pirati-cz/FlexiBudget/master.svg?style=flat-square)](https://travis-ci.org/pirati-cz/FlexiBudget)


Proces schvalování faktur:

  *  Je zadána **žádost o proplacení** (záměr na fakturu, předběžná faktura), to může zadat poměrně široká skupina lidí (LDAP skupina 100+)
  *  **Hospodář kapitoly zkontroluje věcnou správnost** (správná rozpočtová položka, výdaj je předem domluvený, přiměřený, zboží bylo doručeno etc.)
  *  Hospodář nechá žádost **schválit příslušným orgánem** (hospodář, RP, RV, kraj dle částky)
  *  Po úspěšném schválení hospodář **předává žádost FO**
  *  **FO provede kontrolu**, problémy řeší s hodpodářem.
  *  FO dává **příkaz k proplacení** a **zanáší fakturu do účetnictví** (popřípadě jí z předběžné mění na zaúčtovanou)

Instalace z balíčků pro Debian/Ubuntu
-------------------------------------

V současnosti není k dispozici pirátský debianí repozitář, proto prosím využijte 
[repozitář autora kódu](http://vitexsoftware.cz/repos.php):

    wget -O - http://v.s.cz/info@vitexsoftware.cz.gpg.key|sudo apt-key add -
    echo deb http://v.s.cz/ stable main > /etc/apt/sources.list.d/vitexsoftware.list
    aptitude update
    aptitude install flexibudget

Vývoj
=====

Zdrojové kódy je možné stahnout z GitHubu:

https://github.com/pirati-cz/FlexiBudget

Závislosti
----------

Se nainstalují příkazem 

    composer install
 
Database Init
-------------

Aplikace využívá pro práci s databází PDO nicméně je testována pouze s MySQL a PgSQL 9.5

Vytvoření uživatele a databáze PostgreSQL:

    su postgres
    psql 
    CREATE USER flexibudget WITH PASSWORD 'flexibudget';
    CREATE DATABASE flexibudget OWNER flexibudget;
    \q


Vytvoření uživatele a databáze MySQL:

    mysqladmin -u root -p create flexibudget
    mysql -u root -p -e "GRANT ALL PRIVILEGES ON flexibudget.* TO flexibudget@localhost IDENTIFIED BY 'flexibudget'"

poté je třeba patřičně upravit konfigurační soubor **phinx.yml** a provést naplnění databáze. 
Pro vývojové účely je na to připraven skript:

    cd testing
    ./reset.sh
    

Konfigurace
-----------

dpkg-reconfigure flexibudget

