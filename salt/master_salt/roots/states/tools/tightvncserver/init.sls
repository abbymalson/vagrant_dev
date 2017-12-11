# init.sls

tightvncserver:
  pkg:
    - installed

# To start vncserver
# vncserver

# To Stop vncserver
# vncserver -kill :<DISPLAYNUM>

# https://docs.saltstack.com/en/latest/ref/states/all/salt.states.service.html
# https://docs.saltstack.com/en/latest/ref/states/all/salt.states.pkg.html

# apt-get install -y xorg xvfb firefox dbus-x11 xfonts-100dpi xfonts-75dpi xfonts-cyrillic
# http://elementalselenium.com/tips/38-headless
# http://serebrov.github.io/html/2012-02-20-selenium-run-on-virtual-display.html

# check ~/.vnc
# update ~/.vnc/xstartup
# installing fluxbox
# installing firefox
# export DISPLAY=:1
# firefox