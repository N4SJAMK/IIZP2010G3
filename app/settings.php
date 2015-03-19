<?php

# Settings
define("PATH_CORE", "../app/core/");
define("PATH_MODELS", "../app/models/");
define("PATH_DMODELS", "../app/models/domain/");
define("PATH_CONTROLLER", "../app/controllers/");
define("PATH_VIEW", "../app/views/");
define("PATH_APP", "/~vagrant/IIZP2010G3/public"); # you need to edit the .htaccess too!, slash at the start might be important and at the end! we are lazy
define("PATH_DB_BACKUP", "/home/vagrant/mongobackups/"); # remember to chown it for www-data
define("DB_NAME", "teamboard-dev");

?>