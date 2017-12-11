# This is the general configuration - again using tar.gz setup
kibana-extract:
  archive.extracted:
    - name: /opt/
    - source: salt://kibana/kibana-6.0.1-linux-x86_64.tar.gz
    - user: vagrant
    - group: vagrant
    - if_missing: /opt/kibana-6.0.1/

# Create symlink (so /opt/kibana)
/opt/kibana:
  file.symlink:
    - target: /opt/kibana-6.0.1/
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

# Download and unzip Kibana
# Open config/kibana.yml in an editor
# Set elasticsearch.url to point at your Elasticsearch instance
# Run bin/kibana (or bin\kibana.bat on Windows)
# Point your browser at http://localhost:5601
# Dive into the getting started guide (https://www.elastic.co/guide/en/kibana/current/getting-started.html) and video (https://www.elastic.co/webinars/getting-started-kibana).
