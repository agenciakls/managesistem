<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Situation $situation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Situation'), ['action' => 'edit', $situation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Situation'), ['action' => 'delete', $situation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $situation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Situations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Situation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="situations view content">
            <h3><?= h($situation->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($situation->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($situation->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($situation->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Services') ?></h4>
                <?php if (!empty($situation->services)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Os') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Client Id') ?></th>
                            <th><?= __('Situation Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($situation->services as $services) : ?>
                        <tr>
                            <td><?= h($services->id) ?></td>
                            <td><?= h($services->os) ?></td>
                            <td><?= h($services->date) ?></td>
                            <td><?= h($services->title) ?></td>
                            <td><?= h($services->price) ?></td>
                            <td><?= h($services->client_id) ?></td>
                            <td><?= h($services->situation_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Services', 'action' => 'view', $services->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Services', 'action' => 'edit', $services->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Services', 'action' => 'delete', $services->id], ['confirm' => __('Are you sure you want to delete # {0}?', $services->id)]) ?>
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
