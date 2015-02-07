<?= $this->Html->css('bootstrap.min') ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<?= $this->Html->script('bootstrap.min') ?>
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
            <a href="#" class="thumbnail">
              <img src="" alt="" class="img-circle">
            </a>
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