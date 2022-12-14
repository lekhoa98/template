<?php
include_once(dirname(__DIR__) . '/app_config.php');
include_once(dirname(__DIR__) . '/wp/wp-load.php');
$faq = new WP_Query(array(
    'post_type' => 'faq',
    'post_status' => 'publish',
    'orderby'         =>'menu_order',
    'order'           =>'ASC',
    'showposts'       => -1,
    )
);
include(APP_PATH . 'libs/head.php');
?>
<meta http-equiv="expires" content="86400">
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/municipality.min.css">
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
            <div class="sp-scrollbar">
                <ul>
                    <li id="dropd-sp" class="ttl">
                        <p>カテゴリが選択できます</p>
                        <a>
                            <span></span>
                            <span></span>
                        </a>
                    </li>
                    <div id="toggle">
                        <li>開発の経緯</li>
                        <li>導入のメリット</li>
                        <li>仕様・オプション</li>
                        <li>永年保証</li>
                    </div>
                </ul>
            </div>
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
                                    そのネットワークで阪神淡路大震災、東日本大震災にもボラン<br class="sp">ティア<br class="pc">
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
                                    ダミー避難所としてのキャンピングカー<br class="sp">「キャブコン」が、災害対策<br class="pc">
                                    のために一部の自治体で導入が進められています。しかし避難民が数<br class="pc">
                                    千人規模となる現場で、全ての人が温水シャワーやエアコンが搭載さ<br class="pc">
                                    れた高級<br class="sp">キャンピングカーを利用することは、非現実的です。<br class="pc">
                                </div>
                            </div>
                            <div class="part__img">
                                <img src="<?php echo APP_ASSETS; ?>img/municipality/item01-2.jpg" alt="">
                            </div>
                        </div>
                        <div class="blockGray">
                            <h4 class="heading">
                                避難所として高級なキャンピング<br class="sp">カーを導入することの問題点
                            </h4>
                            <div class="blockGray__img">
                                <img class="pc" src="<?php echo APP_ASSETS; ?>img/municipality/item01-3.jpg" alt="">
                                <img class="sp" src="<?php echo APP_ASSETS; ?>img/municipality/item01-3-sp.jpg" alt="">
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
                            ダミー避難所としてのキャンピングカー<br class="sp">「キャブコン」が、災害対策のために一部の自治体で導入が進められています。し<br class="pc">
                            かし避難民が数千人規模となる現場で、全ての人が温水シャワーやエアコンが搭載された高級<br class="sp">キャンピングカーを利用する<br class="pc">
                            ことは、非現実的です。
                        </div>
                    </div>
                </div>
                <div id="anchor2" class="item item--02">
                    <h2 class="item__ttl">
                        開発の経緯
                    </h2>
                    <div class="item__inside">
                        <ul class="blockOrg">
                            <li class="card">
                                <img class="card__img" src="<?php echo APP_ASSETS; ?>img/municipality/item02-1.svg"
                                    alt="">
                                <h3 class="card__ttl">キャンピングカーに比べ低コスト</h3>
                                <div class="card__txt">
                                    １台1000万円以上もするキャンピング<br class="sp">カーを購入する予算を確保することは、簡単なことではありません。しかしGL<br
                                        class="sp">
                                    BASEなら、ハイエース（対象車種）と合<br class="sp">わせても●●万円程度となり、そのハード<br class="sp">ルはぐっと下がるはずです。
                                </div>
                            </li>
                            <li class="card">
                                <img class="card__img" src="<?php echo APP_ASSETS; ?>img/municipality/item02-2.svg"
                                    alt="">
                                <h3 class="card__ttl">登録手続きが容易にできる</h3>
                                <div class="card__txt">
                                    GL BASEは「ハイエース
                                    スーパーGL」に載せるだけ。キャンパーキットは一般的な荷物扱いとなるため、ナンバー変更は不要。また、シート交換、陸運局の構造変更、記載変更などの煩わしい手続きも一切必要ありません。
                                </div>
                            </li>
                            <li class="card">
                                <img class="card__img" src="<?php echo APP_ASSETS; ?>img/municipality/item02-3.svg"
                                    alt="">
                                <h3 class="card__ttl">仕様変更の手軽さ</h3>
                                <div class="card__txt">
                                    基本的にはハイエースなので、荷室のキャンピングキットをおろせば、セカンドシートを折りたたんで元の商用車の仕様に戻り、長尺の荷物・体積の大きな荷物を載せることもできます。
                                </div>
                            </li>
                            <li class="card">
                                <img class="card__img" src="<?php echo APP_ASSETS; ?>img/municipality/item02-4.svg"
                                    alt="">
                                <h3 class="card__ttl">保管・輸送のしやすさ</h3>
                                <div class="card__txt">
                                    GL BASEを使わない時は、ユニットを分解してコンパクトにまとめて保管できるのも大きな利点です。つまり災害時には分解して陸送できるため、現地のハイエースを利用してGL
                                    BASEを活用することができます。
                                </div>
                            </li>
                            <li class="card">
                                <img class="card__img" src="<?php echo APP_ASSETS; ?>img/municipality/item02-5.svg"
                                    alt="">
                                <h3 class="card__ttl">法人への協力要請のしやすさ</h3>
                                <div class="card__txt">
                                    キャンピングカーを何十台も災害対策車両として常時確保するには、固定資産やスペース上の問題がありますが、ハイエースであれば所有できる法人も多いです。通常時はハイエースを法人に所有していただけるため、災害時のみ市町村に貸し出していただくよう協力要請および導入のための助成がしやすくなります。
                                    <br>（具体例は下記参照）
                                </div>
                            </li>
                            <li class="card">
                                <img class="card__img" src="<?php echo APP_ASSETS; ?>img/municipality/item02-6.svg"
                                    alt="">
                                <h3 class="card__ttl">救助活動の拠点以外としても利用可</h3>
                                <div class="card__txt">
                                    <p>災害ボランティアのベース拠点</p>
                                    <p>医療施設などの待機場所や感染症などの受付</p>
                                    <p>感染症などの感染者の方の待機スペース</p>
                                    <p>普段のイベント業務（営業拠点、作業拠点、受付、休憩空間）</p>
                                    <p>テキストテキストテキストテキストなど、様々な状況で利用できるよう想定しています。</p>
                                </div>
                            </li>
                        </ul>
                        <h3 class="item__inside--ttl">
                            ＜法人との連携の具体例＞
                        </h3>
                        <div class="item__inside--txt">
                            <p>全国に十カ所以上拠点を持つ会社に、本社の倉庫で10台分のGL BASEを保管していただきます。</p>
                            <p>それら（ユニット１台あたり80kg、合計800kg）をハイエース１台に載せて現地へと輸送を行います。</p>
                            <p>現地にある支店のハイエースを使用していただくことで、50名分の臨時の避難所として、防災拠点やボランティア活動の拠点になります。
                                （※GL BASE搭載ハイエース１台あたり5名収容可能とする）</p>
                        </div>
                    </div>
                </div>
                <div id="anchor3" class="item item--03">
                    <h2 class="item__ttl">
                        仕様・オプション
                    </h2>
                    <h3 class="title">
                        自治体・医療法人向け 特別キット
                    </h3>
                    <div class="blockOr blockOr--01">
                        <h4 class="blockOr__ttl">
                            GL BASE搭載の「ハイエーススーパーGL」基本構造
                        </h4>
                        <div class="blockOr__img fimg">
                            <img class="pc" src="<?php echo APP_ASSETS; ?>img/municipality/item03-4.jpg" alt="">
                        </div>
                        <div class="blockOr__img fimg sp">
                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-3-sp.jpg" alt="">
                        </div>
                        <div class="slide sp">
                            <div id="slide1" class="blockOr__inner">
                                <div class="blockOr__inner--part">
                                    <div class="cont">
                                        <div class="cont__ttl">
                                            <em>1</em>
                                            運転席・助手席
                                        </div>
                                        <div class="cont__txt">
                                            ダミー通常のハイエースではデッドスペースとなる運転席と助手席の背面にも人が座れるよう、座面シートを装備。後ろ向き２人分の座席が増えます。（背もたれはオプションで追加装備可能）
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <div class="cont__ttl">
                                            <em>3</em>
                                            リアシート
                                        </div>
                                        <div class="cont__txt">
                                            背もたれを前方に折り畳むと、汎用性の高い大きなテーブルが出現。作業台や食卓など幅広く活用できます。<br
                                                class="pc">（0000mm×000mm）
                                        </div>
                                        <div class="cont__img">
                                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-3.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="blockOr__inner--part">
                                    <div class="cont">
                                        <div class="cont__ttl">
                                            <em>2</em>
                                            ダミー座面シート
                                        </div>
                                        <div class="cont__txt">
                                            通常のハイエースではデッドスペースとなる運転席と助手席の背面にも人が座れるよう、座面シートを装備。後ろ向き２人分の座席が増えます。（背もたれはオプションで追加装備可能）
                                        </div>
                                        <div class="cont__img">
                                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-2.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <div class="cont__ttl">
                                            <em>4</em>
                                            荷室
                                        </div>
                                        <div class="cont__txt">
                                            この部分にGL BASEのユニットが組み込まれます。バッテリー・簡易トイレの専用スペース・シンクなどが入ります。
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-slideshow sp"></div>
                        </div>
                    </div>
                    <div class="blockOr blockOr--02">
                        <h4 class="blockOr__ttl">
                            GL BASE キャビネット機能詳細
                        </h4>
                        <div class="blockOr__img">
                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-6.jpg" alt="">

                        </div>
                        <div class="slide sp">
                            <div id="slide2" class="blockOr__inner">
                                <div class="blockOr__inner--part">
                                    <div class="cont">
                                        <div class="cont__ttl">
                                            <em>1</em>
                                            ダミーキャビネット
                                        </div>
                                        <div class="cont__txt">
                                            上下分割機能付きの大型キャビネット。❸の天板が収納できます。
                                        </div>
                                        <div class="cont__img">
                                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-3.jpg" alt="">
                                        </div>
                                        <div class="cont__txt">
                                            オプションでオールフラット仕様も追加できます。
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <div class="cont__ttl">
                                            <em>2</em>
                                            ダミーキャビネット
                                        </div>
                                        <div class="cont__txt">
                                            ダミーセットフォード式の簡易トイレはここに設置します。
                                        </div>
                                    </div>
                                </div>
                                <div class="blockOr__inner--part">
                                    <div class="cont">
                                        <div class="cont__ttl">
                                            <em>3</em>
                                            ダミーキャビネット
                                        </div>
                                        <div class="cont__txt">
                                            ダミー背もたれを前方に折り畳むと、汎用性の高い大きなテーブルが出現。
                                        </div>
                                        <div class="cont__img">
                                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-2.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <div class="cont__ttl">
                                            <em>4</em>
                                            ダミーキャビネット
                                        </div>
                                        <div class="cont__txt">
                                            パッキング方式のトイレはここに設置します。
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <div class="cont__ttl">
                                            <em>5</em>
                                            ダミーキャビネット
                                        </div>
                                        <div class="cont__txt">
                                            自治体・医療法人製品のみを対象にシンクを標準搭載しています。
                                        </div>
                                        <div class="cont__img">
                                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-3.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn2-slideshow sp"></div>
                        </div>
                    </div>
                    <div class="blockOr blockOr--03">
                        <h4 class="blockOr__ttl">
                            用途に合わせてアレンジ可能なシートパターン
                        </h4>
                        <div class="blockOr__inner">
                            <div class="blockOr__inner--forin">
                                <div class="forin-ttl">
                                    フラットシート<span>（スーパーGLのみ）</span>
                                </div>
                                <div class="forin-img">
                                    <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-7.jpg" alt="">
                                </div>
                                <div class="forin-txt">
                                    運転席・助手席のシートを最大まで倒し、ヘッドレストを外します。リヤシートと連結することで長身の方でも足を伸ばして横になることができます。
                                </div>
                            </div>
                            <div class="blockOr__inner--forin">
                                <div class="forin-ttl">
                                    フラットシート
                                </div>
                                <div class="forin-img">
                                    <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-8.jpg" alt="">
                                </div>
                                <div class="forin-txt">
                                    GL BASEのユニットを取り外し、リヤシートを折り畳むことで、ハイエースの荷室を最大限に生かした大空間が生まれ、大きな荷物・背の高い荷物も積載可能です。
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blockOr blockOr--04">
                        <h4 class="blockOr__ttl">
                            スペック・オプション
                        </h4>
                        <div class="blockOr__inner dB">
                            <ul>
                                <li>
                                    <p class="ttl">搭載可能車種</p>
                                    <p class="list mT">ハイエース スーパーGL</p>
                                    <p class="list">ハイエース　特別仕様車 スーパーGL DARK PRIMEⅡ</p>
                                    <span>TOYOTA 公式サイト ハイエース商品ページ　<a
                                            href="https://toyota.jp/hiacevan/">https://toyota.jp/hiacevan/</a></span>
                                </li>
                                <li>
                                    <p class="ttl">基本価格</p>
                                    <p>000,000円 （税込：000,000円）</p>
                                </li>
                                <li>
                                    <p class="ttl">仕様</p>
                                    <p class="orange-txt">標準装備</p>
                                    <p class="list">運転席助手席後ろシート</p>
                                    <p class="list">セカンドシート 大型背面テーブル（W0000mm D000mm）</p>
                                    <p class="list">キャビネット：シンク</p>
                                    <p class="orange-txt">オプション</p>
                                    <p class="list">運転席助手席後ろシート 背もたれ</p>
                                    <p class="list">キャビネット：フルフラット対応</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="blockOr blockOr--05">
                        <h4 class="blockOr__ttl">
                            推奨パーツ（別売）
                        </h4>
                        <div class="blockOr__inner dB">
                            <div class="txt-heading">
                                上記の基本仕様に加えて様々なオプションを組み合わせることで、<br class="pc">
                                ご利用用途に合わせたカスタマイズか可能です。
                            </div>
                            <ul>
                                <li>
                                    <p class="ttl">リチウム電池</p>
                                    <div class="into">
                                        <div class="entry">
                                            <p class="list">JVCケンウッド ポータブル電源</p>
                                            <p class="list">BN-RB10-C</p>
                                            <p class="list">充電池容量 278,400ｍAh/1,002Wh</p>
                                            <div class="txt">
                                                JBL国内メーカーだから安心。上記のサイズまでは、右キャビネット裏のシートボックス内に入ります。次回ロット分からシート使用時もコンセントが利用できるようになります。
                                            </div>
                                        </div>
                                        <div class="entry-img">
                                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-9.jpg" alt="">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <p class="ttl">簡易トイレ（セットフォード方式：左キャビネット）</p>
                                    <div class="into">
                                        <div class="entry">
                                            <p>カーメイト PortaPotti QUBE ポルタポッティキューブ 水洗式ポータブルトイレ</p>
                                            <div class="txt">
                                                JBL国内メーカーだから安心。上記のサイズまでは、右キャビネット裏のシートボックス内に入ります。次回ロット分からシート使用時もコンセントが利用できるようになります。
                                            </div>
                                        </div>
                                        <div class="entry-img">
                                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-10.jpg" alt="">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <p class="ttl">簡易トイレ（ラップ方式）</p>
                                    <div class="into">
                                        <div class="entry">
                                            <p>ラップポン SH-1</p>
                                            <div class="txt">
                                                JBL国内メーカーだから安心。上記のサイズまでは、右キャビネット裏のシートボックス内に入ります。次回ロット分からシート使用時もコンセントが利用できるようになります。
                                            </div>
                                        </div>
                                        <div class="entry-img">
                                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item03-11.jpg" alt="">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-blockOr"><a>一般向け製品の紹介ページはこちら</a></div>
                </div>
                <div id="anchor4" class="item item--04">
                    <h2 class="item__ttl">
                        永年保証
                    </h2>
                    <div class="item__inside">
                        <div class="infor">
                            <img src="<?php echo APP_ASSETS; ?>img/municipality/item04-1.jpg" alt="">
                        </div>
                        <div class="infor__ttl">
                            自治体・医療法人のみを対象とした永年保証
                        </div>
                        <div class="infor__txt">
                            ダミー私たちは社会貢献の一環として、自治体・医療法人向け商品に限り、永年保証サービスを行っております。<br>
                            災害ボランティアや自治体等のご利用において、重量物の高出力発電機を乗せた緊急用のポンプや被災地用浄水機動設備など、一時的であっても思わぬ負荷を乗せてしまい損傷した場合、写真や参加証明をお送りいただければ、特例として無償ですべて交換いたします。保障年数に関係なくご相談ください。
                        </div>
                    </div>
                </div>
                <?php if($faq->have_posts()): ?>
                <div class="item item--05">
                    <h2 class="item__ttl">
                        よくあるご質問
                    </h2>
                    <div class="item__inside">
                        <?php while ($faq->have_posts()) : $faq->the_post();
                        if($post->post_content !=''){
                            ?>
                        <div class="qa">
                            <p class="ques">
                                <?php echo get_the_title($post->ID); ?>
                            </p>
                            <div class="btn-dropdown">
                                <button class="dropdown">
                                    <span></span>
                                    <span class="test"></span>
                                </button>
                            </div>
                            <div class="ans">
                                <?php echo get_the_content($post->ID); ?>
                            </div>
                        </div>
                        <?php } endwhile; ?>
                    </div>
                </div>
                <?php endif;  wp_reset_postdata();?>
            </div>
        </div>
        </div>
        </div>
        </div>
    </main>
    <?php include(APP_PATH . 'libs/footer.php'); ?>
    <a id="scroll-top" class="scrolltop">
        <p>PAGETOP</p>
    </a>
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
            if (($(this).scrollTop() < aTop) || ($(this).scrollTop() >= heights)) {
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
    $(".dropdown").click(function() {
        $(this).toggleClass("active");
        if (($(this).hasClass("active")) === true) {
            $(this).parent().next().slideDown();
        } else {
            $(this).parent().next().slideUp();
        }
    });
    $(window).scroll(function() {
        var aTop = $('#scroll').height();
        if ($(this).scrollTop() >= aTop) {
            $('#scroll-top').fadeIn();
        } else {
            $('#scroll-top').fadeOut();
        }
    });

    $("#scroll-top").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 1000);
    });
    $("#dropd-sp").click(function() {
        $(".ttl").toggleClass("active-sp");
        $("#toggle").slideDown("fast", function() {
            if ($(".ttl").hasClass("active-sp")) {
                $("#toggle").css("display", "block");
            } else {
                $("#toggle").slideUp("fast", function() {
                    $("#toggle").css("display", "none");
                });
            }
        })
    });

    $(document).ready(function() {
        if (window.matchMedia('(max-width: 768px)').matches) {
            if ($('.cont').parent().is("div")) {
                $('.cont').unwrap();
                $('.cont').addClass('cont');
            }
            $('#slide1').slick({
                infinite: false,
                dots: true,
                appendArrows: ".btn-slideshow",
                appendDots: ".btn-slideshow",
                prevArrow: "<button type='button' class='slick-prev'>Previous</button>",
                nextArrow: "<button type'button' class='slick-next'>Next</button>",
            })
            $('#slide2').slick({
                infinite: false,
                dots: true,
                appendArrows: ".btn2-slideshow",
                appendDots: ".btn2-slideshow",
                prevArrow: "<button type='button' class='slick-prev'>Previous</button>",
                nextArrow: "<button type'button' class='slick-next'>Next</button>",
            })
        }
    })
    </script>
</body>