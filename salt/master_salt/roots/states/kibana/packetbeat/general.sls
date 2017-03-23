install_test:
  pkg.installed:
    - sources:
      - packetbeat: salt://kibana/packetbeat/packetbeat-5.2.2-amd64.deb
# sudo apt-get install libpcap0.8
# curl -L -O https://artifacts.elastic.co/downloads/beats/packetbeat/packetbeat-5.2.2-amd64.deb
# sudo dpkg -i packetbeat-5.2.2-amd64.deb

# vi:syntax=yaml
