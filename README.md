# IIZP2010G3

## Pika-ohjeet miten laittaa manuaalisesti koko roska

1. Asenna vagrant: https://github.com/N4SJAMK/teamboard
2. Kun vagrant on tulilla ja olet `vagrant ssh` yhdistänyt siihen niin aletaan hommiin:

Asennetaan Apache ja PHP:

* `sudo apt-get install apache2`
* `sudo apt-get install php5 php5-mongo`

Sitten conffataan apachea hieman:

* `sudo nano /etc/apache2/ports.conf`
* Muokkaa `Listen 80` => `Listen 8080`
* `CTRL + X` ja `Enter` tallentaa

Hieman lisää apachen konffausta:

* `sudo nano /etc/apache2/sites-available/000-default.conf`
* Muokkaa `<VirtualHost *:80>` => `<VirtualHost *:8080>`
* `CTRL + X` ja `Enter` tallentaa

Sitten enabloidaan userdir moduuli

* `sudo a2enmod userdir`

Luodaan kansio kaikelle kamalle kotikansioon

* `cd ~`
* `mkdir public_html`

Otetaan PHP käyttöön kotikansion public_html:ään:

* `sudo nano /etc/apache2/mods-available/php5.conf`
* Kommentoi tiedoston lopusta (eli lisäät #-merkit rivin eteen):

```
#<IfModule mod_userdir.c>
#   <Directory /home/*/public_html>
#        php_admin_value engine Off
#    </Directory>
#</IfModule>
```

Sitten muokataan vagrantfile, joka löytyy sieltä mihin vagrantin laitoit (Windowsin puolella siis):

* Avaa `vagrantfile` tekstieditorilla
* Lisää `config.vm.network "forwarded_port", guest: 8080, host: 8080`
* Lisää `config.vm.synced_folder "admin", "/home/vagrant/public_html"`
* Sitten luo vielä kansio nimeltä `admin` sinne missä `vagrantfile` on

Buuttaa vagrant:

* Avaa uusi Git Bash
* `vagrant halt`
* `vagrant up`

Voidaan vielä ottaa itse projekti sinne public_html kansioon. Avaa uusi Git Bash ja suunnista sinne missä sinulla on äskeinen `admin` kansio luotuna. Käytä `cd` komentoa. Nykyisen kansion sisällön näet `ls` komennolla. Asemaa voit vaihtaa kun kirjotat `cd /d`, `cd /c` jne... Kun olet `admin` kansiossa:

* `git clone https://github.com/N4SJAMK/IIZP2010G3.git`
* Todennäköisesti kysyy sinun Git-käyttäjätunnusta ja salasanaa, annat ne
