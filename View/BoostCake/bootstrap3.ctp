<?php $this->layout = 'bootstrap3'; ?>
<?php $this->set('title_for_layout', 'Bootstrap3 examples'); ?>

<h1>BoostCake Examples <small>Bootstrap Version 3.0.0-wip</small></h1>

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
			'placeholder' => 'Email',
			'style' => 'width:180px;'
		)); ?>
		<?php echo $this->Form->input('password', array(
			'placeholder' => 'Password',
			'style' => 'width:180px;'
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
		'placeholder' => 'Email',
		'style' => 'width:180px;'
	)); ?>
	<?php echo \$this->Form->input('password', array(
		'placeholder' => 'Password',
		'style' => 'width:180px;'
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
		Use Bootstrap's predefined grid classes to align labels and groups of form controls in a horizontal layout.
	</p>

	<?php echo $this->Form->create('BoostCake', array(
		'inputDefaults' => array(
			'div' => 'row',
			'label' => array(
				'class' => 'col col-lg-2 control-label'
			),
			'wrapInput' => 'col col-lg-10'
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
			'wrapInput' => 'col col-lg-10 col-offset-2',
			'label' => array(
				'text' => 'Remember me',
				'class' => 'checkbox'
			),
			'afterInput' => $this->Form->submit('Sign in', array(
				'class' => 'btn'
			))
		)); ?>
	<?php echo $this->Form->end(); ?>

	<pre class="prettyprint"><?php echo h("<?php echo \$this->Form->create('BoostCake', array(
	'inputDefaults' => array(
		'div' => 'row',
		'label' => array(
			'class' => 'col col-lg-2 control-label'
		),
		'wrapInput' => 'col col-lg-10'
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
		'wrapInput' => 'col col-lg-10 col-offset-2',
		'label' => array(
			'text' => 'Remember me',
			'class' => 'checkbox'
		),
		'afterInput' => \$this->Form->submit('Sign in', array(
			'class' => 'btn'
		))
	)); ?>
<?php echo \$this->Form->end(); ?>"); ?></pre>
	<hr>

</section>