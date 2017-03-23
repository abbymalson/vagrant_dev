# vi:syntax=yaml

# This is the general configuration - again using tar.gz setup
logstash-extract:
  archive.extracted:
    - name: /opt/
    - source: salt://logstash/logstash-5.2.2.tar.gz
    - user: vagrant
    - group: vagrant
    - if_missing: /opt/logstash-5.2.2/

# Create symlink (so /opt/logstash)
/opt/logstash:
  file.symlink:
    - target: /opt/logstash-5.2.2/
    - force: True

# may have to create a directory for /opt/logstash/logs
