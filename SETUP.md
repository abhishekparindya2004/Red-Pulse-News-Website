# RedPulse on InfinityFree

## Important limits first
- You cannot choose a custom web port on InfinityFree.
- HTTP/HTTPS use standard ports only (`80`/`443`).
- For MySQL, use the host/credentials given by InfinityFree. Port is normally `3306`.

## 1. Create your hosting account
1. Sign in to InfinityFree and create a hosting account.
2. Create or attach a domain/subdomain.
3. Note your website URL (example: `https://yourname.infinityfreeapp.com`).

## 2. Create MySQL database
1. Open Control Panel -> `MySQL Databases`.
2. Create a new database.
3. Save these values:
   - DB Host (example: `sql201.infinityfree.com`)
   - DB Name
   - DB Username
   - DB Password

## 3. Import SQL
1. Open `phpMyAdmin` from InfinityFree panel.
2. Select your created DB.
3. Import file: `database.sql`.
4. If needed, update first lines of SQL to use your DB name.

## 4. Upload site files
1. Use File Manager or FTP client.
2. Upload all project files into `htdocs/` of your InfinityFree account:
   - `index.php`, `contact.php`, `world.php`, `technology.php`, `sports.php`, `admin.php`, `beg.php`
   - `app.js`, `style.css`, `images/`, `.htaccess`
3. Do not upload local-only folders unless needed (`hosting/`, `html/`).

## 5. Fill deployment config template
1. Copy `hosting/infinityfree/site-config.example.php` to `site-config.php`.
2. Set:
   - `app_url`
   - FTP host/port/username (optional reference)
   - DB host/name/username/password/port

## 6. If using DB from PHP later
Use this minimal connection snippet:

```php
<?php
$config = require __DIR__ . '/site-config.php';
$db = $config['database'];

$dsn = sprintf(
    'mysql:host=%s;port=%d;dbname=%s;charset=%s',
    $db['host'],
    $db['port'],
    $db['name'],
    $db['charset']
);

$pdo = new PDO($dsn, $db['username'], $db['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
```

## 7. Final check
- Open your site URL.
- Verify pages: Home, World, Technology, Sports, Contact.
- Verify old `.html` routes redirect to `.php` (handled by `.htaccess`).
