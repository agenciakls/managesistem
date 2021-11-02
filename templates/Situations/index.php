<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Situation[]|\Cake\Collection\CollectionInterface $situations
 */
?>
<div class="situations index content">
    <?= $this->Html->link(__('New Situation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Situations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('slug') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($situations as $situation): ?>
                <tr>
                    <td><?= $this->Number->format($situation->id) ?></td>
                    <td><?= h($situation->title) ?></td>
                    <td><?= h($situation->slug) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $situation->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $situation->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $situation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $situation->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
