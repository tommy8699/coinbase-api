Spustenie projektu:

Nainštalujeme si balíčky pomocou composer z composer.json

```http
composer install
```

Pre spustenie projektu je potrebné nastaviť localhost na virtualHost

V APP/.migrations sú query pre tabuľky

Príklad XAMPP VirtualHost:

Krok 1) C:\WINDOWS\system32\drivers\etc\ Open the "hosts" file :

127.0.0.1 localhost 127.0.0.1 zadanie.local

Krok 2) xampp\apache\conf\extra\httpd-vhosts.conf

<VirtualHost *:80> DocumentRoot C:/xampp/htdocs/test/ ServerName zadanie.local

Krok 3) C:\xampp\apache\conf\httpd.conf.

#Virtual hosts Include conf/extra/httpd-vhosts.conf

Krok 4) Reštartujte XAMPP a v prehliadači zadajte :

zadanie.local
