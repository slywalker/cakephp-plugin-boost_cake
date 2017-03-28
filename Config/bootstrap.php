<?php
/**
 * Bootstrap version
 */
Configure::write('BoostCake.bootstrap_version', '3');

/**
 * Default inputDefaults by version and form type
 * Simply supply a form class and the following inputDefaults will be default
 * These defaults will be overridden by any passed inputDefaults using Hash::merge()
 */
Configure::write('BoostCake.inputDefaults', array(
	'2' => array(
		'default' => array(
			'div' => false,
			'wrapInput' => false
		),
		'form-inline' => array(
			'div' => false,
			'label' => false,
			'wrapInput' => false
		),
		'form-horizontal' => array(
			'div' => 'form-group',
			'label' => array(
				'class' => 'control-label'
			),
			'wrapInput' => 'controls'
		)
	),
	'3' => array(
		'default' => array(
			'div' => 'form-group',
			'wrapInput' => false,
			'class' => 'form-control'
		),
		'form-inline' => array(
			'div' => 'form-group',
			'label' => false,
			'wrapInput' => false,
			'class' => 'form-control'
		),
		'form-horizontal' => array(
			'div' => 'form-group',
			'label' => array(
				'class' => 'col col-md-3 control-label'
			),
			'wrapInput' => 'col col-md-9',
			'class' => 'form-control'
		)
	)
));