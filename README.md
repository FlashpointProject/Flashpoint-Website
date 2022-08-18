# Flashpoint-Website
This is the GitHub repository for the BlueMaxima's Flashpoint website, located at http://bluemaxima.org/flashpoint/.

## Setting up dev environment
1. Download and install XAMPP from https://www.apachefriends.org/download.html. Set your install location to the root directory (`C:\` on Windows).
2. On the GitHub repository's homepage (which you're probably already viewing), click the green "Code" button and select "Download ZIP". 
3. Navigate to `C:\xampp\htdocs\` and create a new folder named `fp.local`. Extract the ZIP's contents into this folder.
4. Rename the newly-extracted `Flashpoint-Website-master` folder to `flashpoint`.
5. Navigate to `C:\xampp\apache\conf\extra\` and open `httpd-vhosts.conf` in a text editor. Add this text to the end of the file:
```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/fp.local"
    ServerName fp.local
    <Directory />
        AllowOverride All
        Require all granted
        DirectoryIndex index.php
    </Directory>
</VirtualHost>
```
9. Navigate to `C:\Windows\System32\drivers\etc\` and open the `hosts` file in a text editor **with administrator privileges**. Add this text to the end of the file:
```
127.0.0.1    fp.local
```
10. Open the XAMPP Control Panel. If there's not an icon on your desktop, open `C:\xampp\xampp-control.exe`.
11. Click the `Start` button in the Apache row to start the web server. 
12. Go to http://fp.local/flashpoint/ in your browser.

If XAMPP complains about ports being blocked/used by other processes, go back to `httpd-vhosts.conf` and change `*:80` to a random number between 2 and 5 digits (such as `*:43110`). Keep in mind that doing this will require you to specify the port in the URL whenever you access the site (ex. `http://fp.local:43110/flashpoint/`).
