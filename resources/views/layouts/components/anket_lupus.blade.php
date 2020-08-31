<br>
<h2 class="text-center form-group">日本語版LupusPRO</h2>
<div class="mb-4 text-justify">このアンケートは、SLE または SLEの治療が、あなたの健康、生活の質（QOL）、SLEに関して受けている医療サービスに及ぼす影響について、あなたの見解をたずねるものです。それぞれの質問に対して、<u>一番当てはまるところにチェックマーク　◉　をつけて回答して下さい。</u>もし、質問にどのように答えればよいか迷う場合は、最も近いものを選んで回答して下さい。回答には正解も不正解もありません。1つの質問に対し、１つだけ選んで回答して下さい。”あてはまらない”の箇所がある質問については、これを選択することもできます。</div>
@php
    $headers = ['全くない', 'たまにある', '時々ある', '度々ある', '常にある', 'あてはまらない'];
    $titles = [
        'qaA' => 'A.　過去4週間、あなたは<u>どのくらいの頻度で</u>、<u>SLEが理由で</u>、下記のことを経験しましたか？',
        'qaB' => 'B.　過去4週間、あなたは<u>SLEによる身体への影響が理由で</u>、下記の日々の活動について、<u>どのくらいの頻度で</u>制限されましたか？',
        'qaC' => 'C.　過去4週間、あなたは<u>どのくらいの頻度で</u>、<u>SLEの影響で</u>、下記を感じましたか？',
        'qaD' => 'D.　過去4週間、あなたは<u>どのくらいの頻度で</u>、<u>SLEが原因で</u>、下記を感じましたか？',
        'qaE' => 'E.　過去4週間、あなたは<u>どのくらいの頻度で</u>、<u>SLEが原因で</u>、下記のことを感じましたか？',
        'qaF' => 'F.　過去4週間、あなたは<u>どのくらいの頻度で</u>、<u>SLEが</u>下記に影響しましたか？',
        'qaG' => 'G.　過去4週間、あなたは<u>どのくらいの頻度で</u>、<u>SLEに関して</u>、下記のことを体験しましたか？',
        'qaH' => 'H.　<u><b>過去3か月</b></u>、あなたが受けた<u>SLEの</u>医療に関して、<u>どのくらいの頻度で</u>、下記を感じましたか？',
    ]
@endphp
<!-- qaA -->
<div class="form-group d-block d-md-none">{!! $titles['qaA'] !!}</div>
@component('layouts.components.data_table', [
    'name' => 'lpusqaA',
    'begin' => 0,
    'title' => $titles['qaA'],
    'headers' => $headers,
    'rows' => [
        '脱毛',
        '新たな皮疹または皮疹の再発',
        '病状の悪化',
        '記憶力の低下',
        '集中力の欠如',
        'SLEの薬による好ましくない副作用',
        'SLEの治療のための薬の数への心配',
        'SLEの薬が妊娠能力に影響するかが心配',
        '予期せぬ妊娠を避けられるかが心配',
    ]
])
@endcomponent

<!-- qaB -->
<div class="form-group d-block d-md-none">{!! $titles['qaB'] !!}</div>
@component('layouts.components.data_table', [
    'name' => 'lpusqaB',
    'begin' => 9,
    'title' => $titles['qaB'],
    'headers' => $headers,
    'rows' => [
        '自分自身の身の回りのことをすること（着替え、髪をとく、トイレ、食事、入浴）',
        'ベッド（布団）への出入り または 椅子へ座るときや立つこと',
        '家族としての責任を果たすこと',
        '自分を直接頼っている家族やペットの世話をすること',
        '自分の身体的な能力のために家族 または 友人に負担をかけること',
    ]
])
@endcomponent

<!-- qaC -->
<div class="form-group d-block d-md-none">{!! $titles['qaC'] !!}</div>
@component('layouts.components.data_table', [
    'name' => 'lpusqaC',
    'begin' => 14,
    'title' => $titles['qaC'],
    'headers' => $headers,
    'rows' => [
        '私は朝起きた時に疲れを感じた',
        '私は身体に痛みやうずきを感じた',
        '私は身体の痛みのために、普段の活動が出来なかった',
        '私は痛み または 疲労感のために、長い時間、普段の活動が出来なかった（例えば家庭や職場で）',
        '私は痛み または 疲労感のために、今まで出来ていた仕事や活動の範囲が制限された',
    ]
])
@endcomponent

<!-- qaD -->
<div class="form-group d-block d-md-none">{!! $titles['qaD'] !!}</div>
@component('layouts.components.data_table', [
    'name' => 'lpusqaD',
    'begin' => 19,
    'title' => $titles['qaD'],
    'headers' => $headers,
    'rows' => [
        'SLEが自分の将来に与える影響について心配になった',
        '収入を失うことが心配になった',
        '不安',
        'うつ',
        'SLE（またはSLEの治療）がさらなる健康問題を引き起こすことが心配になった',
        'SLEが引き起こす健康問題がずっと続くのではないかと心配になった',
    ]
])
@endcomponent

<!-- qaE -->
<div class="form-group d-block d-md-none">{!! $titles['qaE'] !!}</div>
@component('layouts.components.data_table', [
    'name' => 'lpusqaE',
    'begin' => 25,
    'title' => $titles['qaE'],
    'headers' => $headers,
    'rows' => [
        '私は自分の外見が嫌いだった',
        '私は自分自身を低く評価した',
        '私は自分の外見をどうすることもできなかった',
        '私は自分の外見について人目を気にした',
        '私は他人が自分をどのように見ているのかを思うと困惑した',
    ]
])
@endcomponent

<!-- qaF -->
<div class="form-group d-block d-md-none">{!! $titles['qaF'] !!}</div>
@component('layouts.components.data_table', [
    'name' => 'lpusqaF',
    'begin' => 30,
    'title' => $titles['qaF'],
    'headers' => $headers,
    'rows' => [
        '活動やイベントのスケジュールを立てること',
        '人生の全体的な満足感',
        '人生の喜び',
        'キャリア目標の遂行',
    ]
])
@endcomponent

<!-- qaG -->
<div class="form-group d-block d-md-none">{!! $titles['qaG'] !!}</div>
@component('layouts.components.data_table', [
    'name' => 'lpusqaG',
    'begin' => 34,
    'title' => $titles['qaG'],
    'headers' => $headers,
    'rows' => [
        '私は友人から支援を受けた',
        '私は家族から支援を受けた',
        '私は自分の状況を良くすることに集中した',
        '私はSLEと共に生きることを学んだ',
        '私は宗教・信仰から、安心感や強さを得た',
    ]
])
@endcomponent

<!-- qaH -->
<div class="form-group d-block d-md-none">{!! $titles['qaH'] !!}</div>
@component('layouts.components.data_table', [
    'name' => 'lpusqaH',
    'begin' => 39,
    'title' => $titles['qaH'],
    'headers' => $headers,
    'rows' => [
        'SLEに関して聞きたいことがある時に、主治医に連絡が取りやすかった',
        'SLEが私の生活に及ぼす影響を主治医は理解していた',
        'SLEについて私が理解するべき情報を主治医は提供してくれた',
        'SLEの薬の副作用について医師たちは話し合いや検討をしてくれた',
    ]
])
@endcomponent