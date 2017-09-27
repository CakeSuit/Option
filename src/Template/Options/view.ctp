<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $option
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Option'), ['action' => 'edit', $option->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Option'), ['action' => 'delete', $option->id], ['confirm' => __('Are you sure you want to delete # {0}?', $option->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Options'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Option'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="options view large-9 medium-8 columns content">
    <h3><?= h($option->opt_key) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($option->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Opt Key') ?></th>
            <td><?= h($option->opt_key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Opt Autoload') ?></th>
            <td><?= $option->opt_autoload ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Opt Value') ?></h4>
        <?= $this->Text->autoParagraph(h($option->opt_value)); ?>
    </div>
</div>
