<?php include ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php"); ?>
<section style="display: block;">
<div class="nested" id="navbar">
    <img src="/images/webmill_logo.png" height="64px" width="64px" class="nested" id="navbar-logo">
    <div class="nested" id="navbar-title">
        Web Mill
    </div>
    <a href="/index.php" class="nested nav-bttn" id="navbar-home-link">
        Home
    </a>
    <a href="/admin.php" class="nested nav-bttn" id="navbar-admin-link">
        Admin
    </a>
</div>
<div class="nested wm-hero">
    <div class="nested" id="main-text">
        <h1 class="nested welcome" style="">Welcome to Web Mill!</h1>
        <span id="clock" class="nested"></span>
    </div>
</div>
</section>
<section style="position: absolute; top: 100%; height: 50%; background-color: rgba(0,0,0,0.3);">
    <div class="body-text" style="padding: 2em 10%;">
        <h1>Get started on your new website</h1>
        <p style="padding: 0  10% 0 0; width: 80%; text-align: justify; display: inline-block;">
            Rather than copy and paste some lorem ipsum text, I pondered the thought of simply writing something, myself. We have all come to recognize the peculiar lorem ipsum, but let's face it: this is how your users are going to see your website. Not with blobs of gibberish, but words and thoughts put together (and perhaps the occasional missed typo or two). I hope you didn't mind reading this small wall of text. Now, you will be able to create your own text!
        </p>
        <image src="/images/keyboard_small.webp" style="display: inline-block;" width="200px" height="200px" alt="keyboard">
    </div>
</section>
<section style="position: absolute; top: 150%; height: 50%; background-color: rgba(255,255,255,0.3);">
    <div class="body-text" style="padding: 2em 10%;">
        <h1 style="text-align: right;">Grab a new template or use this one</h1>
        <image src="/images/drawing_small.webp" style="display: inline-block;" width="200px" height="200px" alt="drawing supplies">
        <p style="padding: 0 0 0 10%; width: 80%; text-align: justify; display: inline-block;">
            Using the easy drag-and-drop tools, you can easily modify this default template instead of installing a new one or creating one from scratch. One nice thing about Web Mill is that changes made to your website do not have to be immediately seen on the web. We all mess things up every now and again. Users also do not like to see the page changing as they refresh the page or navigate the website. This way, you only update the website once all changes are complete. Pretty nice, right?
        </p>
    </div>
</section>
<div class="nested" id="footer">
    <div class="nested" id="copyright">
        <div class="nested" id="copyright-text">
            Copyright&nbsp;©&nbsp;
        </div>
        <div class="nested" id="copyright-year">
            <?php echo date("Y"); ?>
        </div>
        <div class="nested" id="copyright-name">
            &nbsp;<?= $ORGANIZATION ?>
        </div>
        &nbsp;-&nbsp;
        <a href="/pages/privacy.php">Privacy</a>
        &nbsp;-&nbsp;
        <a href="/pages/tos.php">Terms of Service</a>
    </div>
</div>
<?php include ($_SERVER['DOCUMENT_ROOT'] . "/php/footer.php");