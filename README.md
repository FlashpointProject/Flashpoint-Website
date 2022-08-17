# Flashpoint-Website
This is the GitHub repository for the Flashpoint website, located at http://bluemaxima.org/flashpoint/.

https://flashpointproject.github.io/Flashpoint-Website/

## Disclaimer
Because Blue's setup involves manually applying - and making his own - changes from here to his site, don't expect this repository to always exactly reflect what's hosted at bluemaxima.org (*especially* around new releases).

## Setting up dev environment
1. Download and install Git (https://git-scm.com/downloads) and XAMPP (https://www.apachefriends.org/download.html). Make sure to install XAMPP right to your root directory (`C:\` on Windows).
2. Fork this repository (if you're not added as a collaborator). You'll be redirected to your fork.
3. Click the green button "Code", click the "HTTPS" tab and copy the URL
4. Navigate to `C:\xampp\htdocs` and open Git Bash here. You should be able to do it by right-clicking the folder and choosing the "Git bash here" option.
5. If necessary, use the `cd` command to navigate through directories until you're in `C:\xampp\htdocs`
6. Execute command `git clone [URL]`. Replace `[URL]` with the URL you copied in step 3
7. A copy of the website code should download into a new folder in `C:\xampp\htdocs`
8. Open file `C:\xampp\apache\conf\extra\httpd-vhosts.conf` and add this text to the end of it:
```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/Flashpoint-Website"
    ServerName fp.local
    <Directory />
        AllowOverride All
        Require all granted
        DirectoryIndex index.php
    </Directory>
</VirtualHost>
```
9. Open file `C:\Windows\System32\drivers\etc\hosts` **with administrator privileges** and add this text to the end of it
```
127.0.0.1    fp.local
```
10. Open XAMPP. If there's not an icon on your desktop, open `C:\xampp\xampp-control.exe`
11. Press the `Start` buttons next to `Apache` service and pray that they start successfully and there's no port blocked :pray: 
12. Type `fp.local` in the address bar
13. You should see the website and be able to browse it as you wish.
