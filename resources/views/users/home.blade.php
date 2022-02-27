<!-- ホーム画面のView -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"> <!-- home.cssと連携 -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script> <!-- jQueryのライブラリを読み込み -->
    <script src="{{ asset('/js/home.js') }}"></script> <!-- home.jsと連携 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面</title>
</head>
<body>
    <section>
        <div class="side"> <!-- サイドバー -->
            <p><h1>cafe57</h1></p>
            <nav class="sidebar">   
                <p><a href="{{ url('products') }}"><h3>在庫一覧画面</h3></a></p>
                <p><a href="{{ url('order_table') }}"><h3>注文表画面</h3></a></p>
                <!-- <p><a href="{{ url('') }}"><h3>シフト申請画面</h3></a></p>
                <p><a href="{{ url('') }}">・シフト管理画面</a></p>
                <p><a href="{{ url('') }}">・勤怠一覧画面</a></p> -->
                <p><a href="{{ route('home_screen') }}">ホーム画面に戻る</a></p>
            </nav>
            <div class="logout_buttom">
                <form action="{{ route('logout') }}" method="post">
                    @csrf <!-- CSRF保護 -->
                    <input type="submit" value="ログアウト"> <!-- ログアウトしてログイン画面に戻る -->
                </form>
            </div>
        </div>
        <div class="home"> <!-- チャット画面 -->
            <form action="{{ route('chat') }}" method="post" autocomplete="off">
                @csrf <!-- CSRF保護 -->
                <div class="outer-title-form">
                    <p><h3>件名</h3></p>
                    <input type="text" name="title" placeholder="件名を入力してください" autocomplete="off" style="height:30px;">
                </div>
                <div class="outer-message-form">
                    <p><h3>メッセージ</h3></P>
                    <textarea name="message" placeholder="ここにメッセージを入力してください" autocomplete="off" rows="30" cols="20"></textarea><br> <!-- rows =「高さ」, cols =「幅」-->
                    <input type="submit" value="投稿" style=background:#99CC00;>
                </div>
            </form>
            <div class="chatarea">
                <table class="st-tbl1">
                    <thead>
                        <tr>
                            <th style="width:10%">名前</th>
                            <th style="width:20%">件名</th>
                            <th style="width:40%">メッセージ</th>
                            <th style="width:20%">投稿日時</th>
                            <th style="width:10%"></th>
                        </tr>
                    </thead>
                    @foreach ($chats as $chat) <!-- chatテーブルのデータを全て表示させる処理 -->
                    <tbody>
                        <tr>
                            <td style="width:10%">{{ $chat->user->name }}</td> <!-- $chatに、user関数を使い、その中のnameを参照 -->
                            <td style="width:20%">{{ $chat->title }}</td>
                            <td style="width:40%">{{ $chat->message }}</td>
                            <td style="width:20%">{{ $chat->created_at }}</td>
                            <!-- <td style="width:20%">{{ $chat->updated_at }}</td> -->
                            <td style="width:10%"><a href="chat_delete/{{ $chat->id }}" class="chat_delete_button">削除</a></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
</body>
</html>