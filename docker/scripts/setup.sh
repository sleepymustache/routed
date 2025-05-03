cd /var/www
git config --global --add safe.directory /var/www
git submodule init
git submodule update

curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.1/install.sh | bash

# in lieu of restarting the shell
\. "$HOME/.nvm/nvm.sh"

# Download and install Node.js:
nvm install
nvm use
npm install 
./node_modules/gulp/bin/gulp.js develop