<p>発注依頼</p>
<p>送信先：{{ $data['company_name'] }}様</p>

<p>平素は大変お世話になっております。<br>
以下、ご手配のほど、宜しくお願い致します。</p>
<p>注文表番号:{!! nl2br( $data['order_id'] ) !!}</p>
<p>希望納期:{!! nl2br( $data['due_date'] ) !!}</p>
<p>納品先{!! nl2br( $data['ship_to'] ) !!}</p>
<p>担当名:{!! nl2br( $data['attend'] ) !!}</p>
