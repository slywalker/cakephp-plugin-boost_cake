<?php
namespace BoostCake\View\Widget;

use Cake\View\Widget\WidgetInterface;

class RadioWidget extends \Cake\View\Widget\RadioWidget implements WidgetInterface
{

    /**
     * Renders a label element for a given radio or checkbox button.
     *
     * In the future this might be refactored into a separate widget as other
     * input types (multi-checkboxes) will also need labels generated.
     *
     * @param array $radio The input properties.
     * @param false|string|array $label The properties for a label.
     * @param string $input The input widget.
     * @param \Cake\View\Form\ContextInterface $context The form context.
     * @param bool $escape Whether or not to HTML escape the label.
     *
     * @return string Generated label.
     */
    protected function _renderLabel($radio, $label, $input, $context, $escape)
    {
        $normalLabel = $this->_templates->get('label');
        $this->_templates->remove('label');
        $this->_templates->add([
            'label' => $this->_templates->get('radioLabel')
        ]);

        if ($label === false) {
            return false;
        }
        $labelAttrs = is_array($label) ? $label : [];
        $labelAttrs += [
            'for' => $radio['id'],
            'escape' => $escape,
            'text' => $radio['text'],
            'input' => $input,
        ];

        $label = $this->_label->render($labelAttrs, $context);

        $this->_templates->remove('label');
        $this->_templates->add([
            'label' => $normalLabel
        ]);

        return $label;
    }
}
