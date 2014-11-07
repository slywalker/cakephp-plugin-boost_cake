<div class="row">
    <div class="col-md-9">
        <?="<?=\$this->Form->create('{$modelClass}', array(
            'class' => 'form-horizontal',
            'inputDefaults' => array(
                'label' => array(
                    'class' => 'col-md-3 control-label',
                ),
                'div' => array(
                    'class' => 'form-group',
                ),
                'wrapInput' => array(
                    'class' => 'col-md-9'
                ),
                'class' => 'form-control'
            )
        ));
        ?>"; ?>
        <fieldset>
            <legend><?="<?=__('" . Inflector::humanize($action) . " %s', __('" . $singularHumanName . "')); ?>"; ?></legend>
            <?php
            echo "\t\t\t\t<?php\n";
            $id = null;
            foreach ($fields as $field) {
                if (strpos($action, 'add') !== false && $field == $primaryKey) {
                    continue;
                } elseif (!in_array($field, array('created', 'modified', 'updated'))) {
                    if ($field == $primaryKey) {
                        $id = "\t\t\t\techo \$this->Form->hidden('{$field}');\n";
                    } else {
                        if ($this->templateVars['schema'][$field]['null'] == false) {
                            $required = ", array(\n\t\t\t\t\t'required' => 'required',\n\t\t\t\t\t'afterInput' => '<span class=\"help-block\"><span class=\"text-danger\">' . __('Required') . '</span></span>&nbsp;')\n\t\t\t\t";
                        } else {
                            $required = null;
                        }
                        echo "\t\t\t\techo \$this->Form->input('{$field}'{$required});\n";
                    }
                }
            }
            echo $id;
            unset($id);
            if (!empty($associations['hasAndBelongsToMany'])) {
                foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
                    echo "\t\t\t\techo \$this->Form->input('{$assocName}');\n";
                }
            }
            echo "\t\t\t\t?>\n";
            echo "\t\t\t\t<?=\$this->Form->submit(__('Submit'));?>\n";
            ?>
        </fieldset>
        <?php
        echo "<?=\$this->Form->end();?>\n";
        ?>
    </div>
    
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= "<?=__('Actions'); ?>"; ?></h3>
            </div>

            <ul class="list-group">
                <? if(strpos($action, 'add') === false): ?>
                    <li class="list-group-item"><?="<?=\$this->Form->postLink(__('Delete'), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), null, __('Are you sure you want to delete # %s?', \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>"; ?></li>
                <? endif; ?>
                <li class="list-group-item"><?="<?=\$this->Html->link(__('List %s', __('" . $pluralHumanName . "')), array('action' => 'index'));?>"; ?></li>
                <?php
                $done = array();
                foreach ($associations as $type => $data) {
                    foreach ($data as $alias => $details) {
                        if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                            echo "\t\t\t<li class=\"list-group-item\"><?=\$this->Html->link(__('List %s', __('" . Inflector::humanize($details['controller']) . "')), array('controller' => '{$details['controller']}', 'action' => 'index')); ?></li>\n";
                            echo "\t\t\t<li class=\"list-group-item\"><?=\$this->Html->link(__('New %s', __('" . Inflector::humanize(Inflector::underscore($alias)) . "')), array('controller' => '{$details['controller']}', 'action' => 'add')); ?></li>\n";
                            $done[] = $details['controller'];
                        }
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>