<?php
namespace BoostCake\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\View\Widget\WidgetInterface;

class StaticWidget implements WidgetInterface
{

    /**
     * Templates
     *
     * @var \Cake\View\StringTemplate
     */
    protected $_templates;

    /**
     * The template to use.
     *
     * @var string
     */
    protected $_staticTemplate = 'staticInput';

    /**
     * Constructor.
     *
     * @param \Cake\View\StringTemplate $templates Templates list.
     */
    public function __construct($templates)
    {
        $this->_templates = $templates;
    }

    /**
     * Render a static input widget.
     *
     * Accepts the following keys in $data:
     *
     * - `value` The value to display
     * - `escape` Set to false to disable HTML escaping.
     *
     * All other attributes will be converted into HTML attributes.
     *
     * @param array $data Data array.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     *
     * @return string
     */
    public function render(array $data, ContextInterface $context)
    {
        $data += [
            'escape' => true,
        ];

        return $this->_templates->format($this->_staticTemplate, [
            'value' => $data['escape'] ? h($data['val']) : $data['val'],
        ]);
    }

    /**
     * Returns a list of fields that need to be secured for
     * this widget. Fields are in the form of Model[field][suffix]
     *
     * @param array $data The data to render.
     *
     * @return array Array of fields to secure.
     */
    public function secureFields(array $data)
    {
        return [];
    }
}
