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
            <a href="/tasks/add">
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
            <?= '<div class="active task">' ?>
                <?= $this->Number->format($task->id) ?><br>
                <?= h($task->title) ?>
            <?= "</div>" ?>
        <?php endforeach; ?>
        </div>
        <div class="col-md-4">
        <?php foreach ($tasks as $task): ?>
            <?= '<div class="done task">' ?>
                <?= $this->Number->format($task->id) ?> (DONE at <?= h($task->finished) ?>)<br>
                <?= h($task->title) ?>
            <?= "</div>" ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>