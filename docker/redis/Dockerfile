FROM redis:latest

ENV TZ Asia/Bangkok

## For security settings uncomment, make the dir, copy conf, and also start with the conf, to use it
#RUN mkdir -p /usr/local/etc/redis
#COPY redis.conf /usr/local/etc/redis/redis.conf

###########################################################################
# Set Timezone
###########################################################################
RUN cp /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone

VOLUME /data

EXPOSE 6379

CMD ["redis-server"]
