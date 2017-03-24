
copy-elasticsearch-to-server:
  file.managed:
    - name: /tmp/elasticsearch.tar.gz
    - source: salt://database/elasticsearch/elasticsearch-5.2.2.tar.gz
    - user: root
    - group: root
    - mode: 755
# This is the general configuration - again using tar.gz setup
elasticsearch-extract:
  archive.extracted:
    - name: /opt/
    - source: /tmp/elasticsearch.tar.gz
    - user: vagrant
    - group: vagrant
    - if_missing: /opt/elasticsearch-5.2.2/

# Create symlink (so /opt/elasticsearch)
/opt/elasticsearch:
  file.symlink:
    - target: /opt/elasticsearch-5.2.2/
    - force: True
# File download
# wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-5.2.2.tar.gz

# https://www.elastic.co/guide/en/elasticsearch/plugins/current/index.html
# https://www.elastic.co/guide/en/elasticsearch/reference/current/index.html

cleanup-tmp-elasticsearch:
  file.absent:
    - name: /tmp/elasticsearch.tar.gz
    
# vi:syntax=yaml
