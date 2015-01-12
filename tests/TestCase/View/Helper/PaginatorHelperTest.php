<?php
namespace BoostCake\Test\TestCase\View\Helper;

use BoostCake\View\Helper\PaginatorHelper;
use Cake\TestSuite\TestCase;
use Cake\View\Helper;
use Cake\View\View;

/**
 * BootstrapPaginatorHelper Test Case
 *
 */
class PaginatorHelperTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $View = new View();
        $this->Paginator = new PaginatorHelper($View);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Paginator);

        parent::tearDown();
    }

    /**
     * testPaginationEmpty
     *
     * @return void
     */
    public function testPaginationEmpty()
    {
        $this->Paginator->request->params['paging']['Post'] = [
            'page' => 1,
            'current' => 0,
            'count' => 0,
            'prevPage' => false,
            'nextPage' => false,
            'pageCount' => 1,
            'order' => null,
            'limit' => 20,
            'options' => [
                'page' => 1,
                'conditions' => []
            ],
            'paramType' => 'named'
        ];
        $numbers = $this->Paginator->pagination(['model' => 'Post']);
        $this->assertSame('', $numbers);
    }

    /**
     * testPaginationTwoModel
     *
     * @return void
     */
    public function testPaginationTwoModel()
    {
        $this->Paginator->request->params['paging']['Post'] = [
            'page' => 1,
            'current' => 0,
            'count' => 0,
            'prevPage' => false,
            'nextPage' => false,
            'pageCount' => 1,
            'order' => null,
            'limit' => 20,
            'options' => [
                'page' => 1,
                'conditions' => []
            ],
            'paramType' => 'named'
        ];
        $this->Paginator->request->params['paging']['Article'] = [
            'page' => 1,
            'current' => 0,
            'count' => 40,
            'prevPage' => false,
            'nextPage' => true,
            'pageCount' => 2,
            'order' => null,
            'limit' => 20,
            'options' => [
                'page' => 1,
                'conditions' => []
            ],
            'paramType' => 'named'
        ];

        $result = $this->Paginator->pagination([
            'model' => 'Article',
            'div' => 'pagination',
            'text' => [
                'first' => 'First',
                'prev' => 'Prev',
                'next' => 'Next',
                'last' => 'Last'
            ]
        ]);

        $this->assertHtml([
            'div' => ['class' => 'pagination'],
            'ul' => ['class' => 'pagination'],
            ['li' => ['class' => 'prev disabled']],
            ['a' => ['href' => '']],
            'Prev',
            '/a',
            '/li',
            ['li' => ['class' => 'active']],
            ['span' => []],
            '1',
            ['span' => ['class' =>'sr-only']],
            '(current)',
            '/span',
            '/span',
            '/li',
            ['li' => []],
            ['a' => ['href' => '/?page=2&amp;limit=20']],
            '2',
            '/a',
            '/li',
            ['li' => ['class' => 'next']],
            ['a' => ['href' => '/?page=2&amp;limit=20', 'rel' => 'next']],
            'Next',
            '/a',
            '/li',
            '/ul',
            '/div'
        ], $result);
    }

    /**
     * testPaginationTwo
     *
     * @return void
     */
    public function testPaginationTwo()
    {
        $this->Paginator->request->params['paging']['Post'] = [
            'page' => 1,
            'current' => 0,
            'count' => 40,
            'prevPage' => false,
            'nextPage' => true,
            'pageCount' => 2,
            'order' => null,
            'limit' => 20,
            'options' => [
                'page' => 1,
                'conditions' => []
            ],
            'paramType' => 'named'
        ];

        $result = $this->Paginator->pagination([
            'model' => 'Post',
            'div' => 'pagination',
            'text' => [
                'first' => 'First',
                'prev' => 'Prev',
                'next' => 'Next',
                'last' => 'Last'
            ]
        ]);

        $this->assertHtml([
            'div' => ['class' => 'pagination'],
            'ul' => ['class' => 'pagination'],
            ['li' => ['class' => 'prev disabled']],
            ['a' => ['href' => '']],
            'Prev',
            '/a',
            '/li',
            ['li' => ['class' => 'active']],
            ['span' => []],
            '1',
            ['span' => ['class' => 'sr-only']],
            '(current)',
            '/span',
            '/span',
            '/li',
            ['li' => []],
            ['a' => ['href' => '/?page=2&amp;limit=20']],
            '2',
            '/a',
            '/li',
            ['li' => ['class' => 'next']],
            ['a' => ['href' => '/?page=2&amp;limit=20', 'rel' => 'next']],
            'Next',
            '/a',
            '/li',
            '/ul',
            '/div'
        ], $result);

        $result = $this->Paginator->pagination([
            'model' => 'Post',
            'ul' => 'pagination',
            'text' => [
                'first' => 'First',
                'prev' => 'Prev',
                'next' => 'Next',
                'last' => 'Last'
            ]
        ]);

        $this->assertHtml([
            'ul' => ['class' => 'pagination'],
            ['li' => ['class' => 'prev disabled']],
            ['a' => ['href' => '']],
            'Prev',
            '/a',
            '/li',
            ['li' => ['class' => 'active']],
            ['span' => []],
            '1',
            ['span' => ['class' => 'sr-only']],
            '(current)',
            '/span',
            '/span',
            '/li',
            ['li' => []],
            ['a' => ['href' => '/?page=2&amp;limit=20']],
            '2',
            '/a',
            '/li',
            ['li' => ['class' => 'next']],
            ['a' => ['href' => '/?page=2&amp;limit=20', 'rel' => 'next']],
            'Next',
            '/a',
            '/li',
            '/ul'
        ], $result);
    }
}
