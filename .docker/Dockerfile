FROM robsontenorio/laravel:2.4

COPY --chown=appuser:appuser . .

RUN chmod a+x .docker/deploy.sh

CMD ["/bin/sh", "-c", ".docker/deploy.sh && /usr/local/bin/start"] 
