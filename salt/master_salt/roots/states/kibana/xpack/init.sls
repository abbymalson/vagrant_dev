# https://www.elastic.co/downloads/x-pack
#copy-logstash-to-server:
#  file.managed:
#    - name: /tmp/xpack.tar.gz
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
    

# bin/elasticsearch-plugin install x-pack
# bin/elasticsearch
# bin/x-pack/setup-passwords auto

# Get passwords for kibana, elastic users
# bin/x-pack/setup-passwords auto

# Add credentials to kibana.yml file
# elasticsearch.username: "kibana"
# elasticsearch.password:  "<pwd>"

# Start Kibana
# bin/kibana

# Navigate to kibana http://localhost:5601/
# Login as the built in `elastic` user

# Dive into Getting Started Guide: https://www.elastic.co/guide/en/x-pack/current/xpack-introduction.html