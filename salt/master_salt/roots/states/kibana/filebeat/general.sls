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
