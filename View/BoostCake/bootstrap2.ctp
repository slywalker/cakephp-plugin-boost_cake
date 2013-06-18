<?php $this->layout = 'bootstrap2'; ?>
<?php $this->set('title_for_layout', 'Bootstrap2 examples'); ?>

<h1>BoostCake Examples <small>Bootstrap Version 2.3.2</small></h1>

<section id="forms">
	<div class="page-header">
		<h2>Forms</h2>
	</div>

	<h3>Default styles</h3>
	<p>Individual form controls receive styling, but without any required base class on the <code>&lt;form&gt;</code> or large changes in markup. Results in stacked, left-aligned labels on top of form controls.</p>

	<?php echo $this->Form->create('BoostCake', array(
		'inputDefaults' => array(
			'div' => false,
			'wrapInput' => false
		),
		'class' => 'well'
	)); ?>
		<fieldset>
			<legend>Legend</legend>
			<?php echo $this->Form->input('text', array(
				'label' => 'Label name',
				'placeholder' => 'Type something…',
				'after' => '<span class="help-block">Example block-level help text here.</span>'
			)); ?>
			<?php echo $this->Form->input('checkbox', array(
				'label' => array(
					'text' => 'Check me out',
					'class' => 'checkbox'
				)
			)); ?>
			<?php echo $this->Form->submit('Submit', array(
				'div' => false,
				'class' => 'btn'
			)); ?>
		</fieldset>
	<?php echo $this->Form->end(); ?>

	<pre class="prettyprint"><?php echo h("<?php echo \$this->Form->create('BoostCake', array(
	'inputDefaults' => array(
		'div' => false,
		'wrapInput' => false
	),
	'class' => 'well'
)); ?>
	<fieldset>
		<legend>Legend</legend>
		<?php echo \$this->Form->input('text', array(
			'label' => 'Label name',
			'placeholder' => 'Type something…',
			'after' => '<span class=\"help-block\">Example block-level help text here.</span>'
		)); ?>
		<?php echo \$this->Form->input('checkbox', array(
			'label' => array(
				'text' => 'Check me out',
				'class' => 'checkbox'
			)
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

	<?php echo $this->Form->create('BoostCake', array(
		'inputDefaults' => array(
			'div' => false,
			'wrapInput' => false
		),
		'class' => 'well form-search'
	)); ?>
		<?php echo $this->Form->input('text', array(
			'label' => false,
			'class' => 'input-medium search-query',
		)); ?>
		<?php echo $this->Form->submit('Search', array(
			'div' => false,
			'class' => 'btn'
		)); ?>
	<?php echo $this->Form->end(); ?>

	<pre class="prettyprint"><?php echo h("<?php echo \$this->Form->create('BoostCake', array(
	'inputDefaults' => array(
		'div' => false,
		'wrapInput' => false
	),
	'class' => 'well form-search'
)); ?>
	<?php echo \$this->Form->input('text', array(
		'label' => false,
		'class' => 'input-medium search-query',
	)); ?>
	<?php echo \$this->Form->submit('Search', array(
		'div' => false,
		'class' => 'btn'
	)); ?>
<?php echo \$this->Form->end(); ?>"); ?></pre>
	<hr>

	<h3>Inline form</h3>
	<p>Add <code>.form-inline</code> for left-aligned labels and inline-block controls for a compact layout.</p>

	<?php echo $this->Form->create('BoostCake', array(
		'inputDefaults' => array(
			'div' => false,
			'label' => false,
			'wrapInput' => false
		),
		'class' => 'well form-inline'
	)); ?>
		<?php echo $this->Form->input('email', array(
			'class' => 'input-small',
			'placeholder' => 'Email'
		)); ?>
		<?php echo $this->Form->input('password', array(
			'class' => 'input-small',
			'placeholder' => 'Password'
		)); ?>
		<?php echo $this->Form->input('remember', array(
			'label' => array(
				'text' => 'Remember me',
				'class' => 'checkbox'
			)
		)); ?>
		<?php echo $this->Form->submit('Sign in', array(
			'div' => false,
			'class' => 'btn'
		)); ?>
	<?php echo $this->Form->end(); ?>

	<pre class="prettyprint"><?php echo h("<?php echo \$this->Form->create('BoostCake', array(
	'inputDefaults' => array(
		'div' => false,
		'label' => false,
		'wrapInput' => false
	),
	'class' => 'well form-inline'
)); ?>
	<?php echo \$this->Form->input('email', array(
		'class' => 'input-small',
		'placeholder' => 'Email'
	)); ?>
	<?php echo \$this->Form->input('password', array(
		'class' => 'input-small',
		'placeholder' => 'Password'
	)); ?>
	<?php echo \$this->Form->input('remember', array(
		'label' => array(
			'text' => 'Remember me',
			'class' => 'checkbox'
		)
	)); ?>
	<?php echo \$this->Form->submit('Sign in', array(
		'div' => false,
		'class' => 'btn'
	)); ?>
<?php echo \$this->Form->end(); ?>"); ?></pre>
	<hr>

	<h3>Horizontal form</h3>
	<p>
		Right align labels and float them to the left to make them appear on the same line as controls.
		Requires the most markup changes from a default form:
	</p>
	<ul>
		<li>Add <code>.form-horizontal</code> to the form</li>
		<li>Wrap labels and controls in <code>.control-group</code></li>
		<li>Add <code>.control-label</code> to the label</li>
		<li>Wrap any associated controls in <code>.controls</code> for proper alignment</li>
	</ul>

	<?php echo $this->Form->create('BoostCake', array(
		'inputDefaults' => array(
			'div' => 'control-group',
			'label' => array(
				'class' => 'control-label'
			),
			'wrapInput' => 'controls'
		),
		'class' => 'well form-horizontal'
	)); ?>
		<?php echo $this->Form->input('email', array(
			'placeholder' => 'Email'
		)); ?>
		<?php echo $this->Form->input('password', array(
			'placeholder' => 'Password'
		)); ?>
		<?php echo $this->Form->input('remember', array(
			'label' => array(
				'text' => 'Remember me',
				'class' => 'checkbox'
			)
		)); ?>
		<?php echo $this->Form->submit('Sign in', array(
			'div' => 'form-actions',
			'class' => 'btn'
		)); ?>
	<?php echo $this->Form->end(); ?>

	<pre class="prettyprint"><?php echo h("<?php echo \$this->Form->create('BoostCake', array(
	'inputDefaults' => array(
		'div' => 'control-group',
		'label' => array(
			'class' => 'control-label'
		),
		'wrapInput' => 'controls'
	),
	'class' => 'well form-horizontal'
)); ?>
	<?php echo \$this->Form->input('email', array(
		'placeholder' => 'Email'
	)); ?>
	<?php echo \$this->Form->input('password', array(
		'placeholder' => 'Password'
	)); ?>
	<?php echo \$this->Form->input('remember', array(
		'label' => array(
			'text' => 'Remember me',
			'class' => 'checkbox'
		)
	)); ?>
	<?php echo \$this->Form->submit('Sign in', array(
		'div' => 'form-actions',
		'class' => 'btn'
	)); ?>
<?php echo \$this->Form->end(); ?>"); ?></pre>
	<hr>

</section>