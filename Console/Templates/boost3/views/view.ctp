<div class="row">
    <div class="col-md-9">
        <h1><?="<?= \${$singularVar}['{$modelClass}']['{$displayField}']?>"; ?></h1>
        <dl class="dl-horizontal">
            <?php
            foreach ($fields as $field) {
                $isKey = false;
                if (!empty($associations['belongsTo'])) {
                    foreach ($associations['belongsTo'] as $alias => $details) {
                        if ($field === $details['foreignKey']) {
                            $isKey = true;
                            echo "\t\t\t<dt><?=__('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></dt>\n";
                            echo "\t\t\t<dd>\n\t\t\t\t<?=\$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t\t&nbsp;\n\t\t\t</dd>\n";
                            break;
                        }
                    }
                }
                if ($isKey !== true) {
                    echo "\t\t\t<dt><?=__('" . Inflector::humanize($field) . "'); ?></dt>\n";
                    echo "\t\t\t<dd>\n\t\t\t\t<?=h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t\t&nbsp;\n\t\t\t</dd>\n";
                }
            }
            ?>
        </dl>
    </div>
    
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= "<?=__('Actions'); ?>"; ?></h3>
            </div>

            <!-- List group -->
            <ul class="list-group">
                    <?php
                echo "\t\t\t<li class=\"list-group-item\"><?=\$this->Html->link(__('Edit %s', __('" . $singularHumanName . "')), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> </li>\n";
                echo "\t\t\t<li class=\"list-group-item\"><?=\$this->Form->postLink(__('Delete %s', __('" . $singularHumanName . "')), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), null, __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> </li>\n";
                echo "\t\t\t<li class=\"list-group-item\"><?=\$this->Html->link(__('List %s', __('" . $pluralHumanName . "')), array('action' => 'index')); ?> </li>\n";
                echo "\t\t\t<li class=\"list-group-item\"><?=\$this->Html->link(__('New %s', __('" . $singularHumanName . "')), array('action' => 'add')); ?> </li>\n";

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

<?php
if (!empty($associations['hasOne'])) :
    foreach ($associations['hasOne'] as $alias => $details):
        ?>
        <div class="row">
            <div class="col-md-9">
                <h3><?="<?=__('Related %s', __('" . Inflector::humanize($details['controller']) . "')); ?>"; ?></h3>
                    <?="<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n"; ?>
                <dl>
                    <?php
                    foreach ($details['fields'] as $field) {
                        echo "\t\t\t<dt><?=__('" . Inflector::humanize($field) . "'); ?></dt>\n";
                        echo "\t\t\t<dd>\n\t\t\t\t<?=\${$singularVar}['{$alias}']['{$field}'];?>\n\t\t\t\t&nbsp;\n\t\t\t</dd>\n";
                    }
                    ?>
                </dl>
        <?="<?php endif; ?>\n"; ?>
            </div>
            <div class="col-md-3">
                <ul class="nav nav-list">
                    <li><?="<?=\$this->Html->link(__('Edit %s', __('" . Inflector::humanize(Inflector::underscore($alias)) . "')), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></li>\n"; ?>
                </ul>
            </div>
        </div>

        <?php
    endforeach;
endif;
if (empty($associations['hasMany'])) {
    $associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
    $associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
$i = 0;
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize($details['controller']);
    ?>
    <div class="row">
        <div class="col-md-9">
            <h3><?="<?=__('Related %s', __('" . $otherPluralHumanName . "')); ?>"; ?></h3>
    <?="<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n"; ?>
            <table class="table">
                <tr>
                    <?php
                    foreach ($details['fields'] as $field) {
                        echo "\t\t\t\t<th><?=__('" . Inflector::humanize($field) . "'); ?></th>\n";
                    }
                    ?>
                    <th class="actions"><?="<?=__('Actions');?>"; ?></th>
                </tr>
                <?php
                echo "\t\t<?php foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>\n";
                echo "\t\t\t<tr>\n";
                foreach ($details['fields'] as $field) {
                    echo "\t\t\t\t<td><?=\${$otherSingularVar}['{$field}'];?></td>\n";
                }

                echo "\t\t\t\t<td class=\"actions\">\n";
                echo "\t\t\t\t\t<?=\$this->Html->link(__('View'), array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
                echo "\t\t\t\t\t<?=\$this->Html->link(__('Edit'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
                echo "\t\t\t\t\t<?=\$this->Form->postLink(__('Delete'), array('controller' => '{$details['controller']}', 'action' => 'delete', \${$otherSingularVar}['{$details['primaryKey']}']), null, __('Are you sure you want to delete # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
                echo "\t\t\t\t</td>\n";
                echo "\t\t\t</tr>\n";

                echo "\t\t<?php endforeach; ?>\n";
                ?>
            </table>
    <?="<?php endif; ?>\n\n"; ?>
        </div>
        <div class="col-md-3">
            <ul class="nav nav-list">
                <li><?="<?=\$this->Html->link(__('New %s', __('" . Inflector::humanize(Inflector::underscore($alias)) . "')), array('controller' => '{$details['controller']}', 'action' => 'add'));?>"; ?> </li>
            </ul>
        </div>
    </div>
<?php endforeach; ?>
