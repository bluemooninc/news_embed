<?php
// $Id: modinfo.php,v 1.52 2005/03/13 12:59:36 hthouzard Exp $
//ModuleInfo

//Thenameofthismodule
define("_MI_NEWS_NAME","ニュース");

//Abriefdescriptionofthismodule
define("_MI_NEWS_DESC","ユーザが自由にコメントできる、スラッシュドット風のニュース記事システムを構築します");

//Namesofblocksforthismodule(Notallmodulehasblocks)
define("_MI_NEWS_BNAME1","ニューストピック");
define("_MI_NEWS_BNAME3","本日のトップニュース");
define("_MI_NEWS_BNAME4","トップニュース");
define("_MI_NEWS_BNAME5","最新ニュース");
define("_MI_NEWS_BNAME6","承認待ちのニュース");
define("_MI_NEWS_BNAME7","全トピック一覧");

//Submenusinmainmenublock
define("_MI_NEWS_SMNAME1","ニュース投稿");
define("_MI_NEWS_SMNAME2","アーカイブ");

//define("_MI_NEWS_ADMENU1","一般設定");
define("_MI_NEWS_ADMENU2","トピック管理");
define("_MI_NEWS_ADMENU3","ニュース記事の投稿/編集");
define('_MI_NEWS_GROUPPERMS','権限の管理');
//AddedbyHerv・forpruneoption
define('_MI_NEWS_PRUNENEWS','ニュースを削除');
//AddedbyHerv・
define('_MI_NEWS_EXPORT','ニュースのエクスポート');

//Titleofconfigitems
define("_MI_STORYHOME","トップページに掲載する記事数");
define("_MI_NOTIFYSUBMIT","新規投稿の際にメールで知らせる");
define("_MI_DISPLAYNAV","ナビゲーションボックスを表示する");
define('_MI_AUTOAPPROVE','管理者の介在しない新規ニュース記事の自動承認');
define("_MI_ALLOWEDSUBMITGROUPS","ニュース投稿可のグループ");
define("_MI_ALLOWEDAPPROVEGROUPS","ニュース承認可のグループ");
define("_MI_NEWSDISPLAY","ニュースの表示レイアウト");
define("_MI_NAMEDISPLAY","投稿者名");
define("_MI_COLUMNMODE","列数");
define("_MI_STORYCOUNTADMIN","管理ページに表示する記事の数を指定してください。(このオプションは管理ページに表示されたトピックの数を制限するのに使用されます。そして、それは統計にも使用されます。):");
define('_MI_UPLOADFILESIZE','最大アップロードファイルサイズ(byte)1048576=1MB');
define("_MI_UPLOADGROUPS","アップロードを許可されたグループ");


//Descriptionofeachconfigitems
define("_MI_STORYHOMEDSC","トップページに表示する記事の数を指定してください。");
define("_MI_NOTIFYSUBMITDSC","新規投稿があった時にお知らせメールをウェブマスターに送信するには「はい」を選択してください。");
define("_MI_DISPLAYNAVDSC","カテゴリを選択するナビゲーションボックスを記事の上部に表示するには「はい」を選択してください。");
define('_MI_AUTOAPPROVEDSC','管理者の承認操作なしに新規ニュース記事の承認を行う場合は「はい」を選択してください。');
define("_MI_ALLOWEDSUBMITGROUPSDESC","選択されているグループが記事を投稿できます");
define("_MI_ALLOWEDAPPROVEGROUPSDESC","選択されているグループが記事を承認できます");
define("_MI_NEWSDISPLAYDESC","「クラシック」:従来どおりすべてのニュースを公開日により表示｡「トピックスごと」:記事をトピックスごとにグループ分けして、最新記事だけはフル表示してその他の記事はタイトルのみ");
define('_MI_ADISPLAYNAMEDSC','投稿者名を表示する方法を選択');
define("_MI_COLUMNMODE_DESC","表示する記事リストの列数を選択");
define("_MI_STORYCOUNTADMIN_DESC","");
define("_MI_UPLOADFILESIZE_DESC","");
define("_MI_UPLOADGROUPS_DESC","サーバーにアップロード可能なグループを選択");

//Nameofconfigitemvalues
define("_MI_NEWSCLASSIC","クラシック");
define("_MI_NEWSBYTOPIC","トピックスごと");
define("_MI_DISPLAYNAME1","投稿者名");
define("_MI_DISPLAYNAME2","投稿者本名");
define("_MI_DISPLAYNAME3","投稿者を表示しない");
define("_MI_UPLOAD_GROUP1","投稿者と承認者");
define("_MI_UPLOAD_GROUP2","承認者だけ");
define("_MI_UPLOAD_GROUP3","アップロード禁止");

//Textfornotifications

define('_MI_NEWS_GLOBAL_NOTIFY','モジュール全体');
define('_MI_NEWS_GLOBAL_NOTIFYDSC','ニュースモジュール全体における通知オプション');

define('_MI_NEWS_TOPIC_NOTIFY','表示中のトピック');
define('_MI_NEWS_TOPIC_NOTIFYDSC','表示中のトピックに対する通知オプション');

define('_MI_NEWS_STORY_NOTIFY','表示中のニュース記事');
define('_MI_NEWS_STORY_NOTIFYDSC','表示中のニュース記事に対する通知オプション');

define('_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFY','新規トピック');
define('_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYCAP','新規トピックが作成された場合に通知する');
define('_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYDSC','新規トピックが作成された場合に通知する');
define('_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYSBJ','[{X_SITENAME}]{X_MODULE}:新規トピックが作成されました');

define('_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFY','新規ニュース記事投稿');
define('_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYCAP','新規ニュースの投稿があった場合に通知する');
define('_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYDSC','新規ニュースの投稿があった場合に通知する');
define('_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYSBJ','[{X_SITENAME}]{X_MODULE}:新規ニュースの投稿がありました');

define('_MI_NEWS_GLOBAL_NEWSTORY_NOTIFY','新規ニュース記事掲載');
define('_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYCAP','新規ニュース記事が掲載された場合に通知する');
define('_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYDSC','新規ニュース記事が掲載された場合に通知する');
define('_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYSBJ','[{X_SITENAME}]{X_MODULE}:新規ニュースが掲載されました');

define('_MI_NEWS_STORY_APPROVE_NOTIFY','ニュース記事の承認');
define('_MI_NEWS_STORY_APPROVE_NOTIFYCAP','このニュース記事が承認された場合に通知する');
define('_MI_NEWS_STORY_APPROVE_NOTIFYDSC','このニュース記事が承認された場合に通知する');
define('_MI_NEWS_STORY_APPROVE_NOTIFYSBJ','[{X_SITENAME}]{X_MODULE}:ニュース記事が承認されました');

define('_MI_RESTRICTINDEX','制限されたトピックスだけインデックス目次に表示しますか?');
define('_MI_RESTRICTINDEXDSC','もしも、「はい」にすると、「投稿／承認アクセス権管理」で指定した権利権のある記事だけがインデックス目次にリスト表示されます');

define('_MI_NEWSBYTHISAUTHOR','「この投稿者の記事」の表示しますか?');
define('_MI_NEWSBYTHISAUTHORDSC','これを「はい」にすると,\'この投稿者の記事\'のリンクが表示されます');

define('_MI_NEWS_PREVNEX_LINK','「前へ」「次へ」の表示しますか?');
define('_MI_NEWS_PREVNEX_LINK_DESC','これを「はい」にすると,記事の下に２つのリンクが表示されます。記事公開日付で「前へ」「次へ」移動します。');
define('_MI_NEWS_SUMMARY_SHOW','概要テーブルを表示しますか?');
define('_MI_NEWS_SUMMARY_SHOW_DESC','これを「はい」にすると,すべての最近の発行された記事へのリンクを含む概要が記事の下に表示されます。');
define('_MI_NEWS_AUTHOR_EDIT','投稿者による記事の変更を可能にしますか?');
define('_MI_NEWS_AUTHOR_EDIT_DESC','これを「はい」にすると,投稿者は自分記事の変更ができるようになります。');
define('_MI_NEWS_RATE_NEWS','記事の評価を有効にしましすか?');
define('_MI_NEWS_TOPICS_RSS','１トピックごとのＲＳＳ送信を有効にしましすか?');
define('_MI_NEWS_TOPICS_RSS_DESC',"これを「はい」にすると,１トピックごとのＲＳＳ送信を有効になります。");
define('_MI_NEWS_DATEFORMAT',"日付の表示形式");
define('_MI_NEWS_DATEFORMAT_DESC',"(例Y/n/jH:i)形式指定の詳細はPhpのマニュアルを参照願います(http://fr.php.net/manual/en/function.date.php).メモ,もしもなにも指定していいない場合はXoopsの初期値が使用します");
define('_MI_NEWS_META_DATA',"メタデータ(keywordsとdescription)への文字挿入機能を有効にする?");
define('_MI_NEWS_META_DATA_DESC',"これを「はい」にすると,メタデータ:keywordsanddescriptionにへの文字挿入の指定が可能になります。");
define('_MI_NEWS_BNAME8','ランダム記事');
define('_MI_NEWS_NEWSLETTER','ニュースレター');
define('_MI_NEWS_STATS','統計');
define("_MI_NEWS_FORM_OPTIONS","フォームオプション");
define("_MI_NEWS_FORM_COMPACT","コンパクト");
define("_MI_NEWS_FORM_DHTML","DHTML");
define("_MI_NEWS_FORM_SPAW","SpawEditor");
define("_MI_NEWS_FORM_HTMLAREA","HtmlAreaEditor");
define("_MI_NEWS_FORM_FCK","FCKEditor");
define("_MI_NEWS_FORM_KOIVI","KoiviEditor");
define("_MI_NEWS_FORM_OPTIONS_DESC","使用するフォームエディタを選択します。もしもシンプルなインストールだけしかしていないなら(e.g標準のxoopsコアパッケージで供給されているxoopsコアのクラスだけ使用している場合),「DHTML」と「コンパクト」だけが使用できます");
define("_MI_NEWS_KEYWORDS_HIGH","キーワードのハイライト機能を使用しますか?");
define("_MI_NEWS_KEYWORDS_HIGH_DESC","これを「はい」にすると,検索したときに記事内のキーワードがハイライト色表示されます。");
define("_MI_NEWS_HIGH_COLOR","キーワードハイライト色?");
define("_MI_NEWS_HIGH_COLOR_DES","上記のキーワードのハイライト機能を使用しているときだけこのオプションは使用します。");
define("_MI_NEWS_INFOTIPS","ツールチップス長");
define("_MI_NEWS_INFOTIPS_DES","このオプションを使うと,記事の最初の何文字かを含む関連するニュースのリンクが表示されます。もしも0を指定した場合はツールチップスは空になります。");
define("_MI_NEWS_SITE_NAVBAR","MozillaとOperaのサイトナビバーを使用する?");
define("_MI_NEWS_SITE_NAVBAR_DESC","これを「はい」にすると,訪問者は記事に関するサイトナビバーを使用することができます。");
define("_MI_NEWS_TABS_SKIN","タブで使用するスキンを選択");
define("_MI_NEWS_TABS_SKIN_DESC","このスキンは全てのブロックのタブで使用されるでしょう");
define("_MI_NEWS_SKIN_1","バーのスタイル");
define("_MI_NEWS_SKIN_2","浮き出し");
define("_MI_NEWS_SKIN_3","クラシック表示");
define("_MI_NEWS_SKIN_4","フォルダー");
define("_MI_NEWS_SKIN_5","MacOS");
define("_MI_NEWS_SKIN_6","プレーン");
define("_MI_NEWS_SKIN_7","角丸");
define("_MI_NEWS_SKIN_8","ZDnetスタイル");
