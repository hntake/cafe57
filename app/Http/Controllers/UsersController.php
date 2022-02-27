<?php // このファイルに、新規登録画面、ログイン画面、ホーム画面(チャット機能含む)、チャット編集画面のControllerを記述。

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // User.phpを使用
use Illuminate\Support\Facades\Hash; // パスワードを乱数にする設定
use Illuminate\Support\Facades\DB; // DBクラスを使用
use App\Chat; // Chatクラス(chat.php)を使用
use Illuminate\Support\Facades\Auth; // Authクラスを使用

class UsersController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';// Admin(管理者)でログインした後のリダイレクト先をホーム画面に設定

    /**
     * 新規登録画面の表示
     *
     */
    public function signup_form()
    {
        return view('users.signup');
    }

    public function signup(Request $request) // 新規登録の処理(post)
    {
        // バリデーション = 「入力チェック」
        $request->validate([
            'name' => 'required',
            'user_name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255', 'alpha_num'],
        ]);

        // DBインサート(usersテーブルに行を追加)
        $user = new User();
        $user->fill([ // fillを使い、モデルの全カラムを更新。
            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // 新規登録時にパスワードをハッシュ化。
            'user_type' => $request->user_type,
        ])->save(); // $userに格納されている情報を保存。

        //「登録する」ボタンを押すとログイン画面に遷移
        return view('users.login');
    }

    /**
     * ログイン画面の表示
     *
     */
    public function login_form()
    {
        return view('users.login');
    }

    public function login(Request $request) // ログインの処理(post)
    {
        // バリデーション = 「入力チェック」
        $request->validate([
            'user_name' => 'required',
            'password' => ['required', 'min:8', 'max:255', 'alpha_num']
        ]);

        // ログイン認証
        if(Auth::attempt(['user_name' => $request->input('user_name'), 'password' => $request->input('password')]))
            {
            return redirect()->route('home_screen'); // ログインに成功するとホーム画面にリダイレクト
            }
            return redirect()->back(); // ログインに失敗するとログイン画面に戻る
    }

    public function logout(Request $request) // ログアウトの処理(post)
    {
        Auth::logout(); // ログアウト
        return redirect()->route('home_screen'); // 「ログアウト」ボタンを押すと、ログイン画面にリダイレクト
    }
}
