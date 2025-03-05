#!/usr/bin/env sh

cd /var/www/web/themes/custom/envivent
npm install --no-audit
# Compile Node Sass if we need to, first run takes a while
npm rebuild node-sass
./node_modules/gulp/bin/gulp.js develop
