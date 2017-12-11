# vi:syntax=yaml

# This particular version needs to have the jdk installed (version 8) because
# logstash doesn't work with it and the version of linux I'm using dpesn't have
# version 8 available, so we're stuck with tar.gz files.

# I want to copy the file to the minion before I start extracting as a policy
# going forward
copy-selenium-to-server:
  file.managed:
    - name: /tmp/selenium.jar
    - source: salt://programming/java/tools/selenium-server-standalone-3.8.1.jar # 64 bit
    - user: root
    - group: root
    - mode: 755
