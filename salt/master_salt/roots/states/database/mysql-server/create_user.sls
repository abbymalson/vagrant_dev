frank:
  mysql_user.present:
    - host: localhost
    - password: "bob@cat"
    - connection_user: someuser
    - connection_pass: somepass
    - connection_charset: utf8
    - saltenv:
      - LC_ALL: "en_US.utf8"
# vi:syntax=yaml
