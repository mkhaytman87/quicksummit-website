#!/bin/bash

# Emergency fix for blog 404 issues
# This script restores the critical .htaccess files and blog configuration

set -e

echo "Starting emergency blog fix..."

# 1. Copy the backed up .htaccess file to the server
echo "Restoring root .htaccess file..."
scp /home/linuxuser/quicksummit-build/backup/.htaccess admin@quicksummit.net:/home/admin/web/quicksummit.net/public_html/

# 2. Restore the blog's .htaccess file
echo "Restoring blog .htaccess file..."
ssh admin@quicksummit.net "cat > /home/admin/web/quicksummit.net/public_html/blog/.htaccess" << 'EOF'
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /blog/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /blog/index.php [QSA,L]
</IfModule>
# END WordPress
EOF

# 3. Add the WordPress redirect to the root .htaccess
echo "Adding WordPress redirect to root .htaccess..."
ssh admin@quicksummit.net "cat >> /home/admin/web/quicksummit.net/public_html/.htaccess" << 'EOF'

# WordPress blog handling - Fixed to properly handle blog post URLs
RewriteCond %{REQUEST_URI} ^/blog
RewriteRule ^blog(/.*)?$ /blog$1 [QSA,PT,L]

# Remove the wordpress path if it's used (redirect to blog)
RewriteRule ^wordpress(/.*)?$ /blog$1 [R=301,L]
EOF

# 4. Reset WordPress permalinks
echo "Resetting WordPress permalinks..."
ssh admin@quicksummit.net "cd /home/admin/web/quicksummit.net/public_html/blog && php -r '\$wp_config = file_get_contents(\"wp-config.php\"); \$db_name = preg_match(\"/define\\(\\s*[\'\\\"](DB_NAME)[\'\\\"]\\s*,\\s*[\'\\\"]([^\'\\\"]*)[\'\\\"]\\s*\\)/\", \$wp_config, \$matches) ? \$matches[2] : \"\"; \$db_user = preg_match(\"/define\\(\\s*[\'\\\"](DB_USER)[\'\\\"]\\s*,\\s*[\'\\\"]([^\'\\\"]*)[\'\\\"]\\s*\\)/\", \$wp_config, \$matches) ? \$matches[2] : \"\"; \$db_pass = preg_match(\"/define\\(\\s*[\'\\\"](DB_PASSWORD)[\'\\\"]\\s*,\\s*[\'\\\"]([^\'\\\"]*)[\'\\\"]\\s*\\)/\", \$wp_config, \$matches) ? \$matches[2] : \"\"; \$db_host = preg_match(\"/define\\(\\s*[\'\\\"](DB_HOST)[\'\\\"]\\s*,\\s*[\'\\\"]([^\'\\\"]*)[\'\\\"]\\s*\\)/\", \$wp_config, \$matches) ? \$matches[2] : \"\"; \$db = new mysqli(\$db_host, \$db_user, \$db_pass, \$db_name); \$db->query(\"UPDATE wp_options SET option_value = \\\"%postname%\\\" WHERE option_name = \\\"permalink_structure\\\"\"); \$db->close(); echo \"Permalinks reset to /%postname%/\n\";'"

# 5. Verify the fix
echo "Verifying fix..."
curl -s -I "http://quicksummit.net/blog/hello-world/" | head -n 1

echo "Blog fix completed. Please verify the blog is working correctly."
