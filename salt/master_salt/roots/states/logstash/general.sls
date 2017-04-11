# vi:syntax=yaml
# curl -L -O https://artifacts.elastic.co/downloads/logstash/logstash-5.2.2.tar.gz

# wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
# sudo apt-get install apt-transport-https
# echo "deb https://artifacts.elastic.co/packages/5.x/apt stable main" | sudo tee -a /etc/apt/sources.list.d/elastic-5.x.list

# We use the PGP key D88E42B4, Elastic’s Signing Key, with fingerprint
# 4609 5ACC 8548 582C 1A26 99A9 D27D 666C D88E 42B4

# sudo apt-get update && sudo apt-get install logstash

#install_logstash_repo:
#  pkgrepo.managed:
#    - humanname: Elastic PPA
#    - name: ppa:elastic-5.x.list
#    - dist: trusty 
#    - file: /etc/apt/sources.list.d/elastic.list
#    - keyid: D88E42B4
#    - keyserver: artificats.elastic.co/5.x/apt
#install_logstash_from_repo:
#  pkg.installed:
#    - name: logstash
#    - fromrepo: ppa:wolfnet/logstash

copy-logstash-to-server:
  file.managed:
    - name: /tmp/logstash.tar.gz
    - source: salt://logstash/logstash-5.2.2.tar.gz
    - user: root
    - group: root
    - mode: 755
# This is the general configuration - again using tar.gz setup
logstash-extract:
  archive.extracted:
    - name: /opt/
    - source: /tmp/logstash.tar.gz
    - user: vagrant
    - group: vagrant
    - if_missing: /opt/logstash-5.2.2/

# Create symlink (so /opt/logstash)
/opt/logstash:
  file.symlink:
    - target: /opt/logstash-5.2.2/
    - force: True

cleanup-tmp-logstash:
  file.absent:
    - name: /tmp/logstash.tar.gz
    
# add java to the path
# mv /opt/logstash/config to /opt/logstash/config.old/
# (for now) symlink logstash/config /code/salt/configs/logstash/ (you can file manage that directory contents later)
# add symlink java to /usr/bin/java
# /opt/logstash/bin/system-install
# create /opt/logstash/config/logstash-simple.conf
# create /opt/logstash/config/logstash-syslog.conf
# create /opt/logstash/config/logstash-apache.conf
# bin/logstash –f apache.config --config.reload.automatic # automatic config reloading
# need to have elasticsearch running first
# /opt/logstash/bin/logstash -f
# may have to create a directory for /opt/logstash/logs
