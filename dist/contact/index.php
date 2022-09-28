<?php
if (session_status() === PHP_SESSION_NONE) session_start();
header("Cache-control: public");
ob_start();
include_once(dirname(__DIR__) . '/app_config.php');
$thisPageName = 'contact';
include(APP_PATH . 'libs/head.php');
?>
<meta http-equiv="expires" content="86400">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/contact.min.css">
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/form/validationEngine.jquery.css">
</head>

<body id="contact">
    <?php include(APP_PATH . 'libs/header.php'); ?>

    <?php include(APP_PATH . 'libs/footer.php'); ?>
    <script src="<?php echo APP_ASSETS; ?>js/form/ajaxzip3.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/form/jquery.validationEngine.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/form/languages/jquery.validationEngine-ja.js"></script>
    <script>
    $(document).ready(function() {
        $('#contactform').validationEngine({
            promptPosition: 'topLeft',
            scrollOffset: ($('.header').outerHeight() + 5),
        });
        window.onbeforeunload = function() {
            if (document.contactform.check1 && document.contactform.check1.checked) {
                $('html, body').scrollTop($('#contactform').offset().top);
            }
        };
    })

    function check() {
        if (document.contactform.check1 && !document.contactform.check1.checked) {
            window.alert('「個人情報の取扱いに同意する」にチェックを入れて下さい');
            return false;
        }
    }
    $(document).ready(function() {
        if ($('#mailContact').length) {
            var address = 'xxx' + '@' + 'xxxxxxx.com';
            $('#mailContact').attr('href', 'mailto:' + address).text(address);
        }
    });
    </script>
</body>

</html>