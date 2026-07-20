# Deploying to TransIP Webhosting

TransIP webhosting supports Laravel: SSH access and Composer are available, and you
can point the site's DocumentRoot at Laravel's `public/` folder from the control panel.
Official guide: https://www.transip.nl/knowledgebase/laravel-installeren-op-een-webhostingpakket

## One-time setup

1. Enable SSH for your webhosting package in the TransIP control panel and note the credentials.
2. In the control panel, set the PHP version to 8.3 (or the newest available 8.x).
3. Create a MySQL database + user in the control panel; note host, name, user, password.
4. Set the website's DocumentRoot to the app's `public` folder (e.g. `/novamed/public`).

## Deploying the code

From your machine (build assets first, then sync everything except local-only files):

```sh
npm run build
rsync -avz --exclude .git --exclude node_modules --exclude .env \
      --exclude storage/logs --exclude .idea ./ USER@HOST:~/novamed/
```

Then on the server (via SSH):

```sh
cd ~/novamed
composer install --no-dev --optimize-autoloader
cp .env.example .env        # first deploy only
php artisan key:generate    # first deploy only
# edit .env: set APP_ENV=production, APP_DEBUG=false, APP_URL, and the
# DB_* values from the control panel (DB_CONNECTION=mysql)
php artisan migrate --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

Frontend assets are built locally (`npm run build`) and synced along with the
code — Node is not guaranteed on the hosting, so never rely on building there.
