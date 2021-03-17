<?php 
//TODO: Admin should redirect to this page upon login, not the index.

//TODO: Separate fragments of dev side into dev folder, and make production versions of them (and a generator to create future production pages).
@include_once ($_SERVER['DOCUMENT_ROOT'] . "/php/header.php");

//This page should not be accessible, except by anyone with the login:
//@include_once (admin);
?>
<p>This is your dashboard.</p>

<?php @include_once ($_SERVER['DOCUMENT_ROOT'] . "/php/footer.php");