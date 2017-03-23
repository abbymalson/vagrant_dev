# vi:syntax=yaml
# curl -L -O https://artifacts.elastic.co/downloads/beats/filebeat/filebeat-5.2.2-amd64.deb
# sudo dpkg -i filebeat-5.2.2-amd64.deb
install_test:
  pkg.installed:
    - sources:
      - filebeat: salt://kibana/filebeat/filebeat-5.2.2-amd64.deb
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
