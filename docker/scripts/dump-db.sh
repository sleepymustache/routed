mysqldump -uroot -p$MYSQL_ROOT_PASSWORD \
    --ignore-table=$MYSQL_DATABASE.cache_bootstrap \
    --ignore-table=$MYSQL_DATABASE.cache_config \
    --ignore-table=$MYSQL_DATABASE.cache_container \
    --ignore-table=$MYSQL_DATABASE.cache_data \
    --ignore-table=$MYSQL_DATABASE.cache_default \
    --ignore-table=$MYSQL_DATABASE.cache_discovery \
    --ignore-table=$MYSQL_DATABASE.cache_dynamic_page_cache \
    --ignore-table=$MYSQL_DATABASE.cache_entity \
    --ignore-table=$MYSQL_DATABASE.cache_menu \
    --ignore-table=$MYSQL_DATABASE.cache_page \
    --ignore-table=$MYSQL_DATABASE.cache_render \
    --ignore-table=$MYSQL_DATABASE.cache_toolbar \
    --ignore-table=$MYSQL_DATABASE.sessions \
    --ignore-table=$MYSQL_DATABASE.watchdog \
    --ignore-table=$MYSQL_DATABASE.webform_submission \
    --ignore-table=$MYSQL_DATABASE.webform_submission_data \
    $MYSQL_DATABASE \
    > /docker-entrypoint-initdb.d/init.sql

mysqldump --no-data -uroot \
    -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE \
    cache_bootstrap \
    cache_config \
    cache_container \
    cache_data \
    cache_default \
    cache_discovery \
    cache_dynamic_page_cache \
    cache_entity \
    cache_menu \
    cache_page \
    cache_render \
    cache_toolbar \
    sessions \
    watchdog \
    >> /docker-entrypoint-initdb.d/init.sql

mysqldump --no-data --skip-add-drop-table \
    -uroot -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE \
    webform_submission \
    webform_submission_data \
    >> /docker-entrypoint-initdb.d/init.sql

sed 's/^CREATE TABLE /CREATE TABLE IF NOT EXISTS /' \
    "/docker-entrypoint-initdb.d/init.sql" \
    > "/docker-entrypoint-initdb.d/init-fixed.sql"

cat /docker-entrypoint-initdb.d/init-fixed.sql \
    > /docker-entrypoint-initdb.d/init.sql
