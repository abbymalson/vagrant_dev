# vi:syntax=yaml
# curl -L -O https://artifacts.elastic.co/downloads/logstash/logstash-5.2.2.tar.gz

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
    
# may have to create a directory for /opt/logstash/logs
