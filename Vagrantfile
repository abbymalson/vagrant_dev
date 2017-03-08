# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"
Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://atlas.hashicorp.com/search.
  # https://atlas.hashicorp.com/boxes/search?provider=virtualbox
  #config.vm.box = "base"
  config.vm.box = "ubuntu/trusty64"
  #config.vm.box = "centos/7"
  config.vm.define "salt" do |master_box|
      master_box.vm.box = "ubuntu/xenial64"
      #master_box.vm.synced_folder "C:/Users/abby/Documents/vagrant_static_assets", "/vagrant_data"
      master_box.vm.synced_folder "salt/master_salt/", "/srv/salt/"
      master_box.vm.network "private_network", ip: "192.168.33.10"
      master_box.vm.hostname = "salt-master"
      master_box.vm.synced_folder "code/master/", "/code/"
      #master_box.vm.synced_folder "~/.ssh/", "/home/vagrant/.ssh/"
      master_box.vm.provider "virtualbox" do |vb|
          vb.memory = "640"
      end
      master_box.vm.provision "salt" do |master_salt|
          master_salt.install_master = true
          #master_salt.master_config = "salt/configs/master.conf"
          master_salt.master_config = "code/salt/configs/salt/master"
          master_salt.colorize = true
          master_salt.log_level = "info"
          master_salt.run_highstate = true
          master_salt.seed_master = {
              master:                   'salt/keys/master.pub',
              mysql_minion:             'salt/keys/mysql_minion.pub',
              redis_minion:             'salt/keys/redis_minion.pub',
              kubernetes_minion:        'salt/keys/kubernetes_minion.pub', # -- container manager
              kibana_minion:            'salt/keys/kibana_minion.pub',     # -- log viewer
              php_frontend_minion:      'salt/keys/php_frontend_minion.pub',
              php_lob_api_minion:       'salt/keys/php_lob_api_minion.pub',
              php_api_payment_minion:   'salt/keys/php_api_payment_minion.pub',
              dev_minion:               'salt/keys/dev_minion.pub'
          }
          master_salt.install_type = :stable
      end
  end
  config.vm.define "php_api_payment" do |php_api_payment_box|
      php_api_payment_box.vm.synced_folder "C:/Users/abby/Documents/vagrant_static_assets", "/vagrant_data"
      php_api_payment_box.vm.synced_folder "salt/php_api_payment/", "/srv/salt/"
      php_api_payment_box.vm.synced_folder "code/php_api_payment/", "/code/"
      php_api_payment_box.vm.network "private_network", ip: "192.168.33.15"
      #php_api_payment_box.vm.synced_folder "~/.ssh/", "/home/vagrant/.ssh/"
      php_api_payment_box.vm.provider "virtualbox" do |vb|
          vb.memory = "512"
      end
      php_api_payment_box.vm.provision "salt" do |php_api_payment_salt|
          #php_api_payment_salt.minion_config = "salt/php_api_payment_minion.yml"
          php_api_payment_salt.minion_config = "salt/configs/php_api_payment_minion.conf"
          php_api_payment_salt.minion_key = "salt/keys/php_api_payment_minion.pem"
          php_api_payment_salt.minion_pub = "salt/keys/php_api_payment_minion.pub"
          php_api_payment_salt.colorize = true
          php_api_payment_salt.log_level = "info"
          php_api_payment_salt.run_highstate = true
      end
  end
  config.vm.define "php_lob_api" do |php_lob_api_box|
      php_lob_api_box.vm.synced_folder "C:/Users/abby/Documents/vagrant_static_assets", "/vagrant_data"
      php_lob_api_box.vm.synced_folder "salt/php_lob_api/", "/srv/salt/"
      php_lob_api_box.vm.synced_folder "code/php_lob_api/", "/code/"
      php_lob_api_box.vm.network "private_network", ip: "192.168.33.20"
      #php_lob_api_box.vm.synced_folder "~/.ssh/", "/home/vagrant/.ssh/"
      php_lob_api_box.vm.provider "virtualbox" do |vb|
          vb.memory = "256"
      end
      php_lob_api_box.vm.provision "salt" do |php_lob_api_salt|
          php_lob_api_salt.minion_config = "salt/configs/php_lob_api_minion.conf"
          php_lob_api_salt.minion_key = "salt/keys/php_lob_api_minion.pem"
          php_lob_api_salt.minion_pub = "salt/keys/php_lob_api_minion.pub"
          #php_lob_api_salt.minion_config = "salt/php_lob_api_minion.yml"
          php_lob_api_salt.colorize = true
          php_lob_api_salt.log_level = "info"
          php_lob_api_salt.run_highstate = true
      end
  end
  config.vm.define "php_frontend" do |php_frontend_box|
      php_frontend_box.vm.synced_folder "C:/Users/abby/Documents/vagrant_static_assets", "/vagrant_data"
      php_frontend_box.vm.synced_folder "salt/php_frontend/", "/srv/salt/"
      php_frontend_box.vm.synced_folder "code/php_frontend/", "/code/"
      php_frontend_box.vm.network "private_network", ip: "192.168.33.25"
      #php_frontend_box.vm.synced_folder "~/.ssh/", "/home/vagrant/.ssh/"
      php_frontend_box.vm.provider "virtualbox" do |vb|
          vb.memory = "256"
      end
      php_frontend_box.vm.provision "salt" do |php_frontend_salt|
          php_frontend_salt.minion_config = "salt/configs/php_frontend_minion.conf"
          php_frontend_salt.minion_key = "salt/keys/php_frontend_minion.pem"
          php_frontend_salt.minion_pub = "salt/keys/php_frontend_minion.pub"
          #php_frontend_salt.minion_config = "salt/php_frontend_minion.yml"
          php_frontend_salt.colorize = true
          php_frontend_salt.log_level = "info"
          php_frontend_salt.run_highstate = true
      end
  end
  config.vm.define "kibana" do |kibana_box|
      kibana_box.vm.synced_folder "C:/Users/abby/Documents/vagrant_static_assets", "/vagrant_data"
      kibana_box.vm.synced_folder "salt/kibana/", "/srv/salt/"
      kibana_box.vm.synced_folder "code/kibana/", "/code/"
      kibana_box.vm.network "private_network", ip: "192.168.33.37"
      #kibana_box.vm.synced_folder "~/.ssh/", "/home/vagrant/.ssh/"
      kibana_box.vm.provider "virtualbox" do |vb|
          vb.memory = "512"
      end
      kibana_box.vm.provision "salt" do |kibana_salt|
          kibana_salt.minion_config = "salt/configs/kibana_minion.conf"
          kibana_salt.minion_key = "salt/keys/kibana_minion.pem"
          kibana_salt.minion_pub = "salt/keys/kibana_minion.pub"
          #kibana_salt.minion_config = "salt/kibana_minion.yml"
          kibana_salt.colorize = true
          kibana_salt.log_level = "INFO"
          kibana_salt.run_highstate = true
      end
  end
  config.vm.define "kubernetes" do |kubernetes_box|
      #this should be a core os box - since that would all run docker containers
      kubernetes_box.vm.synced_folder "C:/Users/abby/Documents/vagrant_static_assets", "/vagrant_data"
      kubernetes_box.vm.synced_folder "salt/kubernetes/", "/srv/salt/"
      kubernetes_box.vm.synced_folder "code/kubernetes/", "/code/"
      kubernetes_box.vm.network "private_network", ip: "192.168.33.72"
      #kubernetes_box.vm.synced_folder "~/.ssh/", "/home/vagrant/.ssh/"
      kubernetes_box.vm.provider "virtualbox" do |vb|
          vb.memory = "256"
      end
      kubernetes_box.vm.provision "salt" do |kubernetes_salt|
          kubernetes_salt.minion_config = "salt/configs/kubernetes_minion.conf"
          kubernetes_salt.minion_key = "salt/keys/kubernetes_minion.pem"
          kubernetes_salt.minion_pub = "salt/keys/kubernetes_minion.pub"
          #kubernetes_salt.minion_config = "salt/kubernetes_minion.yml"
          kubernetes_salt.colorize = true
          kubernetes_salt.log_level = "info"
          kubernetes_salt.run_highstate = true
      end
  end
  config.vm.define "redis" do |redis_box|
      #redis_box.vm.network "forwarded_port", guest: 80, host: 80
      #redis_box.vm.network "forwarded_port", guest: 3306, host: 3306
      redis_box.vm.synced_folder "C:/Users/abby/Documents/vagrant_static_assets", "/vagrant_data"
      redis_box.vm.synced_folder "salt/redis/", "/srv/salt/"
      redis_box.vm.synced_folder "code/redis/", "/code/redis/"
      redis_box.vm.network "private_network", ip: "192.168.33.43"
      #redis_box.vm.synced_folder "~/.ssh/", "/home/vagrant/.ssh/"
      redis_box.vm.provider "virtualbox" do |vb|
          vb.memory = "256"
      end
      redis_box.vm.provision "salt" do |redis_salt|
          redis_salt.minion_config = "salt/configs/redis_minion.conf"
          redis_salt.minion_key = "salt/keys/redis_minion.pem"
          redis_salt.minion_pub = "salt/keys/redis_minion.pub"
          #redis_salt.minion_config = "salt/redis_minion.yml"
          redis_salt.colorize = true
          redis_salt.log_level = "info"
          redis_salt.run_highstate = true
      end
  end
  config.vm.define "personal_dev" do |dev_box|
      dev_box.vm.synced_folder "C:/Users/abby/Documents/vagrant_static_assets", "/vagrant_data"
      dev_box.vm.hostname = "dev"
      dev_box.vm.synced_folder "salt/dev/", "/srv/salt/"
      dev_box.vm.synced_folder "code/dev/", "/code/"
      dev_box.vm.network "private_network", ip: "192.168.33.45"
      #dev_box.vm.synced_folder "~/.ssh/", "/home/vagrant/.ssh/"
      dev_box.vm.provider "virtualbox" do |vb|
          vb.memory = "512"
      end
      dev_box.vm.provision "salt" do |dev_salt|
          dev_salt.minion_config = "salt/configs/dev_minion.conf"
          dev_salt.minion_key = "salt/keys/dev_minion.pem"
          dev_salt.minion_pub = "salt/keys/dev_minion.pub"
          #dev_salt.minion_config = "salt/dev_minion.yml"
          dev_salt.colorize = true
          dev_salt.log_level = "info"
          dev_salt.run_highstate = true
      end
  end
  config.vm.define "mysql" do |mysql_box|
      #mysql_box.vm.network "forwarded_port", guest: 80, host: 80
      #mysql_box.vm.network "forwarded_port", guest: 3306, host: 3306
      mysql_box.vm.synced_folder "C:/Users/abby/Documents/vagrant_static_assets", "/vagrant_data"
      mysql_box.vm.hostname = "mysql"
      mysql_box.vm.synced_folder "salt/mysql/", "/srv/salt/"
      mysql_box.vm.synced_folder "code/mysql/", "/code/salt/"
      mysql_box.vm.network "private_network", ip: "192.168.33.50"
      #mysql_box.vm.synced_folder "~/.ssh/", "/home/vagrant/.ssh/"
      mysql_box.vm.provider "virtualbox" do |vb|
          vb.memory = "512"
      end
      mysql_box.vm.provision "salt" do |mysql_salt|
          #mysql_salt.minion_config = "salt/configs/mysql_minion.conf"
          mysql_salt.minion_config = "code/mysql/configs/salt/minion"
          mysql_salt.minion_key = "salt/keys/mysql_minion.pem"
          mysql_salt.minion_pub = "salt/keys/mysql_minion.pub"
          mysql_salt.colorize = true
          mysql_salt.log_level = "info"
          mysql_salt.run_highstate = true
      end
  end
end
