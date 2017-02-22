install_required_packages_salt:
  pkg.installed:
    - names:
      - salt-master
      - salt-ssh
