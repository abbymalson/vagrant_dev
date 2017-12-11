base:
  '*':
    - base.sanity
    - wheel
    - users
  'roles:minion':
    - match: grain
    - continuous_integration.salt.minion
  'roles:webserver-apache2':
    - match: grain
    - webserver.apache 
  'roles:webserver-nginx':
    - match: grain
    - webserver.nginx 
  'roles:database-mysql-57-server':
    - match: grain
    - database.mysql-server
  'roles:database-postgres':
    - match: grain
    - database.postgres.general 
  'roles:database-elasticsearch':
    - match: grain
    - database.elasticsearch.general 
  'roles:programming-ruby-24':
    - match: grain
    - programming.ruby.ruby24
  'roles:programming-ruby-framework-rails':
    - match: grain
    - programming.ruby.framework.rails
  'roles:programming-ruby-tools-cucumber':
    - match: grain
    - programming.ruby.tools.cucumber
  'roles:programming-java-jdk8':
#     use openjdk
#     Oracle is not the way
#     Not an option for Ubuntu 14.04
    - match: grain
    - programming.java.jdk8
  'roles:programming-java-tools-selenium':
    - match: grain
    - programming.java.tools.selenium
  'roles:tightvncserver':
    - match: grain
    - tools.tightvncserver 
  'roles:logstash-5x-general':
    - match: grain
    - logstash.general 
    - kibana.filebeat.general
# These are supposed to be "roles" ... not "role"
  'roles:php-apache':
    - match: grain
    - programming.php.apache 
  'roles:programming-php-nginx':
    - match: grain
    - programming.php.nginx 
  'roles:programming-combo-linux-php-tools-am-autorunner':
    - match: grain
    - programming.combo-linux-php.tools.am.autorunner 
  'roles:logstash-5x-mysql':
    - match: grain
    - logstash.mysql
  'roles:salt-master':
    - match: grain
    - continuous_integration.salt.master

  'salt-master':
    - match: grain
    - salt
  'roles:webserver-nginx':
    - match: grain
    - webserver.nginx
  'roles:kibana-server':
    - match: grain
    - nginx
    - elasticsearch
    - log-stash
    - kibana
# vi:syntax=yaml
