<?php
if (session_status() === PHP_SESSION_NONE) session_start();
ob_start();
include_once(dirname(__DIR__) . '/app_config.php');
if (empty($_POST['actionFlag']) && empty($_SESSION['statusFlag'])) header('location: ' . APP_URL);

$gtime = time();

//always keep this
$actionFlag       = (!empty($_POST['actionFlag'])) ? htmlspecialchars($_POST['actionFlag']) : '';
$reg_url          = (!empty($_POST['url'])) ? htmlspecialchars($_POST['url']) : '';
//end always keep this

//お問い合わせフォーム内容
$reg_sl01         = (!empty($_POST['fieldCheck'])) ? $_POST['fieldCheck'] : '';
$reg_name         = (!empty($_POST['nameuser'])) ? htmlspecialchars($_POST['nameuser']) : '';
$reg_company      = (!empty($_POST['company'])) ? htmlspecialchars($_POST['company']) : '';
$reg_gender       = (!empty($_POST['gender'])) ? htmlspecialchars($_POST['gender']) : '';
$reg_check01      = (!empty($_POST['check01'])) ? $_POST['check01'] : array();
$reg_checkAll01   = (!empty($_POST['checkAll01'])) ? htmlspecialchars($_POST['checkAll01']) : '';
$reg_department   = (!empty($_POST['department'])) ? htmlspecialchars($_POST['department']) : '';
$reg_tel          = (!empty($_POST['phoneuser'])) ? htmlspecialchars($_POST['phoneuser']) : '';
$reg_fax          = (!empty($_POST['fax'])) ? htmlspecialchars($_POST['fax']) : '';
$reg_zipcode      = (!empty($_POST['zipcode'])) ? htmlspecialchars($_POST['zipcode']) : '';
$reg_address01    = (!empty($_POST['addressuser'])) ? htmlspecialchars($_POST['addressuser']) : '';
$reg_address02    = (!empty($_POST['address02'])) ? htmlspecialchars($_POST['address02']) : '';
$reg_pref_name    = (!empty($_POST['pref_name'])) ? htmlspecialchars($_POST['pref_name']) : '';
$reg_email        = (!empty($_POST['emailuser'])) ? htmlspecialchars($_POST['emailuser']) : '';
$reg_time         = (!empty($_POST['time'])) ? htmlspecialchars($_POST['time']) : '';
$reg_content      = (!empty($_POST['content'])) ? htmlspecialchars($_POST['content']) : '';
$br_reg_content   = nl2br($reg_content);

if ($actionFlag == "confirm") {
  $thisPageName = 'contact';
  include(APP_PATH . 'libs/head.php');
  $_SESSION['ses_from_step2'] = true;
  if (!isset($_SESSION['ses_gtime_step2'])) $_SESSION['ses_gtime_step2'] = $gtime;
?>
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/contact.min.css">
<!-- Anti spam part1: the contact form start -->

<?php if (
    defined('GOOGLE_RECAPTCHA_KEY_API') && GOOGLE_RECAPTCHA_KEY_API != '' &&
    defined('GOOGLE_RECAPTCHA_KEY_SECRET') && GOOGLE_RECAPTCHA_KEY_SECRET != ''
  ) { ?>
<script src="https://www.google.com/recaptcha/api.js?hl=ja" async defer></script>
<script>
function onSubmit(token) {
  document.getElementById("confirmform").submit();
}
</script>
<style>
.grecaptcha-badge {
  display: none
}
</style>
<?php } ?>

</head>

<body id="contact">
  <?php include(APP_PATH . 'libs/header.php'); ?>

  <main id="wrap" class="container">
    <div class="bg">
      <h1 class="title"><span>お問い合わせ</span></h1>
    </div>
    <div class="breadcrumb">
      <ul>
        <li><a href="https://www.google.com.vn">TOP</a></li>
        <li>お問い合わせ</li>
      </ul>
    </div>
    <div class="wcm">
      <div class="form">
        <h2 class="form__ttl">フォームからのお問い合わせ</h2>
        <div class="form__step step2"></div>
        <form method="post" class="confirmform" action="../complete/?g=<?php echo $gtime ?>" name="confirmform"
          id="confirmform">
          <div class="form__content">
            <div class="row">
              <div class="th">
                <div class="row-name step2">お問い合わせ項目</div>
              </div>
              <div class="td"><?php for($i=0;$i<=count($reg_sl01);$i++){?>
                <p><?php echo $reg_sl01[$i];?></p>
                <?php } ?>
              </div>
            </div>
            <div class="row">
              <div class="th">
                <div class="row-name step2">会社名・団体名</div>
              </div>
              <div class="td"><?php echo $reg_company; ?></div>
            </div>
            <div class="row">
              <div class="th">
                <div class="row-name step2">お名前</div>
              </div>
              <div class="td"><?php echo $reg_name; ?></div>
            </div>
            <div class="row">
              <div class="th">
                <div class="row-name step2">メールアドレス</div>
              </div>
              <div class="td"><?php echo $reg_email; ?></div>
            </div>
            <div class="row">
              <div class="th">
                <div class="row-name step2">お電話番号</div>
              </div>
              <div class="td"><?php echo $reg_tel; ?></div>
            </div>
            <?php if (!empty($reg_fax)) { ?>
            <div class="row">
              <div class="th">
                <div class="row-name step2">FAX</div>
              </div>
              <div class="td"><?php echo $reg_fax; ?></div>
            </div>
            <?php } ?>
            <?php if (!empty($reg_zipcode)) { ?>
            <div class="row">
              <div class="th">
                <div class="row-name step2">ご住所</div>
              </div>
              <div class="td"><?php echo '〒'.$reg_zipcode; echo "<br>";
              if(!empty($reg_address01)){
                echo $reg_address01;
              } ?></div>

            </div>
            <?php } ?>
            <?php if (!empty($reg_content)) { ?>
            <div class="row">
              <div class="th">
                <div class="row-name step2">お問い合わせ内容</div>
              </div>
              <div class="td"><?php echo $reg_content; ?></div>
            </div>
            <?php } ?>
          </div>
          <input type="hidden" name="fieldCheck" value="<?php echo implode('
',$reg_sl01) ?>">
          <input type="hidden" name="nameuser" value="<?php echo $reg_name ?>">
          <input type="hidden" name="company" value="<?php echo $reg_company ?>">
          <input type="hidden" name="phoneuser" value="<?php echo $reg_tel ?>">
          <input type="hidden" name="fax" value="<?php echo $reg_fax ?>">
          <input type="hidden" name="emailuser" value="<?php echo $reg_email ?>">
          <input type="hidden" name="zipcode" value="<?php echo $reg_zipcode ?>">
          <input type="hidden" name="addressuser" value="<?php echo $reg_address01 ?>">
          <input type="hidden" name="content" value="<?php echo $reg_content ?>">
          <!-- always keep this -->
          <input type="hidden" name="url" value="<?php echo $reg_url ?>">
          <!-- end always keep this -->
          <div id="btn" class="form__button">
            <?php if (defined('GOOGLE_RECAPTCHA_KEY_API') && GOOGLE_RECAPTCHA_KEY_API != '') { ?>
            <button name="actionFlag" value="send" class="btn-txt g-recaptcha" data-size="invisible"
              data-sitekey="<?php echo GOOGLE_RECAPTCHA_KEY_API ?>" data-callback="onSubmit"><span
                class="btn-txt">この内容で送信する</span></button>
            <?php } else { ?>
            <button id="btnSend"><span class="btn-txt">この内容で送信する</span></button>
            <?php } ?>
            <input type="hidden" name="actionFlag" value="send">
          </div>
          <p class="form__back">
            <a href="javascript:history.back()">
              入力内容を修正する
            </a>
          </p>
      </div>
      </form>
    </div>
    </div>
  </main>

  <?php include(APP_PATH . 'libs/footer.php'); ?>
  <script>
  $(document).ready(function() {
    $('#confirmform').on('click', '#btnSend', function(e) {
      e.preventDefault();
      $(this).html('<span>送信中...</span>').prop('disabled', true).addClass('disabled');
      $('#confirmform').submit();
    })
  });
  </script>
</body>

</html>
<?php } ?>