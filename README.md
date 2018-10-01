Zen Cart&reg; - The Art of E-Commerce
===============

Zen Cart&reg; PA-DSS認定を取得した最初のオープンソースの電子商取引Webアプリケーションです。

Zen Cart&reg; v1.5.5はPA-DSS認定バージョンv1.5.4の上に適用されたいくつかのバグ修正パッチを含むアップデートです。

無料のソフトウェアで、Zen Cart＆reg;で24時間無料でコミュニティサポートを利用できます。 サポートサイトのフォーラム <https://www.zen-cart.com/forum.php>

--------------------


Zen Cart&reg; v1.5.5f
---------------------

互換性
-------------
Zen Cart v1.5.5 のデザインは:
 * PHP 5.6 to PHP 7.1  (5.2.10と互換性があります), PHP 7.2では完全に準備ができていません
 * Apache 2.2 and 2.4
 * MySQL 5.1 to 5.7 (MariaDB 10.0〜10.1を含む (10.2では部分的にしかテストされていない)


インストール
------------

インストールは簡単です:

1. [Download Zen Cart&reg;](http://sourceforge.net/projects/zencart/files)
2. Zipのmd5 / sha1ハッシュが公開されたものと一致することを確認してください。
  * Sourceforgeでホストされているzipファイルを検証するためのmd5 / sha1の値はこちら、[Zen Cart＆reg;ウェブサイト](https://www.zen-cart.com/) 
  * [ハッシュ値を使ってファイルを検証する方法の説明](https://www.zen-cart.com/content.php?305).
3. ダウンロードしたzipファイルを解凍する 
4. あなたが解凍したフォルダの中のすべてはあなたのwebserverにアップロードする必要があります。たとえば、あなたの `public_html`や` www`や `html`フォルダ（フォルダはあなたのWebサーバ上に既に存在します）
5. あなたのブラウザで、あなたのサイトへのアドレスを入力します： `www.example.com`（または` foldername`のような別のサブディレクトリにアップロードした場合は `www.example.com / foldername`を使います）
6. `/include/dist-configure.php`と` /admin/includes/dist-configure.php`ファイルの名前を `` configure.php` "に変更し、ファイルを書き込み可能にします（インストールプロセスはあなたの設定情報を次のステップでいくつかの質問に答えた後に）。
7. `/cache`と` /logs`フォルダも書き込み可能にしてください。 （インストール中に他のフォルダへの書き込みを許可するように指示されます）
8.インストールするブラウザに表示される指示に従います。

これらの簡単な指示で使用されている用語の一部が理解できないものである場合は、[/docs/Implementation-Guide](https://www.zen-cart.com/）に詳細な手順が記載されています。 docs / implementation-guide-v155.pdf）PDF。

アップグレード
---------
アップグレードに関する推奨ページ: https://www.zen-cart.com/entry.php?3


安全なインストールのためのガイダンス
---------------------------------
__[実装ガイド]（https://www.zen-cart.com/docs/implementation-guide-v155.pdf）のドキュメントは、PCIコンプライアンス要件に従ってサイトをインストールして保護する方法の詳細な説明を提供するために提供されています。あなたのサイトがPCIコンプライアンスを必要としているかどうかはあなたが決定する必要がありますが、文書化された原則に従い、望ましくない/許可されていない訪問者が試みた面倒なアクセスからサイトの回復力を最大限に引き出す必要があります。


ドキュメンテーション
-------------
ブラウザを使用して[/docs/index.html](http://www.zen-cart.com/docs/index.html）]ページを開き、ドキュメントと[導入ガイド]（https：//www.zen-cart.com/docs/ implementation-guide-v155.pdf）を参照。


開発者向けドキュメント
-----------------------
Zen Cart＆regに貢献したい開発者。コアコードがgithub上の[zencart / zencart]（https://github.com/zencart/zencart）リポジトリをフォークし、自身のフィーチャーブランチからプルリクエストを発行することがあります。 github、フォーク、ブランチング、および寄稿の使用に関する詳細なヘルプは、[Zen Cartコードへの寄稿]（http://docs.zen-cart.com/Contributing/）を参照してください。

開発者に関連する問題のガイダンスについては、[docs.zen-cart.com]（https://docs.zen-cart.com/Developer_Documentation/）を参照してください。このドキュメンテーションサイトは非常に新しいですが、コンテンツは時間の経過と共に追加されます。

開発者は、スタンドアロンの[Habitat VM]（http://docs.zen-cart.com/Habitat/main）が、サイトのアップグレードをステージングし、オフライン機能の開発やテストを行うための便利なツールであることがわかります。デザイナーは、ライブサイトに影響を与えずに新しいテンプレートをテストするのが好きかもしれません。


サポート
-------
無料サポートについては、サポートサイトをご覧ください: https://www.zen-cart.com/forum.php

フォローする
---------
Zen Cart＆regに関するニュースや最新情報については、 [Twitter](http://twitter.com/zencart)  [Facebook](http://facebook.com/zencart)

無料で登録する [Newsletter](http://eepurl.com/bafnNj)

[重要なニュースの更新とリリースのお知らせ]を購読する(https://www.zen-cart.com/subscription.php?do=addsubscription&f=2)


&nbsp;  

*&copy;Copyright 2003-2017, Zen Cart&reg;. All rights reserved.*

