# vi:syntax=yaml
# We want to create a symlink to the /code/configs/salt/minion file
/etc/salt/minion:
  file.symlink:
    - target: /code/salt/configs/salt/minion
    - force: True
    - backupname: /etc/salt/minion.bak
