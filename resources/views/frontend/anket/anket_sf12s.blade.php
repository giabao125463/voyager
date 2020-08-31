@extends('layouts.front')

@section('page_title') {{ data_get($anketDescription, 'title.' . $anketId)}} @endsection

@section('head')
@endsection

@section('content')
<section class="d-none d-md-block form-group">
    <div class="form-group"></div>
    <h2 class="text-center">SF-12v2 日本語版</h2>
    <h2 class="text-center">質問紙の取扱についての注意事項</h2>
    <div class="text-right m-10">
        <a href="" data-toggle="modal" data-target="#p-header">アンケートについて</a>
    </div>
</section>
<section class="d-block d-md-none form-group">
    <div class="form-group"></div>
    <h5 class="text-center">SF-12v2 日本語版</h5>
    <h5 class="text-center">質問紙の取扱についての注意事項</h5>
    <div class="text-right m-10">
        <a href="{{ route('anket.page_header', ['anketId' => $anketId]) }}">アンケートについて</a>
    </div>
</section>
<div class="text-center border-top border-bottom d-none d-md-block form-group">
    <h1 class="font-weight-bold pt-4 pb-4">あなたの健康について</h1>
</div>
<div class="text-center border-top border-bottom d-block d-md-none form-group">
    <h4 class="font-weight-bold pt-4 pb-4">あなたの健康について</h4>
</div>
<div class="form-group text-justify">
    <p>このアンケートはあなたがご自分の健康をどのように考えているかをおうかがいするものです。あなたが毎日をどのように感じ、日常の活動をどのくらい自由にできるかを知るうえで参考になります。お手数をおかけしますが、何卒ご協力のほど宜しくお願い申し上げます。</p>
    <p>以下のそれぞれの質問について、一番よくあてはまるものに印（✔︎）をつけてください。</p>
</div>
<div class="form-group">
    <form action="/anket/submit" method="POST" id="anketForm">
        @csrf
        <!-- QA1 -->
        <div class="form-group">
            <div><b>問１．</b>あなたの健康状態は？（一番よくあてはまるものに（✔︎）印をつけて下さい）</div>
            @component('layouts.components.radio_group_3', [
                'name' => 'qa1',
                'items' => [
                    '最高に良い' => '最高に良い',
                    'とても良い' => 'とても良い',
                    '良い' => '良い',
                    'あまり良くない' => 'あまり良くない',
                    '良くない' => '良くない'
                ]
            ])
            @endcomponent
        </div>
        <!-- QA2 -->
        <div class="form-group">
            <div><b>問２．</b>以下の質問は、日常よく行われている活動です。あなたは<u>健康上の理由で</u>、こうした活動をすることがむずかしいと感じますか。むずかしいとすればどのくらいですか。(次の質問について､一番よくあてはまるものに（✔︎）印をつけて下さい)</div>
        </div>
        @component('layouts.components.data_table_index', [
                'name' => 'qa2',
                'title' => '',
                'headers' => [
                    'とてもむずかしい',
                    '少しむずかしい',
                    'ぜんぜんむずかしくない',
                ],
                'rows' => [
                    [
                        'no' => 'ア）',
                        'html' => '<u>適度の活動</u>、例えば、家や庭のそうじをする、１～２時間散歩するなど',
                        'text' => '適度の活動、例えば、家や庭のそうじをする、１～２時間散歩するなど',
                    ],
                    [
                        'no' => 'イ）',
                        'html' => '階段を<u>数階上</u>までのぼる',
                        'text' => '階段を数階上までのぼる',
                    ]
                ]
            ])
        @endcomponent
        <!-- QA3 -->
        <div class="form-group">
            <div><b>問３．</b><u>過去１ヵ月間に</u>、仕事やふだんの活動（家事など）をするにあたって、<u>身体的な理由で</u>次のような問題がありましたか。（次の質問について、一番よくあてはまるものに（✔︎）印をつけて下さい）</div>
        </div>
        @component('layouts.components.data_table_index', [
                'name' => 'qa3',
                'title' => '',
                'headers' => [
                    'いつも',
                    'ほとんどいつも',
                    'ときどき',
                    'まれに',
                    'ぜんぜんない',
                ],
                'rows' => [
                    [
                        'no' => 'ア）',
                        'html' => '仕事やふだんの活動が思ったほど、<u>できなかった</u>',
                        'text' => '仕事やふだんの活動が思ったほど、できなかった',
                    ],
                    [
                        'no' => 'イ）',
                        'html' => '仕事やふだんの活動の<u>内容</u>によっては、できないものがあった',
                        'text' => '仕事やふだんの活動の内容によっては、できないものがあった',
                    ]
                ]
            ])
        @endcomponent
        <!-- QA4 -->
        <div class="form-group">
            <div><b>問４．</b><u>過去１ヵ月間に</u>、仕事やふだんの活動（家事など）をするにあたって、<u>心理的な理由で</u>（例えば、気分がおちこんだり不安を感じたりしたために)、次のような問題がありましたか。（次の質問について、一番よくあてはまるものに（✔︎）印をつけて下さい）</div>
        </div>
        @component('layouts.components.data_table_index', [
                'name' => 'qa4',
                'title' => '',
                'headers' => [
                    'いつも',
                    'ほとんどいつも',
                    'ときどき',
                    'まれに',
                    'ぜんぜんない',
                ],
                'rows' => [
                    [
                        'no' => 'ア）',
                        'html' => '仕事やふだんの活動が思ったほど、<u>できなかった</u>',
                        'text' => '仕事やふだんの活動が思ったほど、できなかった',
                    ],
                    [
                        'no' => 'イ）',
                        'html' => '仕事やふだんの活動がいつもほど、<u>集中して</u>できなかった',
                        'text' => '仕事やふだんの活動がいつもほど、集中してできなかった',
                    ]
                ]
            ])
        @endcomponent
        <!-- QA5 -->
        <div class="form-group">
            <div><b>問５．</b><u>過去１ヵ月間に</u>、いつもの仕事（家事も含みます）が<u>痛みのために</u>、どのくらい妨げられましたか。（一番よくあてはまるものに（✔︎）印をつけて下さい）</div>
            @component('layouts.components.radio_group_3', [
                'name' => 'qa5',
                'items' => [
                    'ぜんぜん、妨げられなかった' => 'ぜんぜん、妨げられなかった',
                    'わずかに、妨げられた' => 'わずかに、妨げられた',
                    '少し、妨げられた' => '少し、妨げられた',
                    'かなり、妨げられた' => 'かなり、妨げられた',
                    '非常に、妨げられた' => '非常に、妨げられた'
                ]
            ])
            @endcomponent
        </div>
        <!-- QA6 -->
        <div class="form-group">
            <div><b>問６．</b>次にあげるのは、<u>過去１ヵ月間に</u>、あなたがどのように感じたかについての質問です。(次の質問について、一番よくあてはまるものに（✔︎）印をつけて下さい)</div>
        </div>
        @component('layouts.components.data_table_index', [
                'name' => 'qa6',
                'title' => '',
                'headers' => [
                    'いつも',
                    'ほとんどいつも',
                    'ときどき',
                    'まれに',
                    'ぜんぜんない',
                ],
                'rows' => [
                    [
                        'no' => 'ア）',
                        'html' => 'おちついていて、おだやかな気分でしたか',
                        'text' => 'おちついていて、おだやかな気分でしたか',
                    ],
                    [
                        'no' => 'イ）',
                        'html' => '活力(エネルギー)にあふれていましたか',
                        'text' => '活力(エネルギー)にあふれていましたか',
                    ],
                    [
                        'no' => 'ウ）',
                        'html' => 'おちこんで､ゆううつな気分でしたか',
                        'text' => 'おちこんで､ゆううつな気分でしたか',
                    ]
                ]
            ])
        @endcomponent
        <!-- QA7 -->
        <div class="form-group">
            <div><b>問７．</b><u>過去１ヵ月間に</u>、友人や親せきを訪ねるなど、人とのつきあいが、<u>身体的あるいは心理的な理由で</u>、時間的にどのくらい 妨げられましたか。（一番よくあてはまるものに（✔︎）印をつけて下さい）</div>
            @component('layouts.components.radio_group_3', [
                'name' => 'qa7',
                'items' => [
                    'いつも' => 'いつも',
                    'ほとんどいつも' => 'ほとんどいつも',
                    'ときどき' => 'ときどき',
                    'まれに' => 'まれに',
                    'ぜんぜんない' => 'ぜんぜんない'
                ]
            ])
            @endcomponent
        </div>
        @component('layouts.components.footer', ['editMode' => $editMode, 'historyId' => $historyId])
            <label>これでこのアンケートはおわりです。<br>ご協力ありがとうございました。</label>
        @endcomponent
    </form>
</div>

<!-- Modal -->
<div id="p-header" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-justify form-group">
                    <ul class="p-header">
                        @foreach (data_get($anketDescription, 'about.anket_sf12s') as $item)
                        <li>{!! $item !!}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-4 text-center form-group">
                    @foreach (data_get($anketDescription, 'about.anket_sf12s_footer') as $item)
                        {!! $item !!}
                    @endforeach
                </div>
                <div class="text-right form-group">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">アンケートに戻る</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@include('frontend.anket.anket_sf12s_script')
@component('layouts.components.common')@endcomponent