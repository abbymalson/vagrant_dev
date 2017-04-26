# vi:syntax=yaml

# Modification to use repositories
# wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-5.2.2.tar.gz


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
    

# mv /opt/elasticsearch/config to /opt/elasticsearch/config.old/
# (for now) symlink elasticsearch/config /code/salt/configs/elasticsearch/ (you can file manage that directory contents later)
# ln -s /code/salt/configs/elasticsearch/ /opt/elasticsearch/config
# ------------------------
# I don't think we need this ...
# ------------------------
#/opt/elasticsearch/config/:
#  file.symlink:
#    - target: /code/salt/configs/elasticsearch/
#    - force: True

# /opt/elasticsearch/bin/system-install # ??
# bin/logstash –f apache.config --config.reload.automatic # automatic config reloading
# need to have elasticsearch running first
# may have to create a directory for /opt/logstash/logs

# ./bin/elasticsearch -Epath.conf=/path/to/my/config/
# --------- config value settings ------------
# path.data: /var/lib/elasticsearch
# path.logs: /var/log/elasticsearch
# Security: https://www.elastic.co/guide/en/elasticsearch/reference/current/secure-settings.html # TODO
# Bootstrap Checks: https://www.elastic.co/guide/en/elasticsearch/reference/current/bootstrap-checks.html # TODO
# https://www.elastic.co/guide/en/elasticsearch/reference/current/system-config.html # TODO
# IMPORTANT: As soon as you configure a network setting like network.host, Elasticsearch
# assumes that you are moving to production and will upgrade the above warnings to exceptions.

# Should have it's own user/service account
# https://www.elastic.co/guide/en/elasticsearch/reference/current/stopping-elasticsearch.html # TODO













