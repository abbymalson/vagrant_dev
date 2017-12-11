#install_test:
#  pkg.installed:
#    - sources:
#      - packetbeat: salt://kibana/packetbeat/packetbeat-5.2.2-amd64.deb
# sudo apt-get install libpcap0.8
# curl -L -O https://artifacts.elastic.co/downloads/beats/packetbeat/packetbeat-5.2.2-amd64.deb
# sudo dpkg -i packetbeat-5.2.2-amd64.deb

# vi:syntax=yaml

# https://www.elastic.co/downloads/beats/packetbeat
# Download and unzip Packetbeat 
# Edit the packetbeat.yml configuration file
# Start the daemon by running `sudo ./packetbeat -e -c packetbeat.yml`
# Dive into the getting started guide (https://www.elastic.co/guide/en/beats/packetbeat/current/packetbeat-getting-started.html) and video (https://www.elastic.co/videos/getting-started-with-packetbeat).

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
