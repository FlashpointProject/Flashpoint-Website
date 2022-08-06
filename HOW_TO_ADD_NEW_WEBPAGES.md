# How to add new webpages

So as you might have noticed, the way the resource files for the website are stored changed quite a lot.

But heads up, it's not that complicated.

This will actually save you some time, when you want to apply some changes to all the webpages at once (changing the 
logo, adding a new option to the sidebar menu, etc.).

So let's say that you want to create a new static webpage for credits. You'd need to follow these steps:

1. Open `routes.ini`. This file holds all available URL routes. If a user tries to type an address to the address bar,
that isn't present in this file, they'll get the 404 error.
2. Write the part of the URL address, that comes AFTER `https://bluemaxima.org/flashpoint/` to a new line.
Follow this with `=` and then write the name of the controller, that will take care of this request (more about it 
later).  
Example:
```ini
credits=Credits
```
This will cause the Credits controller to respond requests on `https://bluemaxima.org/flashpoint/credits`.

3. Open the `Controllers` directory and create a new file with the name you used in the `routes.ini` file, in our case,
`Credits.php`.
4. Inside the empty file, paste the following text:

```php
<?php

namespace Flashpoint\Controllers;

class [CONTROLLER NAME] extends Controller
{

    /**
     * Method setting the view and headers for the [WEBPAGE NAME] page
     * @param array $args Leave this array empty - no data are used
     * @return bool TRUE, if the data was set successfully
     */
    public function process(array $args): bool
    {
        self::$data['layout_title'] = '[WEBPAGE TITLE]';
        self::$data['layout_description'] = '[WEBPAGE DESCRIPTION]';
        self::$data['layout_keywords'] = '[WEBPAGE KEYWORDS]';

        self::$views[] = '[VIEW NAME]';
        self::$cssFiles[] = '[CSS FILE NAME]';
        return true;
    }
}
```
5. On line 5 of the copied file, change `[CONTROLLER NAME]` for the same name as the name of the file, `Credits` in our
case.
6. Feel free to edit the comment on line 9 and change `[WEBPAGE NAME]` the name of the webpage. This doesn't have any
effect on the system.
7. On lines 15, 16 and 17, you can change the webpage's title, description and keywords. These values will eventually be
used in the corresponding HTML `<title>` and `<meta>` tags.
8. On line 19, you need to replace `[VIEW NAME]` with the name of a new view. You'd probably use `credits` in our
scenario.
9. On line 20, you can specify name of an additional CSS file that will be applied to the new webpage. This step isn't
necessary, as all webpages will have the `styles.css` file applied to them by default. If you don't with to add a CSS
file just for this one webpage, delete this line. DON'T WRITE CSS INTO `<style>` TAGS IN THE VIEWS PLEASE.
10. There's also a way to set JavaScript files similar way, let me know if you need to use JavaScript in the future.
11. You can now close the controller file.
12. Move to the `Views` directory and create a new file here, with the same name as you chose in step 7, in our case,
`credits.phtml`. You can also copy-paste the present `template.phtml` file.
13. You can start writing HTML code into this file. Open other view files in the same folder to see where to start. The
content of this file will be inserted into the HTML found in the `layout.phtml` file, so don't write tags like `<html>`,
`<head>` or `<body>`.
14. In the meantime, you can open the webpage in your browser. It'll already work, in our scenario, just open
`localhost/credits` (or however you have your local host set). You should see an empty webpage with the Flashpoint
layout.
15. To upload a new image, simply drop it into the `images` folder and refer to it like this:
`<img src="images/my_image.png" />`.

If you ever need to change something in the layout of the webpage, just edit the `layout.phtml` file inside the `Views`
directory to see changes in the layout of all webpages at once.
