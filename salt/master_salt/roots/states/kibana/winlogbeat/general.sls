# https://artifacts.elastic.co/downloads/beats/winlogbeat/winlogbeat-5.2.2-windows-x86_64.zip
# https://www.elastic.co/guide/en/beats/winlogbeat/current/winlogbeat-installation.html
# https://www.elastic.co/downloads/beats/winlogbeat

# Download and unzip Winlogbeat
# Edit the winlogbeat.yml configuration file
# Run in PowerShell: winlogbeat.exe -c winlogbeat.yml
# Dive into the getting started guide (https://www.elastic.co/guide/en/beats/winlogbeat/current/winlogbeat-getting-started.html) and video (https://www.elastic.co/videos/getting-started-with-winlogbeat).

# vi:syntax=yaml
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
    