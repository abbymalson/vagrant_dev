install_test:
  pkg.installed:
    - sources:
      - heartbeat: salt://kibana/heartbeat/heartbeat-5.2.2-amd64.deb
# curl -L -O https://artifacts.elastic.co/downloads/beats/heartbeat/heartbeat-5.2.2-amd64.deb
#
# vi:syntax=yaml
