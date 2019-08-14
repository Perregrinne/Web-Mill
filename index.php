<?php
    //This is the default index.php (home) page.
?>
<html>
    <head>
        <?php
            include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");

            //Included scripts
            $includes = [];

            $includes['clock'] = '<script src="/javascript/clock.js"></script>';

            //All href locations
            $hrefs = [];
            $hrefs['navbar-home-link'] = '/index.php';
            $hrefs['navbar-admin-link'] = '/admin.php';

            //All files
            $files = [];
            $files['navbar-logo'] = '/favicon.png';

            //Tracks content type
            $contentType = [];
            $contentType['navbar'] = 'div';
            $contentType['navbar-logo'] = 'img';
            $contentType['navbar-title'] = 'div';
            $contentType['navbar-home-link'] = 'href';
            $contentType['navbar-admin-link'] = 'href';
            $contentType['main-text'] = 'h1';
            $contentType['clock'] = 'span';
            $contentType['footer'] = 'div';
            $contentType['copyright'] = 'div';
            $contentType['copyright-text'] = 'div';
            $contentType['copyright-year'] = 'div';
            $contentType['copyright-name'] = 'div';

            //All of the content found in the body of the html
            $bodyContent = [];
            //Nested element of bodyContent
            $navbarContent = [];
            //Nested element of bodyContent
            $footerContent = [];
            //Nested element of footerContent
            $copyrightContent = [];

            $copyrightContent['copyright'] = '&nbsp';
            $copyrightContent['copyright-text'] = 'Copyright' . '&nbsp&copy&nbsp';
            $copyrightContent['copyright-year'] = date('Y');
            $copyrightContent['copyright-name'] = '&nbsp' . 'Your Name Here';//$ORGANIZATION;

            $footerContent['footer'] = '&nbsp';
            $footerContent['copyright'] = $copyrightContent;
            

            $navbarContent['navbar'] = '&nbsp';
            $navbarContent['navbar-logo'] = '/favicon.png';
            $navbarContent['navbar-title'] = 'Web Mill';//$ORGANIZATION;
            $navbarContent['navbar-home-link'] = 'home';
            $navbarContent['navbar-admin-link'] = 'admin';

            $bodyContent['navbar'] = $navbarContent;
            $bodyContent['main-text'] = 'Welcome to your website!';
            $bodyContent['clock'] = '<script src="/javascript/clock.js" onload="getTime(); setInterval(\'getTime()\', 1000);"></script>';
            $bodyContent['footer'] = $footerContent;

        ?>
    </head>
    <body id="body" class="nested">
        <?php
            while ($elem = current($bodyContent))
            {
                $idKey = key($bodyContent);
                displayElem($idKey, $contentType[$idKey], $elem);
                next($bodyContent);
            }
            /*
            echo '<div class="nested" id="main-text">This is your new website!</div>';
            echo '<script src="/javascript/clock.js"></script>';
            echo '<br>';
            echo '<span class="nested" id="clock"></span>';
            echo '<br>';
            echo '<a href="/admin.php" class="nested" id="admin-link" style="position: absolute;">Admin</a>';
            echo '<div class="nested" id="nestBoxTest" style="position: absolute; left: 300px; top: 100px; height: 500px; width: 500px; background-color: green;">&nbsp</div>';
            */

            function displayElem($elemId, $elemType, $elemContent)
            {
                global $hrefs;
                global $files;
                global $includes;

                switch ($elemType)
                {
                    case 'div':
                        echo '<div class="nested" id="' . $elemId . '">';
                        if(is_array($elemContent))
                        {
                            getElem($elemContent);
                        }
                        else
                        {
                            echo $elemContent;
                        }
                        echo '</div>';
                        break;
                    case 'span':
                        echo '<span class="nested" id="' . $elemId . '">';
                        if(is_array($elemContent))
                        {
                            getElem($elemContent);
                        }
                        else
                        {
                            echo $elemContent;
                        }
                        echo '</span>';
                        break;
                    case 'h1':
                        echo '<h1 class="nested" id="' . $elemId . '">';
                        if(is_array($elemContent))
                        {
                            getElem($elemContent);
                        }
                        else
                        {
                            echo $elemContent;
                        }
                        echo '</h1>';
                        break;
                    case 'href':
                        echo '<a href="' . $hrefs[$elemId] . '" class="nested" id="' . $elemId . '">';
                        if(is_array($elemContent))
                        {
                            getElem($elemContent);
                        }
                        else
                        {
                            echo $elemContent;
                        }
                        echo '</a>';
                        break;
                    case 'img':
                        echo '<img src="' . $files[$elemId] . '" class="nested" id="' . $elemId . '">';
                        break;
                    case 'script':
                        echo '<script src="' . $includes[$elemId] . '" class="nested" id="' . $elemId . '"></script>';
                        break;
                }
            }

            function getElem($content)
            {
                global $contentType;

                while ($elem = current($content))
                {
                    $idKey = key($content);
                    displayElem($idKey, $contentType[$idKey], $elem);
                    next($content);
                }
            }
        ?>
    </body>
</html>