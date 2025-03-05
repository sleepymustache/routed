mariadb-dump -uroot -p$MARIADB_ROOT_PASSWORD \
    --ignore-table=$MARIADB_DATABASE.cache_bootstrap \
    --ignore-table=$MARIADB_DATABASE.cache_config \
    --ignore-table=$MARIADB_DATABASE.cache_container \
    --ignore-table=$MARIADB_DATABASE.cache_data \
    --ignore-table=$MARIADB_DATABASE.cache_default \
    --ignore-table=$MARIADB_DATABASE.cache_discovery \
    --ignore-table=$MARIADB_DATABASE.cache_dynamic_page_cache \
    --ignore-table=$MARIADB_DATABASE.cache_entity \
    --ignore-table=$MARIADB_DATABASE.cache_menu \
    --ignore-table=$MARIADB_DATABASE.cache_page \
    --ignore-table=$MARIADB_DATABASE.cache_render \
    --ignore-table=$MARIADB_DATABASE.cache_toolbar \
    --ignore-table=$MARIADB_DATABASE.sessions \
    --ignore-table=$MARIADB_DATABASE.oauth2_token \
    --ignore-table=$MARIADB_DATABASE.oauth2_token__scopes \
    --ignore-table=$MARIADB_DATABASE.webform_submission \
    --ignore-table=$MARIADB_DATABASE.webform_submission_data \
    $MARIADB_DATABASE \
    > /docker-entrypoint-initdb.d/init.sql

mariadb-dump --no-data -uroot \
    -p$MARIADB_ROOT_PASSWORD $MARIADB_DATABASE \
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
    >> /docker-entrypoint-initdb.d/init.sql


mariadb-dump --no-data --skip-add-drop-table \
    -uroot -p$MARIADB_ROOT_PASSWORD $MARIADB_DATABASE \
    oauth2_token \
    oauth2_token__scopes \
    webform_submission \
    webform_submission_data \
    >> /docker-entrypoint-initdb.d/init.sql

sed 's/^CREATE TABLE /CREATE TABLE IF NOT EXISTS /' \
    "/docker-entrypoint-initdb.d/init.sql" \
    > "/docker-entrypoint-initdb.d/init-fixed.sql"

sed 's/\/\*M!999999\\- enable the sandbox mode \*\///g' \
    "/docker-entrypoint-initdb.d/init-fixed.sql" \
    > "/docker-entrypoint-initdb.d/init-fixed2.sql"

sed 's/utf8mb4_uca1400_ai_ci/utf8mb4_unicode_ci/g' \
    "/docker-entrypoint-initdb.d/init-fixed2.sql" \
    > "/docker-entrypoint-initdb.d/init-fixed3.sql"

cat /docker-entrypoint-initdb.d/init-fixed3.sql \
    > /docker-entrypoint-initdb.d/init.sql
