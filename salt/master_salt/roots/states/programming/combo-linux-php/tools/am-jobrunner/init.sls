# basic design
# This would work with 2 sets of cronjobs
# 1 is a Worker Cronjob - This one just looks at the database table to see if there are jobs waiting (once the worker is ready)
# 2 is a health cronjob - Checks status of jobs - if waiting too long, email me that the job runner is stuck

# https://docs.saltstack.com/en/latest/ref/states/all/salt.states.cron.html
# https://docs.saltstack.com/en/latest/ref/states/all/salt.states.schedule.html
# https://www.packtpub.com/mapt/book/networking_and_servers/9781784399740/4/ch04lvl1sec45/scheduling-jobs-with-cron
#clean_tomcat_logs:
#  cron.present:
#    - name: find /opt/apache-tomcat-6.0.43/logs/ -mtime +30 -exec rm -rf {} \;
#    - user: root
#    - minute: 00
#    - hour: 01
#    - daymonth: '*'
#    - month: '*'
#    - dayweek: '*'
# https://mapt.io/
# https://github.com/bechtoldt/saltstack-cron-formula

# Technically wouldn't need a cronjob, except to monitor the health of the workers
# that can actually run separately ...

# installing gnome-terminal
# that didn't work out the way I was hoping
# Need to move the ssh key to the server (set the permissions to 700 - permissions were too open)
# 
#  chmod 700 ~/.ssh/id_rsa
#  git clone git@github.com:GhostGroup/weedmaps.git
# /opt/java/bin/java  -jar /opt/selenium-server.jar
