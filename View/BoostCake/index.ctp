<?php $this->set('title_for_layout', 'BoostCake'); ?>

<section id="forms">
	<div class="page-header">
		<h2>Forms</h2>
	</div>

	<h3>Default styles</h3>
	<p>Individual form controls receive styling, but without any required base class on the <code>&lt;form&gt;</code> or large changes in markup. Results in stacked, left-aligned labels on top of form controls.</p>

	<?php echo $this->Form->create(null, array(
		'inputDefaults' => array(
			'div' => array('tag' => false, 'div' => false)
		),
		'class' => 'well'
	)); ?>
		<fieldset>
			<legend>Legend</legend>
			<?php echo $this->Form->input('type', array(
				'label' => 'Label name',
				'type' => 'text',
				'placeholder' => 'Type something…',
				'after' => '<span class="help-block">Example block-level help text here.</span>'
			)); ?>
			<?php echo $this->Form->input('check', array(
				'label' => array(
					'text' => 'Check me out',
					'class' => 'checkbox'
				),
				'type' => 'checkbox'
			)); ?>
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn'
			)); ?>
		</fieldset>
	<?php echo $this->Form->end(); ?>

	<pre class="prettyprint"><?php echo h("<?php echo \$this->Form->create(null, array(
	'inputDefaults' => array(
		'div' => array('tag' => false, 'div' => false),
		'class' => 'well'
	)
)); ?>
	<fieldset>
		<legend>Legend</legend>
		<?php echo \$this->Form->input('type', array(
			'label' => 'Label name',
			'type' => 'text',
			'placeholder' => 'Type something…',
			'after' => '<span class=\"help-block\">Example block-level help text here.</span>'
		)); ?>
		<?php echo \$this->Form->input('check', array(
			'label' => array(
				'text' => 'Check me out',
				'class' => 'checkbox'
			),
			'type' => 'checkbox'
		)); ?>
		<?php echo \$this->Form->submit('Submit', array(
			'div' => false,
			'class' => 'btn'
		)); ?>
	</fieldset>
<?php echo \$this->Form->end(); ?>"); ?></pre>
	<hr>

	<h3>Search form</h3>
	<p>Add <code>.form-search</code> to the form and <code>.search-query</code> to the <code>&lt;input&gt;</code> for an extra-rounded text input.</p>

	<?php echo $this->Form->create(null, array(
		'inputDefaults' => array(
			'div' => array('tag' => false, 'div' => false)
		),
		'class' => 'well form-search'
	)); ?>
		<?php echo $this->Form->input('search', array(
			'label' => false,
			'type' => 'text',
			'class' => 'input-medium search-query',
		)); ?>
		<?php echo $this->Form->submit('Search', array(
			'div' => false,
			'class' => 'btn'
		)); ?>
	<?php echo $this->Form->end(); ?>

	<pre class="prettyprint"><?php echo h("<?php echo \$this->Form->create(null, array(
	'inputDefaults' => array(
		'div' => array('tag' => false, 'div' => false)
	),
	'class' => 'well form-search'
)); ?>
	<?php echo \$this->Form->input('search', array(
		'label' => false,
		'type' => 'text',
		'class' => 'input-medium search-query',
	)); ?>
	<?php echo \$this->Form->submit('Search', array(
		'div' => false,
		'class' => 'btn'
	)); ?>
<?php echo \$this->Form->end(); ?>"); ?></pre>