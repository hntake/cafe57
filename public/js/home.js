/* ホーム画面でチャット削除ボタンを押すと、アラートを出す処理 */

/* ボタンクリック時にページ遷移 */
$(function(){
    $('.chat_delete_button').click(function(){ // 「.」でクラス指定
        if(!confirm('本当に削除しますか？')){
            return false; // キャンセルの場合は元に戻る
        }else{
            location.href = 'home.blade.php'; // OKの場合は削除
        }
    });
});