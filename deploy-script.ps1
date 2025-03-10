# This is a simple deployment script
# You'll need to fill in your server details below

$Server = "your-server-hostname"  # e.g., ftp.quicksummit.net
$Username = "your-username"
$Password = "your-password" 
$RemotePath = "/home/admin/web/quicksummit.net/public_html"
$LocalPath = ".\dist\*"

Write-Host "To deploy your site, please update this script with your server credentials and run it again."
Write-Host "For security reasons, we cannot auto-fill these values."
Write-Host @"

INSTRUCTIONS:
1. Edit this file (deploy-script.ps1) and fill in:
   - Server hostname
   - Username
   - Password
   - Confirm the remote path is correct

2. Then run: 
   .\deploy-script.ps1

ALTERNATIVE:
Use your preferred FTP client (like FileZilla or WinSCP) to upload:
- All contents from the 'dist' folder to your server
- Make sure to include the .htaccess file (it may be hidden)
"@
