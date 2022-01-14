#!/usr/bin/env sh

cd /var/www/web/themes/custom/envivent
npm config set python /usr/bin/python2
npm install --no-audit
./node_modules/gulp/bin/gulp.js develop
