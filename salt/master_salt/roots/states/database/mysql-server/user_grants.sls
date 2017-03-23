frank_exampledb:
   mysql_grants.present:
    - grant: select,insert,update
    - database: exampledb.*
    - user: frank
    - host: localhost

frank_otherdb:
  mysql_grants.present:
    - grant: all privileges
    - database: otherdb.*
    - user: frank

restricted_singletable:
  mysql_grants.present:
    - grant: select
    - database: somedb.sometable
    - user: joe
# vi:syntax=yaml
