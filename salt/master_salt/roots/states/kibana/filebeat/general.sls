# vi:syntax=yaml
# curl -L -O https://artifacts.elastic.co/downloads/beats/filebeat/filebeat-5.2.2-amd64.deb
copy-filebeat-to-server:
  file.managed:
    - name: /tmp/filebeat.deb
    - source: salt://kibana/filebeat/filebeat-5.2.2-amd64.deb
    - user: root
    - group: root
    - mode: 755
# sudo dpkg -i filebeat-5.2.2-amd64.deb
install_test:
  pkg.installed:
    - sources:
      - filebeat: /tmp/filebeat.deb

cleanup-tmp-filebeat:
  file.absent:
    - name: /tmp/filebeat.deb
    
# This created a SaltReqTimeoutError: Message timed out - the package was still installed though
# You can verify in follow up state.apply
  #cmd.run:
  #  - name: curl -L -O https://artifacts.elastic.co/downloads/beats/filebeat/filebeat-5.2.2-amd64.deb
  #  - creates: /tmp/filebeat.deb
  #pkg.installed:
  #  - sources:
  #    - wkhtmltox: https://artifacts.elastic.co/downloads/beats/filebeat/filebeat-5.2.2-amd64.deb
  #cmd.run:
  #  - name: curl -L -O https://artifacts.elastic.co/downloads/beats/filebeat/filebeat-5.2.2-amd64.deb
  #  - creates: /tmp/filebeat.deb

# https://www.elastic.co/downloads/beats/filebeat
# Download and unzip Filebeat
# Edit the filebeat.yml configuration file
# Start the daemon by running `sudo ./filebeat -e -c filebeat.yml`
# Dive into the getting started guide (https://www.elastic.co/guide/en/beats/filebeat/current/filebeat-getting-started.html) and video (https://www.elastic.co/videos/getting-started-with-filebeat).

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
