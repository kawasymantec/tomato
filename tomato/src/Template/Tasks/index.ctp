<?= $this->Html->css('bootstrap.min') ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<?= $this->Html->script('bootstrap.min') ?>
<?= $this->Html->script('jquery.easypiechart.min') ?>
<?= $this->Html->script('jquery.cookie') ?>
<?= $this->Html->css('tomato') ?>

<div class="container">
    <div class="row">
        <div class="top_area col-md-12">
            <span class="header">タスクの新規登録</span>
            <a href="tasks/add">
                <button id="add" type="button" class="btn btn-primary">タスク登録</button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
    <div class="chart" data-percent="0">
        <div class="secs fr">0sec</div>
    </div>
    <div class="chartB" data-percent="0">
        <div class="secs">0sec</div>
    </div>

    <span class="btn btn-default js_start">作業開始</span>
    <span class="btn btn-default js_stop">停止</span>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script>
    // ブラウザ対応拡張子取得
    var AUDIO_EXT = (function(){
        var ext     = "";
        var audio   = new Audio();
        if      (audio.canPlayType("audio/ogg") == 'maybe') { ext="ogg"; }
        else if (audio.canPlayType("audio/mp3") == 'maybe') { ext="mp3"; }
        else if (audio.canPlayType("audio/wav") == 'maybe') { ext="wav"; }
        return ext;
    })();
    //とりあえず固定
    AUDIO_EXT = "mp3";
    // あらかじめ読み込んでおく
    var AUDIO_LIST = {
        "ALERT": new Audio("se/alert." + AUDIO_EXT),
        "BGM": new Audio("se/bgm." + AUDIO_EXT),
    };

    $(function() {
        $('.chart').easyPieChart({
            easing: 'easeOutBounce',
            scaleLength: 0,
            lineWidth: 10,
            size: 210,
            onStep: function(from, to, percent) {
                $(this.el).find('.secs').text(Math.floor(targettime*(100-percent)/100)+"sec");
                }
            });

        $('.chartB').easyPieChart({
            easing: 'easeOutBounce',
            scaleLength: 0,
            barColor: '#0000FF',
            lineWidth: 10,
            size: 210,
            onStep: function(from, to, percent) {
                $(this.el).find('.secs').text(Math.floor(targettime*(100-percent)/100)+"sec");
                }
            });
        $('.chartB').toggle();


        $('.js_start').on('click', function(){
            if($('.js_start').text()=="作業開始"){
                $('.js_start').text("休憩開始");
                starttimer(30,1);
            }else{
                $('.js_start').text("作業開始");
                starttimer(10,0);
            }
            }
            );

        $('.js_stop').on('click', function(){
            stoptimer();}
            );

    });
    var starttime;
    var worktime = 25*60;   //25分
    var intervaltime = 5 * 60; //5分
    var targettime = 0;
    var updatetimer;
    var isPlay = false;
    function timerupdate(){
        var currentTime = new Date();
        var status = (currentTime - starttime) / 1000;
        var chart = window.chart = $('.chart').data('easyPieChart');
        chart.update((status/targettime)*100);
        var chartB = window.chartB = $('.chartB').data('easyPieChart');
        chartB.update((status/targettime)*100);
        if(status>targettime){
            if(isPlay==false){
                isPlay = true;
                AUDIO_LIST["ALERT"].pause();
                AUDIO_LIST["ALERT"].currentTime = 0;
                AUDIO_LIST["ALERT"].loop = true;                
                AUDIO_LIST["ALERT"].play();
            }
        }
    }

    function starttimer(tm1,work){
        if(targettime>0){
            stoptimer();
        }
        if(work == 1){
            $('.chart').css("display", "");
            $('.chartB').css("display", "none");
            AUDIO_LIST["BGM"].pause();
            AUDIO_LIST["BGM"].currentTime = 0;
        }else{
            $('.chart').css("display", "none");
            $('.chartB').css("display", "");
            AUDIO_LIST["BGM"].pause();
            AUDIO_LIST["BGM"].currentTime = 0;
            AUDIO_LIST["BGM"].loop = true;
            AUDIO_LIST["BGM"].play();
        }
        starttime = new Date();
        targettime = tm1;
        if(isPlay==true){
            isPlay = false;
            AUDIO_LIST["ALERT"].pause();
            AUDIO_LIST["ALERT"].currentTime = 0;
        }
        updatetimer = setInterval("timerupdate();",100);

    }

    function stoptimer(){
        clearTimeout(updatetimer);
        var chart = window.chart = $('.chart').data('easyPieChart');
        targettime = 0;
        chart.update(0);
        chart.update(0);
        var chartB = window.chartB = $('.chartB').data('easyPieChart');
        chartB.update(0);
        chartB.update(0);
    }

    $(document).ready(function(){
        console.log($.cookie("starttime"));
        $('#finish_btn').click(function(){
            $.cookie("starttime", starttime);
            $.cookie("targettime", targettime);
            $.cookie("type", $('.js_start').text());
        });

        if($.cookie("starttime")){
            starttime = new Date($.cookie("starttime"));
            $.removeCookie("starttime");
        }else{
            starttime = 0;
        }
        if($.cookie("targettime")){
            targettime = Number($.cookie("targettime"));
            $.removeCookie("targettime");
        }else{
            targettime=0;
        }
        if($.cookie("type")){
            $('.js_start').text($.cookie("type"));
            $.removeCookie("type");
        }
        if(targettime !== 0){
console.log(starttime);
            //タイマ再開
            if($('.js_start').text()=="休憩開始" ){
                $('.chart').css("display", "");
                $('.chartB').css("display", "none");

            }else{
                $('.chart').css("display", "none");
                $('.chartB').css("display", "");
            }

            updatetimer = setInterval("timerupdate();",100);

        }

    });

    </script>
        </div>
        <div class="col-md-4">
        <?php foreach ($tasks as $task): ?>
        <?php if($task->finished == NULL): ?>
            <div class="active task">
                <div class="row">
                    <div class="col-md-1">
                        <span class="label label-default">
                            <?= $this->Number->format($task->id) ?>
                        </span>
                    </div>
                    <div class="col-md-11">
                        <?= $this->Html->link($task->title, ['action' => 'edit', $task->id]) ?>
                    </div>
                </div>
                
                <?= $this->Form->create($task, array('action'=>'finish')); ?>
                <?= $this->Form->button(__('完了！'), array('id'=>'finish_btn', 'class' => 'fr btn btn-primary')) ?>
                <?= $this->Form->end() ?>
                
            </div>
        <?php endif ?>
        <?php endforeach; ?>
        </div>
        <div class="col-md-4">
        <?php foreach ($tasks as $task): ?>
        <?php if($task->finished != NULL): ?>
            <div class="done task">
                <div class="row">
                    <div class="col-md-1">
                        <span class="label label-default">
                            <?= $this->Number->format($task->id) ?>
                        </span>
                    </div>
                    <div class="col-md-11">
                        <?= h($task->title) ?>
                    </div>
                </div>
                <div class="fr">
                    <span class="label label-default">DONE at <?= h($task->finished) ?></span>
                </div>
            </div>
        <?php endif ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>