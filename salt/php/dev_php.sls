install_required_packages_php:
  pkg.installed:
    - names:
      - apache2
      - php
#      - git

/var/www/html/info.php
  file.symlink:
    - target: /srv/salt/php/phpinfo.php

#/etc/apache2/sites-enabled/001-website.conf:
#  file.symlink:
#    - target: /srv/salt/website/apache2-config-001-website.conf

apache2:
  service.running:
    - enable: True
    - reload: True
    - watch:
      - pkg: apache2

