<?php
require_once(APP_PATH . "libs/form/phpmailer/PHPMailer.php");
require_once(APP_PATH . "libs/form/phpmailer/SMTP.php");
require_once(APP_PATH . "libs/form/phpmailer/Exception.php");

if (session_status() === PHP_SESSION_NONE) session_start();
$thisPageName = 'event';

if (!empty($_POST['actionFlag']) && $_POST['actionFlag'] == "send") {
  $aMailto = $aMailtoContact;
  if (count($aBccToContact)) $aBccTo = $aBccToContact;
  $from = $fromContact;
  $fromname = $fromName;
  $subject_admin = "ホームページからお問い合わせがありました";
  $subject_user = "お問い合わせありがとうございました";
  $email_head_ctm_admin = "ホームページからお問い合わせがありました。";
  $email_head_ctm_user = "この度はお問い合わせいただきまして誠にありがとうございます。
こちらは自動返信メールとなっております。
弊社にて確認した後、改めてご連絡させていただきます。

以下、お問い合わせ内容となっております。
ご確認くださいませ。";
  $email_body_footer = "
    About company
  ";

  $entry_time = gmdate("Y/m/d H:i:s", time() + 9 * 3600);
  $entry_host = gethostbyaddr(getenv("REMOTE_ADDR"));
  $entry_ua = getenv("HTTP_USER_AGENT");

  $msgBody = "

■お問い合わせの種類
$reg_sl01

■お名前
$reg_name

■性別
$reg_gender
";
  if (isset($reg_checkAll01) && $reg_checkAll01 != '') $msgBody .= "

■Checkbox1
$reg_checkAll01
";

  if (isset($reg_company) && $reg_company != '') $msgBody .= "

■会社名
$reg_company
";

  if (isset($reg_department) && $reg_department != '') $msgBody .= "

■部署
$reg_department
";

  $msgBody .= "

■お電話番号
$reg_tel
";

  if (isset($reg_fax) && $reg_fax != '') $msgBody .= "

■FAX番号
$reg_fax
";

  $msgBody .= "
■郵便番号
$reg_zipcode

■住所
$reg_address

■メールアドレス
$reg_email
";

  if (isset($reg_time) && $reg_time != '') $msgBody .= "

■連絡希望の時間帯
$reg_time
";

  if (isset($reg_content) && $reg_content != '') $msgBody .= "

■お問い合わせ内容
$reg_content
";



  //お問い合わせメッセージ送信
  $body_admin = "
登録日時：$entry_time
ホスト名：$entry_host
ブラウザ：$entry_ua


$email_head_ctm_admin


$msgBody


";

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
  header("Location: " . get_the_permalink() . "complete/");
  exit;
}

if (!empty($_SESSION['statusFlag'])) {
  unset($_SESSION['statusFlag']);
  unset($_SESSION['ses_gtime_step2']);
  unset($_SESSION['ses_from_step2']);
  unset($_SESSION['ses_step3']);
} else header('location: ' . APP_URL);

include(APP_PATH . "libs/head.php");
?>
<meta http-equiv="refresh" content="15; url=<?php echo APP_URL ?>">
<script type="text/javascript">
  history.pushState({
    page: 1
  }, "title 1", "#noback");
  window.onhashchange = function(event) {
    window.location.hash = "#noback";
  };
</script>
</head>

<body id="event" class="indexThx">
  <!-- HEADER -->
  <?php include(APP_PATH . "libs/header.php") ?>
  <div class="mainImg">
    <h2>EVENT<span>お問い合わせ</span></h2>
  </div>
  <div class="container clearfix">

    <div class="stepImg">
      <img src="<?php echo APP_ASSETS; ?>img/common/form/img_step03.svg" width="714" height="45" alt="フォームからのお問い合わせ　Step" class="pc" />
      <img src="<?php echo APP_ASSETS; ?>img/common/form/img_step03SP.svg" width="345" height="55" alt="フォームからのお問い合わせ　Step" class="sp" />
    </div>

    <div class="containerIndexThx">
      <p class="t20b20 fz18"><strong>送信が完了いたしました。</strong></p>
      <p class="mt20 t20b20 fz14">
        お問い合わせありがとうございます。<br>後日、担当よりご連絡させていただきます。<br />3日以内に弊社より連絡がない場合はお手数ですが、再送信もしくは直接ご連絡くださいますようお願い致します。<br>
      </p>
      <p class="t20b0"><a href="<?php echo APP_URL; ?>">←TOPへ戻る</a></p>
    </div>
  </div>
  <?php // include(APP_PATH.'libs/eventBox.php') 
  ?>
  <!-- FOOTER -->
  <?php include(APP_PATH . 'libs/footer.php') ?>
</body>

</html>