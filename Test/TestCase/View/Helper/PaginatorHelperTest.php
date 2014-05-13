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
class PaginatorHelperTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$View = new View();
		$this->Paginator = new PaginatorHelper($View);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Paginator);

		parent::tearDown();
	}

/**
 * testPaginationEmpty
 *
 * @return void
 */
	public function testPaginationEmpty() {
		$this->Paginator->request->params['paging']['Post'] = array(
			'page' => 1,
			'current' => 0,
			'count' => 0,
			'prevPage' => false,
			'nextPage' => false,
			'pageCount' => 1,
			'order' => null,
			'limit' => 20,
			'options' => array(
				'page' => 1,
				'conditions' => array()
			),
			'paramType' => 'named'
		);
		$numbers = $this->Paginator->pagination(array('model' => 'Post'));
		$this->assertSame('', $numbers);
	}

/**
 * testPaginationTwoModel
 *
 * @return void
 */
	public function testPaginationTwoModel() {
		$this->Paginator->request->params['paging']['Post'] = array(
			'page' => 1,
			'current' => 0,
			'count' => 0,
			'prevPage' => false,
			'nextPage' => false,
			'pageCount' => 1,
			'order' => null,
			'limit' => 20,
			'options' => array(
				'page' => 1,
				'conditions' => array()
			),
			'paramType' => 'named'
		);
		$this->Paginator->request->params['paging']['Article'] = array(
			'page' => 1,
			'current' => 0,
			'count' => 40,
			'prevPage' => false,
			'nextPage' => true,
			'pageCount' => 2,
			'order' => null,
			'limit' => 20,
			'options' => array(
				'page' => 1,
				'conditions' => array()
			),
			'paramType' => 'named'
		);

		$result = $this->Paginator->pagination(array(
			'model' => 'Article',
			'div' => 'pagination',
			'text' => array(
				'first' => 'First',
				'prev' => 'Prev',
				'next' => 'Next',
				'last' => 'Last'
			)
		));

		$this->assertTags($result, array(
			'div' => array('class' => 'pagination'),
			'ul' => array('class' => 'pagination'),
			array('li' => array('class' => 'prev disabled')),
			array('span' => array()),
			'Prev',
			'/span',
			'/li',
			array('li' => array('class' => 'active')),
			array('span' => array()),
			'1',
			'/span',
			'/li',
			array('li' => array()),
			array('a' => array('href' => '/?page=2&amp;limit=20')),
			'2',
			'/a',
			'/li',
			array('li' => array('class' => 'next')),
			array('a' => array('href' => '/?page=2&amp;limit=20', 'rel' => 'next')),
			'Next',
			'/a',
			'/li',
			'/ul',
			'/div'
		));
	}

/**
 * testPaginationTwo
 *
 * @return void
 */
	public function testPaginationTwo() {
		$this->Paginator->request->params['paging']['Post'] = array(
			'page' => 1,
			'current' => 0,
			'count' => 40,
			'prevPage' => false,
			'nextPage' => true,
			'pageCount' => 2,
			'order' => null,
			'limit' => 20,
			'options' => array(
				'page' => 1,
				'conditions' => array()
			),
			'paramType' => 'named'
		);

		$result = $this->Paginator->pagination(array(
			'model' => 'Post',
			'div' => 'pagination',
			'text' => array(
				'first' => 'First',
				'prev' => 'Prev',
				'next' => 'Next',
				'last' => 'Last'
			)
		));

		$this->assertTags($result, array(
			'div' => array('class' => 'pagination'),
			'ul' => array('class' => 'pagination'),
			array('li' => array('class' => 'prev disabled')),
			array('span' => array()),
			'Prev',
			'/span',
			'/li',
			array('li' => array('class' => 'active')),
			array('span' => array()),
			'1',
			'/span',
			'/li',
			array('li' => array()),
			array('a' => array('href' => '/?page=2&amp;limit=20')),
			'2',
			'/a',
			'/li',
			array('li' => array('class' => 'next')),
			array('a' => array('href' => '/?page=2&amp;limit=20', 'rel' => 'next')),
			'Next',
			'/a',
			'/li',
			'/ul',
			'/div'
		));

		$result = $this->Paginator->pagination(array(
			'model' => 'Post',
			'ul' => 'pagination',
			'text' => array(
				'first' => 'First',
				'prev' => 'Prev',
				'next' => 'Next',
				'last' => 'Last'
			)
		));

		$this->assertTags($result, array(
			'ul' => array('class' => 'pagination'),
			array('li' => array('class' => 'prev disabled')),
			array('span' => array()),
			'Prev',
			'/span',
			'/li',
			array('li' => array('class' => 'active')),
			array('span' => array()),
			'1',
			'/span',
			'/li',
			array('li' => array()),
			array('a' => array('href' => '/?page=2&amp;limit=20')),
			'2',
			'/a',
			'/li',
			array('li' => array('class' => 'next')),
			array('a' => array('href' => '/?page=2&amp;limit=20', 'rel' => 'next')),
			'Next',
			'/a',
			'/li',
			'/ul'
		));
	}
}
