<?php
namespace BoostCake\View\Helper;

use Cake\View\Helper\FormHelper as BaseForm;
use Cake\View\View;

class FormHelper extends BaseForm
{

    /**
     * Bootstrap template strings
     *
     * @var array
     */
    protected $_bootstrapTemplates = [
        'error' => '<div class="clearfix"></div><div class="help-block text-danger">{{content}}</div>',
        'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
        'inputContainerError' => '<div class="form-group {{type}}{{required}} has-error">{{content}}{{error}}</div>',
        'submitContainer' => '<div class="submit">{{content}}</div>',
        'radioLabel' => '<label{{attrs}}>{{input}}{{text}}</label>',
        'radioWrapper' => '<div class="radio">{{label}}</div>',
        'checkboxContainer' => '<div class="form-group {{required}}">{{content}}</div>',
        'formGroup' => '{{label}}{{input}}',
        'checkboxFormGroup' => '<div class="checkbox">{{label}}</div>',
        'staticInput' => '<p class="form-control-static">{{value}}</p>'
    ];

    /**
     * Construct the widgets and binds the default context providers
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig += [
            'formStyle' => 'normal',
            'columnCount' => 12,
            'labelWidth' => 3,
            'fieldWidth' => 9,
        ];
        $this->_defaultConfig['templates'] = array_merge($this->_defaultConfig['templates'],
            $this->_bootstrapTemplates);
        parent::__construct($View, $config);

        $this->addWidget('radio', ['BoostCake\View\Widget\RadioWidget', 'label']);
        $this->addWidget('static', ['BoostCake\View\Widget\StaticWidget']);
    }

    /**
     * {{@inheritDoc}}
     *
     * @param string $fieldName Fieldname
     * @param array $options Options
     *
     * @return string
     */
    public function input($fieldName, array $options = [])
    {
        $options = $this->addClass($options, 'form-control');

        if (isset($options['type']) && $options['type'] === 'static') {
            $options['id'] = false;
        }

        return parent::input($fieldName, $options);
    }

    /**
     * {{@inheritDoc}}
     *
     * @param string $fieldName Field
     * @param null $text Label text
     * @param array $options Options
     *
     * @return string
     */
    public function label($fieldName, $text = null, array $options = [])
    {
        if ($this->_formStyle == 'horizontal' && !isset($options['ignoreStyle']) && empty($options['input'])) {
            $options = $this->addClass($options, 'col-sm-' . $this->_config['labelWidth']);
        }
        if (empty($options['input'])) {
            $options = $this->addClass($options, 'control-label');
        }
        unset($options['ignoreStyle']);

        return parent::label($fieldName, $text, $options);
    }

    /**
     * {{@inheritDoc}}
     *
     * @param string $fieldName Field
     * @param array $options Options
     *
     * @return string
     */
    public function checkbox($fieldName, array $options = [])
    {
        if (isset($options['type']) && !empty($options['class']) && $options['type'] == 'checkbox') {
            $options['class'] = trim(str_replace('form-control', '', $options['class']));
            if (empty($options['class'])) {
                unset($options['class']);
            }
        }

        return parent::checkbox($fieldName, $options);
    }

    protected function _formStyleOptions($options)
    {
        $options = $options + [
                'formStyle' => null
            ];

        $formStyle = $options['formStyle'];
        unset($options['formStyle']);

        switch ($formStyle) {
            case 'horizontal':
                if (isset($options['labelWidth'])) {
                    $this->_config['labelWidth'] = $options['labelWidth'];
                    unset($options['labelWidth']);
                }
                $this->_config['fieldWidth'] = $this->_config['columnCount'] - $this->_config['labelWidth'];

                $options = $this->addClass($options, 'form-horizontal');
                $this->_formStyle = 'horizontal';
                $this->templates([
                    'formGroup' => '{{label}}<div class="col-sm-' . $this->_config['fieldWidth'] . '">{{input}}</div>',
                    'checkboxFormGroup' => '<div class="col-sm-' . $this->_config['fieldWidth'] . ' col-sm-offset-' . $this->_config['labelWidth'] . '"><div class="checkbox">{{label}}</div></div>',
                    'error' => '<div class="clearfix"></div><div class="help-block text-danger col-sm-' . $this->_config['fieldWidth'] . ' col-sm-push-' . $this->_config['labelWidth'] . '">{{content}}</div>',
                ]);
                break;
            case 'vertical':
            default:
                $this->_formStyle = 'vertical';
                break;
        }

        return $options;
    }

    /**
     * {{@inheritDoc}}
     *
     * @param null $model Context
     * @param array $options Options
     *
     * @return string
     */
    public function create($model = null, array $options = [])
    {
        $options = $this->_formStyleOptions($options);
        return parent::create($model, $options);
    }

    /**
     * Creates a `<button>` tag.
     *
     * The type attribute defaults to `type="submit"`
     * You can change it to a different value by using `$options['type']`.
     *
     * ### Options:
     *
     * - `escape` - HTML entity encode the $title of the button. Defaults to false.
     *
     * @param string $title The button's caption. Not automatically HTML encoded
     * @param array $options Array of options and HTML attributes.
     * @return string A HTML button tag.
     * @link http://book.cakephp.org/3.0/en/views/helpers/form.html#creating-button-elements
     */
    public function button($title, array $options = [])
    {
        $options += ['class' => 'btn'];
        return parent::button($title, $options);
    }
}
