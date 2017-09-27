<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $option->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $option->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Options'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="options form large-9 medium-8 columns content">
    <?= $this->Form->create($option) ?>
    <fieldset>
        <legend><?= __('Edit Option') ?></legend>
        <?php
            echo $this->Form->control('opt_key');
            echo $this->Form->control('opt_value');
            echo $this->Form->control('opt_autoload');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
