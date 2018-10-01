<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: zcwilt  Fri Apr 01 22:01:13 2016 -0500 Modified in v1.5.5 $
 */

require('includes/application_top.php');
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'users.php')) {
  include(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'users.php');
}
// セッションがタイムアウトしたかどうかを確認する
if (!isset($_SESSION['admin_id'])) zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
$user = $_SESSION['admin_id'];

// アクションが要求されているかどうかを判断する
if (isset($_POST['action']) && in_array($_POST['action'], array('update','reset'))) {
  $action = $_POST['action'];
} elseif (isset($_GET['action']) && in_array($_GET['action'], array('edit','password'))) {
  $action = $_GET['action'];
} else {
  $action = '';
}
// 期限切れではなくスプーフィングされていないとしてフォーム入力を検証する
if ($action != '' && isset($_POST['action']) && $_POST['action'] != '' && $_POST['securityToken'] != $_SESSION['securityToken']) {
  $messageStack->add_session(ERROR_TOKEN_EXPIRED_PLEASE_RESUBMIT, 'error');
  zen_redirect(zen_href_link(FILENAME_ADMIN_ACCOUNT));
}

// 指定された特定のアクションに基づく
switch ($action) {
  case 'edit': // 既存のユーザーを編集するための入力フォームを表示する
    $formAction = 'update';
    $profilesList = array_merge(array(array('id'=>0,'text'=>'Choose Profile')), zen_get_profiles());
    break;
  case 'password': // 既存のユーザーのパスワードをリセットするための未記載のフォームを表示する
    $formAction = 'reset';
    break;
  case 'update': // 既存のユーザーの詳細をデータベースに更新します。最初の関数呼び出しでは、postデータはdbに対してprepされます。
    $errors = zen_update_user(FALSE, $_POST['email'], $_SESSION['admin_id'], null);
    if (sizeof($errors) > 0)
    {
      foreach ($errors as $error)
      {
        $messageStack->add($error, 'error');
      }
      $action = 'edit';
      $formAction = 'update';
      $profilesList = array_merge(array(array('id'=>0,'text'=>'Choose Profile')), zen_get_profiles());
    } else
    {
      $action = '';
      $messageStack->add(SUCCESS_USER_DETAILS_UPDATED, 'success');
    }
    break;
  case 'reset': // 既存のユーザーのパスワードをデータベースにリセットします。最初の関数呼び出しでは、postデータはdbに対してprepされます。
    $errors = zen_reset_password($_SESSION['admin_id'], $_POST['password'], $_POST['confirm']);
    if (sizeof($errors) > 0)
    {
      foreach ($errors as $error)
    {
      $messageStack->add($error, 'error');
    }
    $action = 'password';
    $formAction = 'reset';
    } else
    {
      $action = '';
      $messageStack->add(SUCCESS_PASSWORD_UPDATED, 'success');
    }
    break;
  default: // アクションはありません。既存のユーザーをドロップして表示するだけです
}

// ユーザーの詳細を取得する
$userList = zen_get_users($_SESSION['admin_id']);
$userDetails = $userList[0];


?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="includes/admin_access.css" />
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<div id="pageWrapper">

  <h1><?php echo HEADING_TITLE ?></h1>

<form action="<?php echo zen_href_link(FILENAME_ADMIN_ACCOUNT) ?>" method="post">
<?php if (isset($formAction)) echo zen_draw_hidden_field('action',$formAction) . zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>
  <table cellspacing="0">
    <tr class="headingRow">
      <th class="name"><?php echo TEXT_NAME ?></th>
      <th class="email"><?php echo TEXT_EMAIL ?></th>
<?php if ($action == 'password') { ?>
      <th class="password"><?php echo TEXT_ADMIN_NEW_PASSWORD ?></th>
      <th class="password"><?php echo TEXT_ADMIN_CONFIRM_PASSWORD ?></th>
<?php } ?>
      <th class="actions">&nbsp;</th>
    </tr>
    <tr>
      <td class="name"><?php echo $userDetails['name'] ?><?php echo zen_draw_hidden_field('admin_name', $userDetails['name']); ?></td>
<?php if ($action == 'edit' && $user == $userDetails['id']) { ?>
      <td class="email"><?php echo zen_draw_input_field('email', $userDetails['email'], 'class="field"', false, 'email', true) ?></td>
<?php } else { ?>
      <td class="email"><?php echo $userDetails['email'] ?></td>
<?php } ?>
<?php if ($action == 'password' && $user == $userDetails['id']) { ?>
    <td class="password"><?php echo zen_draw_input_field('password', '', 'class="field"', false, 'password', true) ?></td>
    <td class="confirm"><?php echo zen_draw_input_field('confirm', '', 'class="field"', false, 'password', true) ?></td>
<?php } elseif($action == 'add' || $action == 'password') { ?>
      <td class="password">&nbsp;</td>
      <td class="confirm">&nbsp;</td>
<?php } ?>
<?php if ($action == 'edit' || $action == 'password') { ?>
<?php if ($user == $userDetails['id']) { ?>
      <td class="actions">
        <?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE) ?>
        <a href="<?php echo zen_href_link(FILENAME_ADMIN_ACCOUNT) ?>"><?php echo zen_image_button('button_cancel.gif', IMAGE_CANCEL) ?></a>
      </td>
<?php } else { ?>
      <td class="actions">&nbsp;</td>
<?php } ?>
<?php } else { ?>
      <td class="actions">
        <a href="<?php echo zen_href_link(FILENAME_ADMIN_ACCOUNT, 'action=edit') ?>"><?php echo zen_image_button('button_edit.gif', IMAGE_EDIT) ?></a>
        <a href="<?php echo zen_href_link(FILENAME_ADMIN_ACCOUNT, 'action=password') ?>"><?php echo zen_image_button('button_reset_pwd.gif', IMAGE_RESET_PWD) ?></a>
      </td>
    </tr>
<?php } ?>
  </table>
</form>

</div>
<!-- body_eof //-->

<div class="bottom">
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</div>
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
