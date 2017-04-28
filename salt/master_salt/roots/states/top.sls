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
  'roles:database-mysql-57-server':
    - match: grain
    - database.mysql-server
  'roles:programming-java-jdk8':
#     use openjdk
#     Oracle is not the way
#     Not an option for Ubuntu 14.04 (trusty)
    - match: grain
    - programming.java.jdk8
  'roles:database-elasticsearch':
    - match: grain
    - database.elasticsearch.general 
  'roles:logstash-5x-general':
    - match: grain
    - logstash.general 
#    - kibana.filebeat.general
  'roles:kibana-5x-general':
    - match: grain
    - kibana.general
#    - webserver.nginx.general
#    - database.elasticsearch.general
#    - logstash.general
# These are supposed to be "roles" ... not "role"
  'role:php-apache':
    - match: grain
    - programming.php.apache 
  'role:logstash-5x-mysql':
    - match: grain
    - logstash.mysql
  'role:salt-master':
    - match: grain
    - continuous_integration.salt.master

  'salt-master':
    - match: grain
    - salt
  'role:webserver-nginx':
    - match: grain
    - webserver.nginx
# vi:syntax=yaml
