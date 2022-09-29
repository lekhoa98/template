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
            <div class="content content--01">
                <h2 class="ttl">
                    お問い合わせいただく前に「FAQ よくある質問」ページをご参照ください。
                </h2>
                <div class="txt">
                    当社によく寄せられるお問い合わせ内容を <u>FAQ（よくある質問）</u> にまとめてご紹介しております。<br>
                    営業時間外はお問い合わせの対応をいたしておりませんが、<br>
                    こちらをご確認いただくことですぐに解決する場合もございますので、<br>
                    まずはご参照くださいますようお願い申し上げます。
                </div>
            </div>
            <div class="content content--02">
                <h2 class="ttl">
                    お電話でのお問い合わせ
                </h2>
                <div class="phone">
                    <p>050-3554-6370</p>
                    月～土 9:00～17:00（休：第２第４土,日,祝)
                </div>
                <div class="txt">
                    専門担当が対応いたしますので、すぐにはお電話に出られない場合がございます。<br>
                    お急ぎのところ恐れ入りますが、下記のお問い合わせフォームより<br>
                    必要事項をご入力のうえ送信していただきましたら、<strong>3営業日以内</strong>に担当者よりご連絡さしあげます。
                </div>
            </div>
        </div>
        <div class="wcm">
            <div class="form">
                <h2 class="form__ttl">フォームからのお問い合わせ</h2>
                <div class="form__step"></div>
                <div class="form__txt">
                    下記の情報にご記入の上、「入力内容を確認する」ボタンをクリックしてください。<br>
                    折り返し弊社よりご連絡させていただきます。
                </div>
                <div class="form__content">
                    <div class="row">
                        <div class="th">
                            <p class="cat">必須</p>
                            <div class="row-name">お問い合わせ項目<span>（複数選択可能）</span></div>
                        </div>
                        <div class="td">
                            <div class="checkboxGr">
                                <?php 
                                $fieldCheck = array("製品について","設置について","購入について","保証・アフターフォローについて","その他");
                                for($i=0;$i<count($fieldCheck);$i++){ ?>
                                <label for="$fieldCheck<?php echo $i+1?>" class="item">
                                    <input type="checkbox" name="fieldCheck[]" id="fieldCheck<?php echo $i+1; ?>"
                                        value="<?php echo $fieldCheck[$i];?>" class="validate[required]">
                                    <span class="checkbox-txt"><?php echo $fieldCheck[$i]; ?></span>
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="th">
                            <p class="cat">必須</p>
                            <div class="row-name">会社名・団体名<span>個人の方は「個人」と<br>ご記入ください</span></div>
                        </div>
                        <div class="td">
                            <input type="text" name="company" id="company" class="input100 validate[required]">
                            <p class="placeholder">例：◯◯株式会社</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="th">
                            <p class="cat">必須</p>
                            <div class="row-name">お名前</div>
                        </div>
                        <div class="td">
                            <input type="text" name="nameuser" id="nameser" class="input50 validate[required]">
                            <p class="placeholder">例：田中　太郎</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="th">
                            <p class="cat">必須</p>
                            <div class="row-name">メールアドレス</div>
                        </div>
                        <div class="td">
                            <input type="email" name="emailuser" id="emailuser"
                                class="input50 validate[required,custom[email]]">
                            <p class="placeholder">例：info@yamaichi-net.com</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="th">
                            <p class="cat">必須</p>
                            <div class="row-name">お電話番号</div>
                        </div>
                        <div class="td">
                            <input type="tel" name="phoneuser" id="phoneuser"
                                class="input30 validate[required,custom[phone]]">
                            <p class="placeholder">例：05035546370</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="th">
                            <p class="cat option">任意</p>
                            <div class="row-name">FAX</div>
                        </div>
                        <div class="td">
                            <input type="tel" name="fax" id="fax" class="input30 validate[required,custom[phone]]">
                            <p class="placeholder">例：05035546371</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="th">
                            <p class="cat option">任意</p>
                            <div class="row-name">ご住所</div>
                        </div>
                        <div class="td">
                            <span>〒</span><input type="text" name="zipcode" id="zipcode"
                                class="input20 validate[required,custom[phone]]"><span
                                class="txt">※郵便番号を入力すると自動で住所が入力されます</span>
                            <p class="placeholder txt">例：5020928</p>
                            <input type="text" name="addressuser" id="addressuser"
                                class="input100 validate[required,custom[phone]]">
                            <p class="placeholder">例：岐阜県岐阜市旦島中1丁目5−25</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="th">
                            <p class="cat option">任意</p>
                            <div class="row-name">お問い合わせ内容</div>
                        </div>
                        <div class="td">
                            <textarea name="content" id="content" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form__privacy">
                    <div class="ttl">
                    【個人情報の取扱いについて】
                    </div>
                    <div class="txt">
                    本入力フォームおよびメールでご連絡頂きましたお客様の個人情報につきましては、厳重に管理を行っております。 法令などに基づき正規の手続きによって司法捜査機関による開示要求が行われた場合を除き、第三者に開示もしくは提供することはございません。<br>
                    プライバシーポリシーについては<a>こちら</a>をご覧ください。
                    </div>
                </div>
                <label for="checksubmit" class="form__check">
                    <input type="checkbox" name="checksubmit" value="ok" id="checksubmit">
                    <span class="checkbox-txt">個人情報の取扱いに同意する</span>
                </label>
            </div>
        </div>
    </main>
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