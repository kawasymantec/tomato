<?= $this->Html->css('base.css') ?>
<?= $this->Html->css('cake.css') ?>

<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $task->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="tasks form large-10 medium-9 columns">
    <?= $this->Form->create($task); ?>
    <fieldset>
        <legend><?= __('Edit Task') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('pomodoros');
            echo $this->Form->input('started');
            echo $this->Form->input('finished');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
