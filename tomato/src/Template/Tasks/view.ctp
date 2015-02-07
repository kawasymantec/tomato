<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Task'), ['action' => 'edit', $task->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Task'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="tasks view large-10 medium-9 columns">
    <h2><?= h($task->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($task->title) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($task->id) ?></p>
            <h6 class="subheader"><?= __('Pomodoros') ?></h6>
            <p><?= $this->Number->format($task->pomodoros) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Started') ?></h6>
            <p><?= h($task->started) ?></p>
            <h6 class="subheader"><?= __('Finished') ?></h6>
            <p><?= h($task->finished) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($task->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($task->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($task->description)); ?>

        </div>
    </div>
</div>
