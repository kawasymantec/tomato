<?= $this->Html->css('bootstrap.min') ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<?= $this->Html->script('bootstrap.min') ?>
<?= $this->Html->script('jquery.easypiechart.min') ?>
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
        <div class="secs">0sec</div>
    </div>
    <div class="chartB" data-percent="0">
        <div class="secs">0sec</div>
    </div>


    <span class="btn js_start">作業開始</span>
    <span class="btn js_stop">停止</span>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script>
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
    function timerupdate(){
        var currentTime = new Date();
        var status = (currentTime - starttime) / 1000;
        var chart = window.chart = $('.chart').data('easyPieChart');
        chart.update((status/targettime)*100);
        var chartB = window.chartB = $('.chartB').data('easyPieChart');
        chartB.update((status/targettime)*100);

    }

    function starttimer(tm1,work){
        if(targettime>0){
            stoptimer();
        }
        if(work == 1){
            $('.chart').css("display", "");
            $('.chartB').css("display", "none");

        }else{
            $('.chart').css("display", "none");
            $('.chartB').css("display", "");
        }

        starttime = new Date();
        targettime = tm1;
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
                <?= $this->Form->button(__('完了！'), array('class' => 'fr btn btn-primary')) ?>
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