# vi:syntax=yaml

# Link the config files to our files (Development)
/var/www/html/info.php:
  file.symlink:
    - target: /srv/salt/php/phpinfo.php
