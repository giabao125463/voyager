<!-- END -->
<div class="form-group">
    <div class="card">
        <div class="card-body text-center">
            {{ $slot }}
        </div>
    </div>
</div>
<!-- Submit button -->
<div class="form-group text-center">
    @if(isset($editMode))
        @if($editMode)
            <a href="/admin/anket-results" class="btn btn-secondary">戻る</a>
        @else
            <a href="{{route('anket_result.history', ['id' => $historyId])}}" class="btn btn-secondary">閉じる</a>
        @endif
    @endif
    <input type="submit" class="btn btn-primary" value="完了">
</div>
<div class="footerSubmit d-none">
    <input type="submit" class="btn btn-primary" value="完了">
</div>
<section class="footerInfo">
    <div>【お問い合わせ先】</div>
    <div> <b>昭和大学病院医学部内科学講座リウマチ膠原病内科学部門</b></div>
    <div> 矢嶋宣幸</div>
    <div> 〒１４２-８６６６ 東京都品川区１—５—８</div>
    <div> TEL：０３—３７８４—８９４２</div>
    <div> FAX：０３—３７８４—８９４６</div>
    <p> Email：n.yajima@med.showa-u.ac.jp</p>
    <section class="d-none d-md-block">
        <div>【調査組織】</div>
        <div class="row">
            <div class="col-2">研究代表者：</div>
            <div class="col-8">昭和大学病院医学部内科学講座リウマチ膠原病内科学部門</div>
            <div class="col-2">
                <span>矢嶋</span>
                <span class="pl-3">宣幸</span>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p>研究責任者：</p>
            </div>
            <div class="col-8">
                <div> 岡山大学院医歯薬学総合研究科腎免疫内分泌代謝内科学 </div>
                <div> 長崎大学病院第一内科 </div>
                <div> 横浜市立大学医学部血液・免疫・感染症内科 </div>
                <p> 横浜市立大学附属市民総合医療センター　リウマチ膠原病センター </p>
                <div> 昭和大学江東豊洲病院内科 </div>
                <div> 埼玉医科大学リウマチ膠原病科 </div>
                <div> 信州大学医学部医学科内科学第３教室 </div>
                <div> 福島県立医科大学医学部リウマチ膠原病内科学部門 </div>
                <div> 横浜労災病院　リウマチ科・膠原病内科 </div>
                <div> 東京共済病院リウマチ膠原病内科 </div>
                <div> 神戸大学医学部付属病院膠原病リウマチ内科 </div>
                <div> 京都府立医科大学大学院医学研究科免疫内科学 </div>
            </div>
            <div class="col-2">
                <div>
                    <span>佐田</span>
                    <span class="pl-3">憲映</span>
                </div>
                <div>
                    <span>一瀬</span>
                    <span class="pl-3">邦弘</span>
                </div>
                <div>
                    <span>吉見</span>
                    <span class="pl-3">竜介</span>
                </div>
                <div>
                    <span>大野</span>
                    <span class="pl-3">滋</span>
                </div>
                <br>
                <div>
                    <span>笠間</span>
                    <span class="pl-3">毅</span>
                </div>
                <div>
                    <span>梶山</span>
                    <span class="pl-3">浩</span>
                </div>
                <div>
                    <span>下島</span>
                    <span class="pl-3">恭弘</span>
                </div>
                <div>
                    <span>佐藤</span>
                    <span class="pl-3">秀三</span>
                </div>
                <div>
                    <span>藤原</span>
                    <span class="pl-3">道雄</span>
                </div>
                <div>
                    <span>松尾</span>
                    <span class="pl-3">祐介</span>
                </div>
                <div>
                    <span>大西</span>
                    <span class="pl-3">輝</span>
                </div>
                <div>
                    <span>木田</span>
                    <span class="pl-3">節</span>
                </div>
            </div>
        </div>
    </section>
    <section class="d-block d-md-none">
        <div>【調査組織】</div>
        <div>研究代表者：</div>
        <div class="col">昭和大学病院医学部内科学講座リウマチ膠原病内科学部門（<b>矢嶋　宣幸</b>）</div>
        <div>研究責任者：</div>
        <div class="col">岡山大学院医歯薬学総合研究科腎免疫内分泌代謝内科学（<b>佐田　憲映</b>）</div>
        <div class="col">長崎大学病院第一内科（<b>一瀬　邦弘</b>）</div>
        <div class="col">横浜市立大学医学部血液・免疫・感染症内科（<b>吉見　竜介</b>）</div>
        <div class="col">横浜市立大学附属市民総合医療センター　リウマチ膠原病センター（<b>大野　滋</b>）</div>
        <div class="col">昭和大学江東豊洲病院内科（<b>笠間　毅</b>）</div>
        <div class="col">埼玉医科大学リウマチ膠原病科（<b>梶山　浩</b>）</div>
        <div class="col">信州大学医学部医学科内科学第３教室（<b>下島　恭弘</b>）</div>
        <div class="col">福島県立医科大学医学部リウマチ膠原病内科学部門（<b>佐藤　秀三</b>）</div>
        <div class="col">横浜労災病院　リウマチ科・膠原病内科（<b>藤原　道雄</b>）</div>
        <div class="col">東京共済病院リウマチ膠原病内科（<b>松尾　祐介</b>）</div>
        <div class="col">神戸大学医学部付属病院膠原病リウマチ内科（<b>大西　輝</b>）</div>
        <p class="col">京都府立医科大学大学院医学研究科免疫内科学（<b>木田　節</b>）</p>
    </section>
    </br>
</section>
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">アンケートを完了してよろしいですか。</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                <button type="button" class="btn btn-primary" onclick="submit()">完了</button>
            </div>
        </div>
    </div>
</div>