<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class ListTest extends TraktTestCase{

	public $json;

	public function setup(){
		parent::setUp();
		$this->json = '{
					"username": "'.$this->s->get('trakt.username').'",
					"password": "'.$this->s->get('trakt.password').'",
					"slug": "top-10-of-2013",
					"items": [
						{
							"type": "movie",
							"imdb_id": "tt0372784",
							"title": "Batman Begins",
							"year": 2005
						},
						{
							"type": "show",
							"tvdb_id": "80337",
							"title": "Mad Men"
						},
						{
							"type": "season",
							"tvdb_id": "80337",
							"title": "Mad Men",
							"season": 1
						},
						{
							"type": "episode",
							"tvdb_id": "80337",
							"title": "Mad Men",
							"season": 1,
							"episode": 5
						}
					]
				}';
	}

	public function tearDown(){
		unset($this->json);
	}

	public function testListAdd(){
		$params = array(
				"username"=>$this->s->get('trakt.username')
				,"password"=> sha1($this->s->get('trakt.password'))
				,"name"=>"Top 10 of 2013"
				,"description"=>"These movies and shows really defined 2013 for me."
				,"privacy"=>"public"
				,"show_numbers"=>true
				,"allow_shouts"=>true
			);
		$res = Trakt::post('lists/add')->setParams($params)->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
		$this->assertEquals('Top 10 of 2013', $res['name']);
	}
	public function testListAddItems(){
		$res = Trakt::post('lists/items/add')->setParams($this->json)->run();
		$this->assertEquals(4, $res['inserted']);

	}

	public function testListsDeleteItems(){
		$res = Trakt::post('lists/items/delete')->setParams($this->json)->run();
		$this->assertEquals("4 items deleted", $res['message']);
	}

	public function testListsUpdate(){
		$params = array(
				"username"=>$this->s->get('trakt.username')
				,"password"=>$this->s->get('trakt.password')
				,"slug"=>"top-10-of-2013"
				,"name"=>"Top 20 of 2013"
				,"description"=>"These movies and shows really defined 2013 for me."
				,"privacy"=>"public"
				,"show_numbers"=>true
				,"allow_shouts"=>true
			);
		$res = Trakt::post('lists/update')->setParams($params)->run();
		$this->assertEquals('Top 20 of 2013', $res['name']);
	}
	public function testListDelete(){
		$params = array(
				"username"=>$this->s->get('trakt.username')
				,"password"=>$this->s->get('trakt.password')
				,"slug"=>"top-20-of-2013");
		$res = Trakt::post('lists/delete')->setParams($params)->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
		$this->assertContains('deleted', $res['message']);
	}
}
