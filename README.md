# Telepítés instrukciók:

Laravel sail: hiba miatt nem tudtam elindítani (ehhez majd kell némi instrukció hogy hogyan kell csinálni)

Sima Docker-es megoldás:

1. Miután a githubról letöltöttük indítsuk el a docker-t a gépünkön.
2. A projekten belül ezután a docker compose fájllal egy szinten kiadhato a docker compose up vagy docker compose up -d parancs.
3. Feláll a rendszer szép lassan...
4. Ezután én a docker desktop-on belül a terminált megnyitottam a csiha-backend container-en.
5. Elmentem a: cd /var/www/html/csiha/public mappáig és itt kiadtam a: php artisan migrate:fresh --seed parancsot.
6. Ez a migrációt lefutatta és beletette a példa adatokat.
7. Ezután megnyitható az oldal. (Én a docker desktop-on a port számra kattintottam és bejött az oldal)
