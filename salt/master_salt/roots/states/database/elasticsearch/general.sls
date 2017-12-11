# Modification to use repositories
# wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-5.2.2.tar.gz


copy-elasticsearch-to-server:
  file.managed:
    - name: /tmp/elasticsearch.tar.gz
    - source: salt://database/elasticsearch/elasticsearch-6.0.1.tar.gz
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
    - if_missing: /opt/elasticsearch-6.0.1/

# Create symlink (so /opt/elasticsearch)
/opt/elasticsearch:
  file.symlink:
    - target: /opt/elasticsearch-6.0.1/
    - force: True
# File download
# wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-5.2.2.tar.gz

# https://www.elastic.co/guide/en/elasticsearch/plugins/current/index.html
# https://www.elastic.co/guide/en/elasticsearch/reference/current/index.html

cleanup-tmp-elasticsearch:
  file.absent:
    - name: /tmp/elasticsearch.tar.gz
    
# vi:syntax=yaml
# https://www.elastic.co/downloads/elasticsearch
# Download and unzip Elasticsearch
# Run bin/elasticsearch (or bin\elasticsearch.bat on Windows)
# Run curl http://localhost:9200/ or Invoke-RestMethod http://localhost:9200 with PowerShell
# Dive into the getting started guide (https://www.elastic.co/guide/en/elasticsearch/reference/current/getting-started.html) and video (https://www.elastic.co/webinars/getting-started-elasticsearch).