<?php
include_once(dirname(__FILE__) . '/step_confirm.php');
require_once(APP_PATH . "libs/form/phpmailer/PHPMailer.php");
require_once(APP_PATH . "libs/form/phpmailer/SMTP.php");
require_once(APP_PATH . "libs/form/phpmailer/Exception.php");

if ($actionFlag == 'send') {
  $aMailto = $aMailtoContact;
  if (count($aBccToContact)) $aBccTo = $aBccToContact;
  $from = $fromContact;
  $fromname = "GL BASE 株式会社山一建材";
  $subject_admin = "お問い合わせ受付 | GL BASE 株式会社山一建材";
  $subject_user = "お問い合わせ受付 | GL BASE 株式会社山一建材";
  $email_head_ctm_admin = "Webサイトからお問い合わせがありました。";
  $email_head_ctm_user = "name 様

  GL BASE 株式会社山一建材です。
  このメールは、 お問い合わせフォーム送信時の自動返信メールです。

  このたびは、お問い合わせいただき、誠にありがとうございます。
  担当者が確認し次第、改めてご連絡申し上げます。
  
  以下の内容で受付いたしました。ご確認くださいませ。";
  $email_body_footer = "
  GL BASE 株式会社山一建材

  〒500-8879
  岐阜市徹明通8丁目2番地
  TEL.058-253-5353／FAX.058-253-5356
  https://papabase.com
  ";

  $entry_time = gmdate("Y/m/d H:i:s", time() + 9 * 3600);
  $entry_host = gethostbyaddr(getenv("REMOTE_ADDR"));
  $entry_ua = getenv("HTTP_USER_AGENT");

  $msgBody = "

■お問い合わせ項目
$reg_sl01

■会社名・団体名
$reg_company

■お名前
$reg_name

■メールアドレス
$reg_email

■電話番号
$reg_tel
";
  if (isset($reg_fax) && $reg_fax != '') $msgBody .= "

■FAX
$reg_fax
";
  if (isset($reg_zipcode) && $reg_zipcode != '') $msgBody .= "

■ご住所
〒 $reg_zipcode
";
  if (isset($reg_address01) && $reg_address01 != '') $msgBody .= "
$reg_address01
";

  if (isset($reg_content) && $reg_content != '') $msgBody .= "

■お問い合せ内容
$reg_content
";



  //お問い合わせメッセージ送信
  $body_admin = "
登録日時：$entry_time
ホスト名：$entry_host
ブラウザ：$entry_ua


$email_head_ctm_admin


$msgBody

---------------------------------------------------------------
" . $email_body_footer . "
---------------------------------------------------------------";

  //お客様用メッセージ
  $body_user = "
$reg_name 様

$email_head_ctm_user

---------------------------------------------------------------

$msgBody

---------------------------------------------------------------
" . $email_body_footer . "
---------------------------------------------------------------";

  // ▼ ▼ ▼ START Detect SPAMMER ▼ ▼ ▼ //
  try {
    $allow_send_email = 1;
    // Anti spam advanced version 3 start: Verify by google invisible reCaptcha
    if (defined('GOOGLE_RECAPTCHA_KEY_SECRET') && GOOGLE_RECAPTCHA_KEY_SECRET != '') {
      $response = $_POST['g-recaptcha-response'];
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "secret=" . GOOGLE_RECAPTCHA_KEY_SECRET . "&response={$response}");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $returnJson = json_decode(curl_exec($ch));
      curl_close($ch);
      if (!empty($returnJson->success) && $returnJson->score > 0.4) {
      } else throw new Exception('Protect by Google Invisible Recaptcha');
    }

    // Anti spam advanced version 3 start: Verify by google invisible reCaptcha
    if (empty($_SESSION['ses_from_step2'])) throw new Exception('Step confirm must be display');

    // check spam mail by gtime
    $gtime_step2 = $_GET['g'];
    // submit form dosen't have g
    if (!$gtime_step2) {
      throw new Exception('Miss g request');
    } else {
      $cur_time = time();
      if (strlen($cur_time) != strlen($gtime_step2)) {
        throw new Exception('G request\'s not a time');
      } elseif ($_SESSION['ses_gtime_step2'] == $gtime_step2 && ($cur_time - $gtime_step2 < 1)) {
        throw new Exception('Checking confirm too fast');
      }
    }

    // Anti spam advanced version 2 start: Don't send blank emails
    if (empty($reg_name) || empty($reg_email)) {
      throw new Exception('Miss reg_name or reg_email');
    }

    // Anti spam advanced version 1 start: The preg_match() is there to make sure spammers can’t abuse your server by injecting extra fields (such as CC and BCC) into the header.
    if (preg_match("/[\r\n]/", $reg_email)) {
      throw new Exception('Email\'s not correct');
    }

    // Anti spam: the contact form start
    if ($reg_url != "") {
      throw new Exception('Url request must be empty');
    }

    // Anti spam: check session complete contact
    if (!isset($_SESSION['ses_step3'])) $_SESSION['ses_step3'] = false;
    if ($_SESSION['ses_step3']) {
      throw new Exception('Session step 3 must be destroy');
    }
  } catch (Exception $e) {
    $returnE = '<pre>';
    $returnE .= $e->getMessage() . '<br>';
    $returnE .= 'File: ' . $e->getFile() . ' at line ' . $e->getLine();
    $returnE .= '</pre>';
    $allow_send_email = 0;
    // die($returnE);
  }
  // ▲ ▲ ▲ END Detect SPAMMER ▼ ▼ ▼ //


  if ($allow_send_email) {
    //////// お客様受け取りメール送信
    $email = new PHPMailer\PHPMailer\PHPmailer();

    //////// send mail via SMTP
    if (defined('SMTP_ENABLED') && SMTP_ENABLED) {
      $email->IsSMTP();
      $email->SMTPDebug = SMTP_DEBUG;
      $email->SMTPAuth = SMTP_AUTH;
      $email->SMTPSecure = SMTP_SECURE;
      $email->Host = SMTP_HOST;
      $email->Port = SMTP_PORT;
      $email->Username = SMTP_USERNAME;
      $email->Password = SMTP_PASSWORD;
    }

    $email->CharSet = 'utf-8';
    $email->addAddress($reg_email);
    $email->setFrom($from, $fromname);
    $email->Subject = $subject_user;
    $email->Body = $body_user;

    if ($email->send()) { /*Do you want to debug somthing?*/
    }

    //////// メール送信
    $email->clearAddresses();
    for ($i = 0; $i < count($aMailto); $i++) $email->addAddress($aMailto[$i]);
    if (!empty($aBccTo)) {
      for ($i = 0; $i < count($aBccTo); $i++) $email->addBcc($aBccTo[$i]);
    }
    if (!empty($reg_email) && !empty($reg_name)) {
      $email->addReplyTo($reg_email, $reg_name);
    }
    $email->Subject = $subject_admin;
    $email->Body = $body_admin;

    if ($email->send()) { /*Do you want to debug somthing?*/
    }

    $_SESSION['ses_step3'] = true;
  }

  $_SESSION['statusFlag'] = 1;
  header("Location: " . APP_URL . "contact/complete/");
  exit;
}

if (!empty($_SESSION['statusFlag'])) unset($_SESSION['statusFlag']);
else header('location: ' . APP_URL);

$thisPageName = 'contact';
include(APP_PATH . "libs/head.php");

unset($_SESSION['ses_gtime_step2']);
unset($_SESSION['ses_from_step2']);
unset($_SESSION['ses_step3']);
?>
<!-- <meta http-equiv="refresh" content="15; url=<?php echo APP_URL ?>"> -->
<script type="text/javascript">
history.pushState({
  page: 1
}, "title 1", "#noback");
window.onhashchange = function(event) {
  window.location.hash = "#noback";
};
</script>
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/contact.min.css">
</head>

<body id="contact">
  <!-------------------------------------------------------------------------
  HEADER
  --------------------------------------------------------------------------->
  <?php include(APP_PATH . "libs/header.php") ?>
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
        <div class="form__step step3"></div>
        <div class="form__txtend">お問い合わせいただき<br class="sp">ありがとうございました</div>
        <div class="form__txt step3">
          送信が完了しました<br>確認後、折り返しご連絡させていただく場合がござますので、ご承知おきください。<br>2営業日以上経ってもご連絡がない場合は、システムトラブルの可能性がありますので、<br>お手数ですがお電話にてお問い合わせください。
        </div>
        <p class="btn-black"><a href="<?php echo APP_URL; ?>">トップへ戻る</a></p>
      </div>
    </div>
    <?php // include(APP_PATH.'libs/contactBox.php')
  ?>
  </main>
  <!-------------------------------------------------------------------------
  FOOTER
  --------------------------------------------------------------------------->
  <?php include(APP_PATH . 'libs/footer.php') ?>
  <script>
  $(document).ready(function() {
    var address = "xxx" + "@" + "xxxxxxx.com";
    $("#mailContact").attr("href", "mailto:" + address).text(address);
  })
  </script>
</body>

</html>