# vi:syntax=yaml
base:
  '*':
    - base.sanity
    - wheel
    - users
  'roles:webserver-apache':
    - match: grain
    - webserver.apache 
  'role:php-apache':
    - match: grain
    - php.apache 
  'role:logstash-general':
    - match: grain
    - logstash.general 
  'role:logstash-mysql':
    - match: grain
    - logstash.mysql
  'role:java-jdk8':
    - match: grain
    - java.jdk8
  'role:database-mysql-server':
    - match: grain
    - database.mysql-server
  'role:salt-master':
    - match: grain
    - continuous_integration.salt.master
#  'salt-master':
#    - match: grain
#    - salt
#  'role:webserver-nginx':
#    - match: grain
#    - nginx
#  'role:db-elasticsearch':
#    - match: grain
#    - elasticsearch
#  'role:webserver-nginx':
#    - match: grain
#  'role:webserver-nginx':
#    - match: grain
#  'role:kibana-server':
#    - match: grain
#    - nginx
#    - elasticsearch
#    - log-stash
#    - kibana
# debian based installation - package management
# https://www.elastic.co/guide/en/kibana/current/deb.html
# Download and install public Signing key
# Import Elastic PGP Key
#wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
# You may need to install the following package:
#sudo apt-get install apt-transport-https
# Save the repository definition to /etc/apt/sources.list.d/elastic-5.x.list
#echo "deb https://artifacts.elastic.co/packages/5.x/apt stable main" | sudo tee -a /etc/apt/sources.list.d/elastic-5.x.list
# Don't use add-apt-repository ... causes much sadness in the world
# Install kibana
#sudo apt-get update && sudo apt-get install kibana
# kibana is not set to start by default
#ps -p 1 # Is it SysV or systemd
# SysV commands
# sudo chkconfig --add kibana
#sudo update-rc.d kibana defaults 95 10
#sudo -i service kibana start
#sudo -i service kibana stop
# Log files can be found at
#/var/log/kibana/
# sudo /bin/systemctl daemon-reload
# sudo /bin/systemctl enable kibana.service
# sudo systemctl start kibana.service
# sudo systemctl stop kibana.service
# config file: /etc/kibana/kibana.yml
# config file settings; https://www.elastic.co/guide/en/kibana/current/settings.html
# $KIBANA_HOME = /usr/share/kibana/
# kibana_plugins and bin files: /usr/share/kibana/bin
# kibana_data = /var/lib/kibana
# optimize = /usr/share/kibana/optimize
# plugins = plugin file location: /usr/share/kibana/plugins

# RPM package management
# https://www.elastic.co/guide/en/kibana/current/rpm.html
# Download and install public signing key
# Import Elastic PGP Key
#rpm --import https://artifacts.elastic.co/GPG-KEY-elasticsearch
# Create a file: 
# /etc/yum.repos.d/kibana.repo # Centos/Redhat
# /etc/zypp/repos.d/kibana.repo # OpenSuSE
# With the following content:
#[kibana-5.x]
#name=Kibana repository for 5.x packages
#baseurl=https://artifacts.elastic.co/packages/5.x/yum
#gpgcheck=1
#gpgkey=https://artifacts.elastic.co/GPG-KEY-elasticsearch
#enabled=1
#autorefresh=1
#type=rpm-md
#sudo yum install kibana      # CentOs/RedHat
#sudo dnf install kibana      # Fedora and newer Redhat
#sudo zypper install kibana   # OpenSUSE
