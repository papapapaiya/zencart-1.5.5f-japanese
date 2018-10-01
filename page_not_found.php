<?php
/**
 * ページが見つからないエラーのハンドラ
 * 
 * 301 Moved permanent errorsを生成し、index.phpにリダイレクトしますか？main_page = page_not_found
 * 特にGoogleのインデックス作成に便利です
 *
 * @package general
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: page_not_found.php 2742 2005-12-30 21:12:44Z wilt $
 */
/*
* スパイダーに「移動した」メッセージを送信した後、page_not_foundページにリダイレクトする
*/
header("HTTP/1.1 301 ページが移動されたか削除されました");
header("ロケーション: index.php?main_page=page_not_found");
?>