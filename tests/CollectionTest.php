<?php

use Mehedi\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    /**
     * @test
     */
    function check_class_has_items_variable()
    {
        $this->assertClassHasAttribute('items', Collection::class);
    }

    /**
     * @test
     */
    function is_this_class_countable()
    {
        $this->assertTrue(new Collection() instanceof IteratorAggregate);
    }

    /**
     * @test
     */
    function it_count_items()
    {
        $c = new Collection([1, 2, 3]);

        $this->assertCount(3, $c);
    }

    /**
     * @test
     */
    function it_can_iterate()
    {
        $this->assertIsIterable(new Collection());
    }

    /**
     * @test
     */
    function it_can_filter_data()
    {
        $c = new Collection([1, 2, 3, 4]);

        $c->filter(function ($number){
            return $number == 2;
        });

        $this->assertEquals([2], $c->all());
    }

    /**
     * @test
     */
    function it_can_add_data()
    {
        $c = new Collection([1, 2]);

        $c->push(3);

        $this->assertEquals([1, 2, 3], $c->all());
    }

    /**
     * @test
     */
    function it_can_remove_last_item_and_returned_it()
    {
        $c = new Collection([1, 2, 3]);

        $this->assertEquals(3, $c->pop());

        $this->assertEquals([1, 2], $c->all());
    }

    /**
     * @test
     */
    function it_can_merge_new_array()
    {
        $c = new Collection([2, 3]);

        $c->merge([4, 5]);

        $this->assertEquals([2, 3, 4, 5], $c->all());
    }

    /**
     * @test
     */
    function it_can_merge_collection_instance()
    {
        $cOne = new Collection([2, 3]);

        $cTwo = new Collection([4, 5]);

        $cOne->merge($cTwo);

        $this->assertEquals([2, 3, 4, 5], $cOne->all());
    }

    /**
     * @test
     */
    function it_return_json_format()
    {
        $cOne = new Collection([2, 3]);

        $this->assertJson($cOne->toJSON());
    }

}
