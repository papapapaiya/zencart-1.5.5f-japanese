<?php
/**
 * index.phpはZen Cart MVCシステムのハブを表します
 * 
 * フローの概要
 * <ul>
 * <li>Load application_top.php - see {@tutorial initsystem}</li>
 * <li>メイン言語ディレクトリをセット $_SESSION['language']</li>
 * <li>Load all *header_php.php は includes/modules/pages/PAGE_NAME/ から読み込みます</li>
 * <li>Load html_header.php (これは共通のテンプレートファイルです)</li>
 * <li>Load main_template_vars.php (これは共通のテンプレートファイルです)</li>
 * <li>Load on_load scripts (ページベースおよびサイト全体)</li>
 * <li>Load tpl_main_page.php (これは共通のテンプレートファイルです)</li>
 * <li>Load application_bottom.php</li>
 * </ul>
 *
 * @package general
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: index.php 2942 2006-02-02 04:41:23Z drbyte $
 */


/**
 * 共通ライブラリの読み込み 
 */
  require('includes/application_top.php');

  $language_page_directory = DIR_WS_LANGUAGES . $_SESSION['language'] . '/';
  $directory_array = $template->get_template_part($code_page_directory, '/^header_php/');
  foreach ($directory_array as $value) { 



/**
 * 指定されたページのヘッダーコードを読み込みます。
 * ページコードは includes/modules/pages/PAGE_NAME/directory 
 * そのディレクトリの 'header_php.php'ファイルがロードされます。
 */
    require($code_page_directory . '/' . $value);
  }


/**
 * これで、html_header.phpファイルが読み込まれます。このファイルには、HTMLの<head> </ head>コード内に表示されるコードが含まれています
 * テンプレートとページ単位でオーバーライドできます。
 * カスタムテンプレートでは、独自のcommon / html_header.phpファイルを定義できます 
 */
  require($template->get_template_dir('html_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/html_header.php');



/**
 * include / main_template_vars.phpから選択されたテンプレート変数を定義する
 * / pages / {page_name} /ディレクトリを上書きします。異なるページに異なる全体を持たせるテンプレート。
 */
  require($template->get_template_dir('main_template_vars.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/main_template_vars.php');




/**
 * 個々のページとサイト全体のテンプレート設定から、 "on_load"スクリプトを読む
 * 注意：on_load_*.jsファイルには、on_load = ""パラメータの<body>タグに挿入される未加工コードのみが含まれている必要があります。
 * "on_load_*.js"というファイルの "/includes/modules/pages"を見る。
 */
  $directory_array = $template->get_template_part(DIR_WS_MODULES . 'pages/' . $current_page_base, '/^on_load_/', '.js');
  foreach ($directory_array as $value) { 
    $onload_file = DIR_WS_MODULES . 'pages/' . $current_page_base . '/' . $value;
    $read_contents='';
    $lines = @file($onload_file);
    foreach($lines as $line) {
      $read_contents .= $line;
    }
  $za_onload_array[] = $read_contents;
  }




/**
 * "includes/templates/TEMPLATE/jscript/on_load/on_load_*.js"を読み込みます。これはサイト全体の設定
 */
  $directory_array=array();
  $tpl_dir=$template->get_template_dir('.js', DIR_WS_TEMPLATE, 'jscript/on_load', 'jscript/on_load_');
  $directory_array = $template->get_template_part($tpl_dir ,'/^on_load_/', '.js');
  foreach ($directory_array as $value) { 
    $onload_file = $tpl_dir . '/' . $value;
    $read_contents='';
    $lines = @file($onload_file);
    foreach($lines as $line) {
      $read_contents .= $line;
    }
    $za_onload_array[] = $read_contents;
  }

  // このvarの以前のバージョンの使用法との下位互換性のために$zc_first_fieldを設定してください
  if (isset($zc_first_field) && $zc_first_field !='') $za_onload_array[] = $zc_first_field;

  $zv_onload = "";
  if (isset($za_onload_array) && count($za_onload_array)>0) $zv_onload=implode(';',$za_onload_array);

  // ;; , ; を ; に置き換えます
  $zv_onload = str_replace(';;',';',$zv_onload.';');

  // 空白スペースを取り除きます。
  if (trim($zv_onload) == ';') $zv_onload='';




/**
 * 全体のページレイアウトを管理するテンプレートを定義し、ページ単位でページ上で行うことができます
 * または既定のテンプレートを使用します。インストールされているデフォルトのテンプレートは、標準の3列のレイアウトになります。この
 * templateは変数$body_codeに基づいてページ本文コードを読み込みます。
 */
  require($template->get_template_dir('tpl_main_page.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_main_page.php');
?>
</html>
<?php
/**
 * ページが閉じる前に一般的なコードをロードする
 */
?>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>