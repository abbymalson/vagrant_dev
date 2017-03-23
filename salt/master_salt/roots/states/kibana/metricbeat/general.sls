install_test:
  pkg.installed:
    - sources:
      - metricbeat: salt://kibana/metricbeat/metricbeat-5.2.2-amd64.deb
# curl -L -O https://artifacts.elastic.co/downloads/beats/metricbeat/metricbeat-5.2.2-amd64.deb
#
# vi:syntax=yaml
