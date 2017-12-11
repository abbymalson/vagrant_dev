# https://www.elastic.co/downloads/apm
#copy-logstash-to-server:
#  file.managed:
#    - name: /tmp/logstash.tar.gz
#    - source: salt://logstash/logstash-6.0.1.tar.gz
#    - user: root
#    - group: root
#    - mode: 755
# This is the general configuration - again using tar.gz setup
#logstash-extract:
#  archive.extracted:
#    - name: /opt/
#    - source: /tmp/logstash.tar.gz
#    - user: vagrant
#    - group: vagrant
#    - if_missing: /opt/logstash-6.0.1/

# Create symlink (so /opt/logstash)
#/opt/logstash:
#  file.symlink:
#    - target: /opt/logstash-6.0.1/
#    - force: True

#cleanup-tmp-logstash:
#  file.absent:
#    - name: /tmp/logstash.tar.gz
