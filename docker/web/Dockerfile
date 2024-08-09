FROM node:16.14.2

RUN apt update && apt -y install xvfb libnss3 libatk3.0-cil libatk-bridge2.0-0 libcups2 libgtk3.0-cil libgbm1 libasound2

ADD docker/web/start.sh /var/run
RUN chmod +x /var/run/start.sh

RUN apt-get update
RUN apt-get install jq -y

WORKDIR /opt/web/client
CMD [ "/bin/bash", "/var/run/start.sh"]
