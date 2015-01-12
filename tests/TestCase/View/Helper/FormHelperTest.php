<?php
namespace BoostCake\Test\TestCase\View\Helper;

use BoostCake\View\Helper\FormHelper;
use Cake\View\View;
use Cake\TestSuite\TestCase;
use Cake\View\Form\NullContext;

class TestContext extends NullContext
{

    /**
     * {@inheritDoc}
     */
    public function hasError($field)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function error($field)
    {
        return ['Please fill in the field'];
    }
}

class FormHelperTest extends TestCase
{

    public $View, $Form;

    public function setUp()
    {
        parent::setUp();
        $this->View = new View();
        $this->Form = new FormHelper($this->View);
    }

    public function tearDown()
    {
        unset($this->View);
        unset($this->Form);
    }

    public function testInput()
    {
        $result = $this->Form->input('name');
        $this->assertHtml([
            ['div' => ['class' => 'form-group text']],
            'label' => ['for' => 'name', 'class' => 'control-label'],
            'Name',
            '/label',
            ['input' => ['name' => 'name', 'type' => 'text', 'id' => 'name', 'class' => 'form-control']],
            '/div'
        ], $result);
    }

    public function testCheckbox()
    {
        $result = $this->Form->input('name', ['type' => 'checkbox']);
        $this->assertHtml([
            ['div' => ['class' => 'form-group checkbox']],
            ['input' => ['type' => 'hidden', 'name' => 'name', 'value' => '0']],
            ['input' => ['name' => 'name', 'type' => 'checkbox', 'value' => '1', 'id' => 'name']],
            'label' => ['class' => 'control-label', 'for' => 'name'],
            'Name',
            '/label',
            '/div'
        ], $result);
    }

    public function testSelectMultipleCheckbox()
    {
        $result = $this->Form->select(
            'name',
            [
                1 => 'one',
                2 => 'two',
                3 => 'three'
            ],
            [
                'multiple' => 'checkbox'
            ]
        );
        $this->assertHtml([
            ['input' => ['type' => 'hidden', 'name' => 'name', 'value' => '']],
            ['div' => ['class' => 'checkbox']],
            ['input' => ['type' => 'checkbox', 'name' => 'name[]', 'value' => '1', 'id' => 'name-1']],
            ['label' => ['for' => 'name-1']],
            'one',
            '/label',
            '/div',
            ['div' => ['class' => 'checkbox']],
            ['input' => ['type' => 'checkbox', 'name' => 'name[]', 'value' => '2', 'id' => 'name-2']],
            ['label' => ['for' => 'name-2']],
            'two',
            '/label',
            '/div',
            ['div' => ['class' => 'checkbox']],
            ['input' => ['type' => 'checkbox', 'name' => 'name[]', 'value' => '3', 'id' => 'name-3']],
            ['label' => ['for' => 'name-3']],
            'three',
            '/label',
            '/div',
        ], $result);
    }

    public function testRadio()
    {
        $result = $this->Form->input('name', [
            'type' => 'radio',
            'options' => [
                'one' => 'This is one',
                'two' => 'This is two'
            ]
        ]);
        $this->assertHtml([
            ['div' => ['class' => 'form-group radio']],
            ['input' => ['type' => 'hidden', 'name' => 'name', 'value' => '']],
            ['div' => ['class' => 'radio']],
            ['label' => ['for' => 'name-one']],
            ['input' => ['name' => 'name', 'type' => 'radio', 'value' => 'one', 'id' => 'name-one']],
            'This is one',
            '/label',
            '/div',
            ['div' => ['class' => 'radio']],
            ['label' => ['for' => 'name-two']],
            ['input' => ['name' => 'name', 'type' => 'radio', 'value' => 'two', 'id' => 'name-two']],
            'This is two',
            '/label',
            '/div',
            '/div'
        ], $result);
    }

    public function testErrorMessage()
    {
        $context = new TestContext(new \Cake\Network\Request(), []);

        $this->Form->addContextProvider('testContext', function ($request, $data) {
            if ($data['entity'] instanceof TestContext) {
                return $data['entity'];
            }
        });
        $this->Form->create($context);
        $result = $this->Form->input('Contact.password');
        $this->assertHtml([
            ['div' => ['class' => 'form-group password has-error']],
            'label' => ['for' => 'contact-password', 'class' => 'control-label'],
            'Password',
            '/label',
            'input' => [
                'type' => 'password',
                'name' => 'Contact[password]',
                'id' => 'contact-password',
                'class' => 'form-control form-error'
            ],
            ['span' => ['class' => 'help-block text-danger']],
            'Please fill in the field',
            '/span',
            '/div'
        ], $result);
    }
}