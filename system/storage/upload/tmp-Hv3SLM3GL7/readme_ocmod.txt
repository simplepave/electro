# Testimonials Lite module by VanStudio for OpenCart
# VERSION 1.4.2 (10.03.17)

If you need a support, modification or customized version of this module,
   please contact us > vanstudio.co.ua or info@vanstudio.co.ua

# AUTOMATIC INSTALLATION (OCMOD)
-------------------------------------------------------------------------

In the opencart admin backend, do the following steps:

ATTENTION: you need OC2 Extension Installer configured properly and working

Step 1)
	Go to Extensions > Extension Installer and upload the testimonials-lite-vX.X.ocmod.zip

Step 2)
	Go to "Extensions > Extensions > Modules" menu and install "Testimonials Lite" module

Step 3)
    Go to "Extensions > Modifications" menu and click on the Refresh button (top right of the page).

Step 4)
    Go to System > Users > User Group > Edit Administrator, check the box "testimonial/testimonial"
    and "extension/module/testimonial" to "Access Permission" and "Modify Permission"
    and click on the Save button (top right of the page).

That's it!

Go to link 'http://your-site-domain/index.php?route=testimonial/testimonial' to view the testimonials page.

# Add Google ReCaptcha in versions 2.0.1.0, 2.0.1.1
-------------------------------------------------------------------------

Step 1)
    Go to Extensions > Extension Installer and upload the admin_recaptcha_settings.ocmod.xml
    from the archive testimonials-lite-vX.X.ocmod.zip

Step 2)
    Go to "Extensions > Modifications" menu and click on the Refresh button (top right of the page).

Step 3)
    Go to "System > Store Settings > Server > Google reCAPTCHA" Set Site key and Secret key.

# Add testimonials page link in footer your site
-------------------------------------------------------------------------

Step 1)
    Go to Extensions > Extension Installer and upload the testimonials_front_end.ocmod.xml
    from the archive testimonials-lite-vX.X.ocmod.zip

Step 2)
    Go to "Extensions > Modifications" menu and click on the Refresh button (top right of the page).

# Add testimonials menu structure to admin panel (installed automatically with installing the module)
-------------------------------------------------------------------------

Step 1)
    Go to Extensions > Extension Installer and upload the testimonials_back_end.ocmod.xml
    from the archive testimonials-lite-vX.X.ocmod.zip

Step 2)
    Go to "Extensions > Modifications" menu and click on the Refresh button (top right of the page).


MOST POPULAR ISSUES:
-------------------------------------------------------------------------

1. ERROR in step upload the archive via Extension Installer.

ANSWER: Most likely incorrectly specified FTP settings (System > Settings > Default Store > FTP Tab),

pay attention to the field FTP Root, in this field you need to enter the path from the folder which you get

when you log in to your server using an FTP program (for example this can be a folder public_html or www), to the folder with the files and folders opencart.

If after log in via FTP program you immediately get the folder with the folders and files openсart, field FTP Root should be left empty.


2. Message 'PERMISSION DENIED' when you try to open or edit the extension settings.

ANSWER: Go to System > Users > User Group > Edit Administrator, check the checkbox "testimonial/testimonial",

and "extension/module/testimonial" to "Access Permission" and "Modify Permission" and click on the Save button (top right of the page).


3. NO 'Testimonials Lite' extension in the modules list (Extensions > Extensions > Modules) or no fields with checkboxes "testimonial/testimonial"

and "extension/module/testimonial" in the list Access and Modify Permission (System > Users > User Group > Edit Administrator).

ANSWER: Extension files not uploaded to the server or uploaded in the wrong folder after expansion installation,

the problem is in incorrectly specified FTP settings, look the answer to the issue 1.
