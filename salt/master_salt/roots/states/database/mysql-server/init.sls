# vi:syntax=yaml

python-mysqldb:
  pkg.installed

debconf-utils:
  pkg.installed

mysql_setup:
  debconf.set:
    - name: mysql-server
    - data:
        'mysql-server/root_password': {'type': 'password', 'value': 'dilbert'}
        'mysql-server/root_password_again': {'type': 'password', 'value': 'dilbert'}
    - require:
      - pkg: debconf-utils
    - unless:
      - dpkg-query -s mysql-server


install_mysql:
  pkg.installed:
    - names:
      - mysql-server
    - require:
      - debconf: mysql-server
      - pkg: python-mysqldb
  
#/etc/mysql/my.cnf:
#  file.managed:
#    - source:
#      - salt://mysql/my.cnf
#    - user: root
#    - group: root
#    - mode: 644

mysql-run-at-boot-restart:
  service.running:
    - name: mysql
    - enable: True
    - watch:
      - pkg: mysql-server
