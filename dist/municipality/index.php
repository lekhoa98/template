<?php
if (session_status() === PHP_SESSION_NONE) session_start();
header("Cache-control: public");
ob_start();
include_once(dirname(__DIR__) . '/app_config.php');
$thisPageName = 'municipality';
include(APP_PATH . 'libs/head.php');
?>
<meta http-equiv="expires" content="86400">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/municipality.min.css">
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/form/validationEngine.jquery.css">
</head>

<body>
    <?php include(APP_PATH . 'libs/header.php'); ?>
    <main id="wrap" class="container">
        <div class="bg">
            <h1 class="title"><span>自治体関係者様へ</span></h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="https://www.google.com.vn">TOP</a></li>
                <li>自治体関係者様へ</li>
            </ul>
        </div>
        <div class="section">
            <div class="scroll-bar">
                <div id="scroll" class="list">
                    <ul>
                        <a class="btn" href="#anchor1">
                            <li class="btn-text">開発の経緯</li>
                        </a>
                        <a class="btn" href="#anchor2">
                            <li class="btn-text">導入のメリット</li>
                        </a>
                        <a class="btn" href="#anchor3">
                            <li class="btn-text">仕様・オプション</li>
                        </a>
                        <a class="btn" href="#anchor4">
                            <li class="btn-text">永年保証</li>
                        </a>
                    </ul>
                </div>
            </div>
            <div class="content">
                <div id="anchor1" class="item item--01">
                    <h2 class="item__ttl">
                        開発の経緯
                    </h2>
                    <div class="item__inside">
                        <div class="part">
                            <div class="part__doc">
                                <h3 class="part__doc__ttl">大規模災害へのボランティア活動で気づいた<br class="pc">「ハイエース」の可能性</h3>
                                <div class="part__doc__txt">
                                    ダミー私たちは建材・建築屋としての事業をベースにした会社です。<br class="pc">
                                    そのネットワークで阪神淡路大震災、東日本大震災にもボランティア<br class="pc">
                                    活動をした経験があります。ボランティアに参加して活動拠点にする<br class="pc">
                                    には、避難拠点だけではなく、ボランティア活動のベース拠点として<br class="pc">
                                    もハイエースがベストだという考えに至りました
                                </div>
                            </div>
                            <div class="part__img">
                                <img src="<?php echo APP_ASSETS; ?>img/municipality/item01-1.jpg" alt="">
                            </div>
                        </div>
                        <div class="part">
                            <div class="part__doc">
                                <h3 class="part__doc__ttl">高級なキャンピングカーを<br class="pc">導入することの難しさ</h3>
                                <div class="part__doc__txt">
                                    ダミー避難所としてのキャンピングカー「キャブコン」が、災害対策<br class="pc">
                                    のために一部の自治体で導入が進められています。しかし避難民が数<br class="pc">
                                    千人規模となる現場で、全ての人が温水シャワーやエアコンが搭載さ<br class="pc">
                                    れた高級キャンピングカーを利用することは、非現実的です。<br class="pc">
                                </div>
                            </div>
                            <div class="part__img">
                                <img src="<?php echo APP_ASSETS; ?>img/municipality/item01-2.jpg" alt="">
                            </div>
                        </div>
                        <div class="blockGray">
                            <h4 class="heading">
                                避難所として高級なキャンピングカーを導入することの問題点
                            </h4>
                            <div class="blockGray__img">
                                <img src="<?php echo APP_ASSETS; ?>img/municipality/item01-3.jpg" alt="">
                            </div>
                            <ul class="list">
                                <li>
                                    <div class="txt1">
                                        コストの問題
                                    </div>
                                    <div class="txt2">
                                        1台あたり1000万円を超える
                                    </div>
                                </li>
                                <li>
                                    <div class="txt1">
                                        利用人数の限界
                                    </div>
                                    <div class="txt2">
                                        一部の方だけが利用できる場合も別の混乱を招く恐れ
                                    </div>
                                </li>
                                <li>
                                    <div class="txt1">
                                        機動性の問題
                                    </div>
                                    <div class="txt2">
                                        小さな道路を通りづらい、駐車スペースをとってしまう
                                    </div>
                                </li>
                                <li>
                                    <div class="txt1">
                                        モラルの問題
                                    </div>
                                    <div class="txt2">
                                        ボランティアスタッフが家庭用エアコン付き、シャワー付きのキャンピングカーでの参加は、<br class="pc">
                                        被災者感情を逆なでる
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="txt">
                            ダミー避難所としてのキャンピングカー「キャブコン」が、災害対策のために一部の自治体で導入が進められています。し<br class="pc">
                            かし避難民が数千人規模となる現場で、全ての人が温水シャワーやエアコンが搭載された高級キャンピングカーを利用する<br class="pc">
                            ことは、非現実的です。
                        </div>
                    </div>
                </div>
                <div id="anchor2" class="item item--02">
                    <h2 class="item__ttl">
                        開発の経緯
                    </h2>
                    <div class="item__inside">
                        <div class="blockOrg">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include(APP_PATH . 'libs/footer.php'); ?>
    <script>
    $(function() {
        $(window).scroll(function() {
            var heights = $("div.scroll-bar").height();
            var aTop = $('#scroll').height();
            if ($(this).scrollTop() >= aTop) {
                console.log(aTop);
                $('#scroll').css({
                    "position": "fixed",
                    "top": "104px",
                    "width": "100%",
                    "max-width": "18%"
                });
            }
            if ($(this).scrollTop() < aTop) {
                var styleObject = $('#scroll').prop('style');
                styleObject.removeProperty('max-width');
                $('#scroll').css({
                    "position": "absolute",
                    "top": "0",
                    "width": "100%"
                });
            }

        });
    });
    </script>
</body>