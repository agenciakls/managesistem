<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Expense $expense
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Expense'), ['action' => 'edit', $expense->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Expense'), ['action' => 'delete', $expense->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expense->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Expenses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Expense'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="expenses view content">
            <h3><?= h($expense->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($expense->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($expense->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($expense->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Costs') ?></h4>
                <?php if (!empty($expense->costs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Detalhes') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Expense Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($expense->costs as $costs) : ?>
                        <tr>
                            <td><?= h($costs->id) ?></td>
                            <td><?= h($costs->title) ?></td>
                            <td><?= h($costs->detalhes) ?></td>
                            <td><?= h($costs->price) ?></td>
                            <td><?= h($costs->expense_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Costs', 'action' => 'view', $costs->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Costs', 'action' => 'edit', $costs->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Costs', 'action' => 'delete', $costs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $costs->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
