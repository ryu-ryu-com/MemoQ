<p align="center"><a href="" target="_blank"><img src="public\images\memoq_icon.png" width="400"></a></p>

## 本システムの概要
### 「MemoQ(メモック)」はクイズとメモを結び付けた、活きた知識を身につけるためのシステムです。
* メモ機能
  * 一覧機能
    * メモのCRUDを行うための機能
    * 詳細に1対多でクイズを登録できる
    * URLの登録が可能で参照wikiやweb上の文献などを登録できる
  * 公開機能
    * 他のユーザーにメモを公開するための機能
    * 公開されたメモを選んで自分のメモ一覧に保存可能
* クイズ機能
  * 一覧機能
    * クイズのCRUDを行うための機能
    * 親の知識メモに結びついて登録できる
  * 出題機能
    * クイズに登録されているジャンルタグ毎に分けられ、ランダムで出題される
    * 問題→回答が繰り返され、回答画面から知識メモを新規タブで開ける

## ユーザー
ユーザー１  
ID test@test.com  
PASS password  
ユーザー２  
ID test2@test.com  
PASS password  

ユーザー３(guest用。メモやクイズ追加などご自由にどうぞ)  
ID test3@test.com  
PASS guest  

※DockerFile作成中のため、XAMPP等でアクセスしてください

## git clone後の手順
1. .env.exampleをコピーして.envファイルを作成
2. MemoQというDBを作成
3. `composer install`
4. `php artisan key:generate`
5. `php artisan migrate:fresh --seed`