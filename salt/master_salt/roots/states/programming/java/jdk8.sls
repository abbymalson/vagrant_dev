# vi:syntax=yaml

# This particular version needs to have the jdk installed (version 8) because
# logstash doesn't work with it and the version of linux I'm using dpesn't have
# version 8 available, so we're stuck with tar.gz files.

jdk-extract:
  archive.extracted:
    - name: /opt/
#    - source: salt://programming/java/jdk-8u121-linux-i586.tar.gz # 32 bit
    - source: salt://programming/java/jdk-8u121-linux-x64.tar.gz
    - user: vagrant
    - group: vagrant
    - if_missing: /opt/jdk1.8.0_121/

# Create symlink (so /opt/java)
/opt/java:
  file.symlink:
    - target: /opt/jdk1.8.0_121/
    - force: True
