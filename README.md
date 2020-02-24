# BRUT

Brut est une application web permettant de gérer ses tests unitaires.

## Pré-requis

Il faut installer xdebug pour votre version de php (ici 7.3).

```bash
sudo apt-get install php7.3-xdebug
```

## Installation

### Clonage du projet

```bash
cd /var/www
git clone "https://github.com/Reloadaxe/BRUT.git"
```

### Mise en place du vhost

On créé le fichier de configuration pour apache2 :
```bash
sudo nano /etc/apache2/sites-available/BRUT.conf
```

Ecrivez la ligne suivante (dans le fichier BRUT.conf):
```bash
Include /var/www/BRUT/vhost.conf
```

Ouvrez le fichier /etc/hosts :
```bash
sudo nano /etc/hosts
```

Puis ajoutez la ligne :
```bash
127.0.0.1 BRUT
```

### Activation du vhost 

```bash
sudo a2ensite BRUT
sudo systemctl apache2 restart
```

Vous pouvez maintenant accéder à l'application depuis l'url : "http://brut/"
