# vi:syntax=yaml

# This is the general configuration - again using tar.gz setup
logstash-extract:
  archive.extracted:
    - name: /opt/
    - source: salt://logstash/logstash-5.2.2.tar.gz
    - if_missing: /opt/logstash-5.2.2/

# Create symlink (so /opt/java)
/opt/logstash:
  file.symlink:
    - target: /opt/logstash-5.2.2/
    - force: True
