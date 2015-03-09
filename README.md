# IIZP2010G3

## Pika-ohjeet miten laittaa vagrantin kanssa tämä

1. Asenna vagrant: https://github.com/N4SJAMK/teamboard
2. Kun vagrant on tulilla ja olet `vagrant ssh` yhdistänyt siihen niin asennetaan Apache ja PHP:

* `sudo apt-get install apache2`
* `sudo apt-get install php5 php5-mongo`

3. Sitten conffataan apachea hieman:

* `sudo nano /etc/apache2/ports.conf`
* Muokkaa `Listen 80` => `Listen 8080`
* `CTRL + X` ja `Enter` tallentaa

4. Hieman lisää:

* `sudo nano /etc/apache2/sites-available/000-default.conf`
* Muokkaa `<VirtualHost *:80>` => `<VirtualHost *:8080>`
* `CTRL + X` ja `Enter` tallentaa

5. Sitten enabloidaan userdir moduuli

* `sudo a2enmod userdir`

6. Luodaan kansio kaikelle kamalle kotikansioon

* `cd ~`
* `mkdir public_html`

7. Otetaan PHP käyttöön kotikansion public_html:ään:

* `sudo nano /etc/apache2/mods-available/php5.conf`
* Kommentoi tiedoston lopusta (eli lisäät #-merkit rivin eteen):

```
#<IfModule mod_userdir.c>
#   <Directory /home/*/public_html>
#        php_admin_value engine Off
#    </Directory>
#</IfModule>
```
