# Deployment Instructions

To complete the automated deployment setup:

1. Go to your GitHub repository: https://github.com/mkhaytman87/quicksummit-website
2. Click on "Settings" > "Secrets and variables" > "Actions"
3. Add the following secrets:
   - `SSH_HOST`: Your server's IP address or hostname
   - `SSH_PORT`: Your SSH port (usually 22)
   - `SSH_USER`: Your HestiaCP username
   - `SSH_PRIVATE_KEY`: Your SSH private key (I'll help generate this)
   - `SSH_KNOWN_HOSTS`: Your server's SSH fingerprint (I'll help get this)

To generate the SSH key and get the known_hosts:
1. Log into your HestiaCP panel
2. Go to "USER" > "SSH KEYS"
3. Click "Add SSH Key"
4. Use the following command to generate the key:
   ```bash
   ssh-keygen -t ed25519 -C "github-actions-deploy"
   ```
5. Add the public key to HestiaCP
6. The private key will go in the `SSH_PRIVATE_KEY` secret

Once these secrets are set up:
1. Go to the "Actions" tab in your repository
2. Click on "Deploy Website" workflow
3. Click "Run workflow" and select the "deployment" branch

The GitHub Action will:
1. Build your Astro site
2. Copy the .htaccess file
3. Deploy everything to your server via SFTP/SSH
4. Set proper permissions automatically

To test the deployment:
1. Wait for the GitHub Action to complete (usually takes 2-3 minutes)
2. Visit your site at https://quicksummit.net
3. Check that all pages and assets load correctly

If you need to make changes:
1. Make your changes locally
2. Commit and push to the deployment branch
3. The site will automatically redeploy

Need to rollback?
1. Go to the Actions tab
2. Find the last successful deployment
3. Download the artifact and manually upload it via SFTP
