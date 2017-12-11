# vi:syntax=yaml
# curl -L -O https://artifacts.elastic.co/downloads/logstash/logstash-5.2.2.tar.gz
# https://artifacts.elastic.co/downloads/logstash/logstash-6.0.1.tar.gz
# https://www.elastic.co/downloads/logstash
# Download and unzip Logstash
# Prepare a logstash.conf config file (https://www.elastic.co/guide/en/logstash/current/configuration.html)
# Run `bin/logstash -f logstash.conf`
# Dive into the getting started guide (https://www.elastic.co/guide/en/logstash/current/getting-started-with-logstash.html) and video (https://www.elastic.co/webinars/getting-started-logstash).
copy-logstash-to-server:
  file.managed:
    - name: /tmp/logstash.tar.gz
    - source: salt://logstash/logstash-6.0.1.tar.gz
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
    - if_missing: /opt/logstash-6.0.1/

# Create symlink (so /opt/logstash)
/opt/logstash:
  file.symlink:
    - target: /opt/logstash-6.0.1/
    - force: True

cleanup-tmp-logstash:
  file.absent:
    - name: /tmp/logstash.tar.gz
    

# Or we can do it correcctly and copy the files to the appropriate directories (test/production)
#/usr/share/phpmyadmin/libraries/config.default.php:
#  file.managed:
#    - source: 
#      - salt://phpmyadmin/libraries-config.default.php
#    - user: root
#    - group: root
#    - mode: 644
# may have to create a directory for /opt/logstash/logs
