# This is the general configuration - again using tar.gz setup

copy-kibana-to-server:
  file.managed:
    - name: /tmp/kibana.tar.gz
    - source: salt://kibana/kibana-5.2.2-linux-x86_64.tar.gz
    - user: root
    - group: root
    - mode: 755
# This is the general configuration - again using tar.gz setup
kibana-extract:
  archive.extracted:
    - name: /opt/
    - source: /tmp/kibana.tar.gz
    - user: vagrant
    - group: vagrant
    - if_missing: /opt/kibana-5.2.2/
# Create symlink (so /opt/kibana)
/opt/kibana:
  file.symlink:
    - target: /opt/kibana-5.2.2/
    - force: True

cleanup-tmp-kibana:
  file.absent:
    - name: /tmp/kibana.tar.gz
    

# mv /opt/elasticsearch/config to /opt/elasticsearch/config.old/
# (for now) symlink elasticsearch/config /code/salt/configs/elasticsearch/ (you can file manage that directory contents later)
# ln -s /code/salt/configs/elasticsearch/ /opt/elasticsearch/config
/opt/kibana/config/:
  file.symlink:
    - target: /code/salt/configs/kibana/
    - force: True

# File download
#  wget https://artifacts.elastic.co/downloads/kibana/kibana-5.2.2-linux-x86_64.tar.gz 
# ./bin/kibana plugin --install elastic/sense
# ./bin/kibana
# To download for an offline machine
# wget https://download.elastic.co/elastic/sense/sense-latest.tar.gz
# bin/kibana plugin -i sense -u file:///PATH_TO_SENSE_TAR_FILE
# ./bin/kibana

# https://www.elastic.co/guide/en/x-pack/current/xpack-introduction.html
# https://www.elastic.co/guide/en/kibana/current/index.html
# https://www.elastic.co/guide/en/beats/libbeat/current/community-beats.html

# vi:syntax=yaml

