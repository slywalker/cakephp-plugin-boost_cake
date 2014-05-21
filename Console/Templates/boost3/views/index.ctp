<div class="row">
    <div class="col-md-9">
        <h2><?= "<?=__('List %s', __('{$pluralHumanName}'));?>"; ?></h2>

        <p>
            <?= "<?=\$this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>\n"; ?>
        </p>
        <?= "<?=\$this->Paginator->pagination(array(
            'ul' => 'pagination pagination-lg'
        )); ?>\n"; ?>
        <table class="table table-striped">
            <tr>
                <? foreach($fields as $field): ?>
                <th><?= "<?=\$this->Paginator->sort('{$field}');?>"; ?></th>
                <? endforeach; ?>
                <th class="actions" style="white-space: nowrap"><?= "<?=__('Actions');?>"; ?></th>
            </tr>
            <?php
            echo "\t\t<?foreach(\${$pluralVar} as \${$singularVar}): ?>\n";
            echo "\t\t\t<tr>\n";
            foreach ($fields as $field) {
                $isKey = false;
                if (!empty($associations['belongsTo'])) {
                    foreach ($associations['belongsTo'] as $alias => $details) {
                        if ($field === $details['foreignKey']) {
                            $isKey = true;
                            echo "\t\t\t\t<td>\n\t\t\t\t\t<?=\$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t\t</td>\n";
                            break;
                        }
                    }
                }
                if ($isKey !== true) {
                    echo "\t\t\t\t<td><?=h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
                }
            }

            echo "\t\t\t\t<td class=\"actions btn-group btn-group-xs\" style=\"white-space: nowrap\">\n";

            echo "\t\t\t\t\t<?= \$this->Html->link('<span class=\"glyphicon glyphicon-eye-open\"></span>', array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false, 'class' => 'btn btn-success')); ?>\n";
            echo "\t\t\t\t\t<?= \$this->Html->link('<span class=\"glyphicon glyphicon-edit\"></span>', array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false, 'class' => 'btn btn-info')); ?>\n";
            echo "\t\t\t\t\t<?= \$this->Form->postLink('<span class=\"glyphicon glyphicon-remove-circle\"></span>', array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
            echo "\t\t\t\t</td>\n";
            echo "\t\t\t</tr>\n";

            echo "\t\t<? endforeach; ?>\n";
            ?>
        </table>

        <?= "<?=\$this->Paginator->pagination(array(
            'ul' => 'pagination pagination-lg'
        )); ?>\n"; ?>
    </div>
    <div class="col-md-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= "<?=__('Actions'); ?>"; ?></h3>
            </div>

            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item"><?= "<?=\$this->Html->link(__('New %s', __('" . $singularHumanName . "')), array('action' => 'add')); ?>"; ?></li>
                    <?php
                    $done = array();
                    foreach ($associations as $type => $data) {
                        foreach ($data as $alias => $details) {
                            if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                                echo "\t\t\t<li class=\"list-group-item\"><?=\$this->Html->link(__('List %s', __('" . Inflector::humanize($details['controller']) . "')), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
                                echo "\t\t\t<li class=\"list-group-item\"><?=\$this->Html->link(__('New %s', __('" . Inflector::humanize(Inflector::underscore($alias)) . "')), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
                                $done[] = $details['controller'];
                            }
                        }
                    }
                    ?>
            </ul>
        </div>
    </div>

</div>