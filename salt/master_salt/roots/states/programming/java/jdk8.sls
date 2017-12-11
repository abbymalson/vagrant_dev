# vi:syntax=yaml

# This particular version needs to have the jdk installed (version 8) because
# logstash doesn't work with it and the version of linux I'm using dpesn't have
# version 8 available, so we're stuck with tar.gz files.

# I want to copy the file to the minion before I start extracting as a policy
# going forward
copy-jdk-to-server:
  file.managed:
    - name: /tmp/jdk.tar.gz
    - source: salt://programming/java/jdk-8u151-linux-x64.tar.gz # 64 bit
    - user: root
    - group: root
    - mode: 755

jdk-extract:
  archive.extracted:
    - name: /opt/
#    - source: salt://programming/java/jdk-8u121-linux-i586.tar.gz # 32 bit
    - source: /tmp/jdk.tar.gz
    - user: vagrant
    - group: vagrant
    - if_missing: /opt/jdk1.8.0_151/

# Create symlink (so /opt/java)
/opt/java:
  file.symlink:
    - target: /opt/jdk1.8.0_151/
    - force: True

cleanup-tmp-jdk:
  file.absent:
    - name: /tmp/jdk.tar.gz
    
