# vi:syntax=yaml

copy-logstash-to-server:
  file.managed:
    - name: /tmp/logstash.tar.gz
    - source: salt://logstash/logstash-5.2.2.tar.gz
    - user: root
    - group: root
    - mode: 755
# This is the general configuration - again using tar.gz setup
logstash-extract:
  archive.extracted:
    - name: /opt/
    - source: /tmp/logstash.tar.gz
    - user: vagrant
    - group: vagrant
    - if_missing: /opt/logstash-5.2.2/

# Create symlink (so /opt/logstash)
/opt/logstash:
  file.symlink:
    - target: /opt/logstash-5.2.2/
    - force: True

cleanup-tmp-logstash:
  file.absent:
    - name: /tmp/logstash.tar.gz
    
# Link the config files to our files (Development)
/var/www/html/info.php:
  file.symlink:
    - target: /srv/salt/php/phpinfo.php

# Or we can do it correcctly and copy the files to the appropriate directories (test/production)
#/usr/share/phpmyadmin/libraries/config.default.php:
#  file.managed:
#    - source: 
#      - salt://phpmyadmin/libraries-config.default.php
#    - user: root
#    - group: root
#    - mode: 644
# may have to create a directory for /opt/logstash/logs
