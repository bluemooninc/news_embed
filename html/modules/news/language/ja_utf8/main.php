<?php
// $Id: main.php,v 1.40 2005/03/13 12:59:36 hthouzard Exp $

//%%%%%%                File Name index.php             %%%%%
define("_MD_NEWSRELEASE","ニュースリリース");
define("_MD_ALLTOPIC","すべてのトピック");
define("_MD_NEWARRIVAL","最新ニュース・トピック別");
define("_MD_ARCHIVE","アーカイブ（発行年月別）");
define("_MD_SELECTTOPIC","トピックごとに表示する ");
define("_MD_SELECT","表示 ");
define("_MD_PRINTER","印刷用ページ");
define("_MD_SENDSTORY","このニュースを友達に送る");
define("_MD_READMORE","続き...");
define("_MD_COMMENTS","コメントする");
define("_MD_ONECOMMENT","1コメント");
define("_MD_BYTESMORE","残り%sバイト");
define("_MD_NUMCOMMENTS","%sコメント");
define("_MD_MORERELEASES","もっと記事...");
define('_MD_GOTOMODULEADMIN','モジュール管理画面');


//%%%%%%                File Name submit.php            %%%%%
define("_MD_SUBMITNEWS","ニュース投稿");
define("_MD_TITLE","表題");
define("_MD_TOPIC","トピック");
define("_MD_THESCOOP","メッセージ本文");
define("_MD_INTROTEXT","イントロ文章");
define("_MD_EXTEXT","本文");
define("_MD_PUBLISHED","掲載日時");
define("_MD_EXPIRED","掲載期限");
define("_MD_NOTIFYPUBLISH","ニュースが承認された旨をメールで受け取る");
define("_MD_POST","投稿する");
define("_MD_GO","送信");
define("_MD_THANKS","投稿を受付けました。当サイトスタッフによる承認を経た後に正式掲載となることをご了承ください。"); //submission of news article

define("_MD_NOTIFYSBJCT","NEWS for my site"); // Notification mail subject
define("_MD_NOTIFYMSG","新規ニュースの投稿がありました。"); // Notification mail message

//%%%%%%                File Name archive.php           %%%%%
define("_MD_NEWSARCHIVES","ニュースアーカイブ");
define("_MD_YEARC","年");
define("_MD_NEWS_OF","のニュース");
define("_MD_NEWSLIST_OF","のニュース");
define("_MD_ARTICLES","ニュース");
define("_MD_VIEWS","ヒット");
define("_MD_DATE","掲載日");
define("_MD_ACTIONS","");
define("_MD_PRINTERFRIENDLY","印刷用ページ");

define("_MD_THEREAREINTOTAL","計 %s件のニュース記事があります");

// %s is your site name
define("_MD_INTARTICLE","%sで見つけた興味深いニュース");
define("_MD_INTARTFOUND","以下は%sで見つけた非常に興味深いニュース記事です：");

define("_MD_TOPICC","トピック：");
define("_MD_URL","URL：");
define("_MD_NOSTORY","選択されたニュース記事は存在しません");

//%%%%%%        File Name print.php     %%%%%

define("_MD_URLFORSTORY","このニュース記事が掲載されているURL：");

// %s represents your site name
define("_MD_THISCOMESFROM","%sにて更に多くのニュース記事をよむことができます");

// Added by Herv・
define("_MD_ATTACHEDFILES","添付ファイル:");
define("_MD_ATTACHEDLIB","添付ファイル有り");
define("_MD_NEWSSAMEAUTHORLINK","この投稿者の記事");
define("_MD_NEWS_NO_TOPICS","申し訳ありません。トピックが一つもまだありません。記事を投稿する前にトピックを作成してください。");
define("_MD_PREVIOUS_ARTICLE","前へ");
define("_MD_NEXT_ARTICLE","次へ");
define("_MD_OTHER_ARTICLES","他の記事");

// Added by Herv・in version 1.3 for rating
define("_MD_RATETHISNEWS","投票する");
define("_MD_RATEIT","評価する!");
define("_MD_TOTALRATE","総評価");
define("_MD_RATINGLTOH","評価 (最低評価から最高評価)");
define("_MD_RATINGHTOL","評価 (最高評価から最低評価)");
define("_MD_RATINGC","評価: ");
define("_MD_RATINGSCALE","1 - 10の間で指定してください、最低評価は 1 、最高評価なら 10　とします");
define("_MD_BEOBJECTIVE","客観的な評価でお願いします。もしもすべて 1 または 10だけなら, 評価としては余り役に立ちません。");
define("_MD_DONOTVOTE","あなたご自身が投稿したの記事は評価できません。");
define("_MD_RATING","評価");
define("_MD_VOTE","投票");
define("_MD_NORATING","評価点が選択されていません。");
define("_MD_USERAVG","平均評価");
define("_MD_DLRATINGS","全記事評価 (総投票数: %s)");
define("_MD_ONEVOTE","1 投票");
define("_MD_NUMVOTES","%u 投票");// Warning
define("_MD_CANTVOTEOWN","あなたはこの記事に投票することはできません.<br />すべての投票は記録されて評価されます。");
define("_MD_VOTEDELETED","投票データを削除しました。");
define("_MD_VOTEONCE","同じ記事への投票は１回だけしかできません。");
define("_MD_VOTEAPPRE","あなたの投票は受理されました。");
define("_MD_THANKYOU","お忙しいところ、ここ「 %s 」の記事に投票して頂きまして、ありがとうございます。"); // %s is your site name
define("_MD_RSSFEED","RSS送信");// Warning, this text is included insided an Alt attribut (for a picture), so take care to the quotes
define("_MD_AUTHOR","投稿者: ");
define("_MD_META_DESCRIPTION","ページdescriptionメタタグに挿入する文字");
define("_MD_META_KEYWORDS","ページkeywordsメタタグに挿入する文字");
define("_MD_MAKEPDF","記事をPDFにする");
define('_MD_POSTEDON',"投稿日: ");
define('_MD_PUBLISHEDON',"掲載日: ");
define("_MD_AUTHOR_ID","投稿者のID");
define("_MD_POST_SORRY","すみません、トピックが無いか、投稿許可されたトピックが無いかのどちらかです。あなたがこのウェブマスターのであるなら、「アクセス権」の設定で'投稿可'を設定しに行ってください。");

// Action Form
define("_MD_NEWS_ERROR_REQUIRED","入力必須項目");
define("_MD_NEWS_ATTACHFILE","添付ファイル");
define("_MD_NEWS_STORY_ID","記事ID");
define("_MD_NEWS_ATTACHE_ID","添付ID");
define("_MD_NEWS_TITLE","記事タイトル");
define("_MD_NEWS_ERROR_MAXLENGTH","最大文字長");
define("_MD_NEWS_EDIT_STORY","編集");
define("_MD_NEWS_SAVE_STORY","保存");
define("_MD_NEWS_VIEW_STORY","閲覧");
