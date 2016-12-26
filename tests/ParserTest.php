<?php
use PHPUnit\Framework\TestCase;
use PackageFactory\JsxParser\Parser;

class ParserTest extends TestCase
{
	/**
	 * @test
	 */
	public function shouldParseSingleSelfClosingTag()
	{
		$parser = new Parser('<div/>');
		$this->assertEquals([
			'identifier' => 'div',
			'props' => [],
			'children' => []
		], $parser->parse());
	}

	/**
	 * @test
	 */
	public function shouldParseSingleSelfClosingTagWithSingleAttribute()
	{
		$parser = new Parser('<div prop="value"/>');
		$this->assertEquals([
			'identifier' => 'div',
			'props' => [
				'prop' => [
					'type' => 'string',
					'payload' => 'value'
				]
			],
			'children' => []
		], $parser->parse());
	}

	/**
	 * @test
	 */
	public function shouldParseSingleSelfClosingTagWithMultipleAttributes()
	{
		$parser = new Parser('<div prop="value" anotherProp="Another Value"/>');
		$this->assertEquals([
			'identifier' => 'div',
			'props' => [
				'prop' => [
					'type' => 'string',
					'payload' => 'value'
				],
				'anotherProp' => [
					'type' => 'string',
					'payload' => 'Another Value'
				]
			],
			'children' => []
		], $parser->parse());
	}
}