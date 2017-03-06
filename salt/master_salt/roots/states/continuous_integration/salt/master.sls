# vi:syntax=yaml

# Had to upgrade the system in order to have salt-api isntalled (older libraries 
# need to be updated)
# sudo apt-get dist-upgrade
salt-master:
  pkg:
    - installed
salt-api:
  pkg:
    - installed
