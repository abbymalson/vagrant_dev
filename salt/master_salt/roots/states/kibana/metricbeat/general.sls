#install_test:
#  pkg.installed:
#    - sources:
#      - metricbeat: salt://kibana/metricbeat/metricbeat-5.2.2-amd64.deb
# curl -L -O https://artifacts.elastic.co/downloads/beats/metricbeat/metricbeat-5.2.2-amd64.deb
#
# vi:syntax=yaml

# https://www.elastic.co/downloads/beats/metricbeat
# Download and unzip Metricbeat 
# Edit the metricbeat.yml configuration file
# Start the daemon by running sudo ./metricbeat -e -c metricbeat.yml
# Dive into the getting started guide (https://www.elastic.co/guide/en/beats/metricbeat/current/metricbeat-getting-started.html) and video (https://www.elastic.co/videos/getting-started-with-metricbeat).

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
