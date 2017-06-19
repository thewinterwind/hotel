<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Artisan;

class InventoryRepoTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;
    
    public function setUp()
    {
        parent::setUp();

        $this->createApplication();

        $this->inventory = resolve('App\Repos\InventoryRepo');
    }

    public function tearDown()
    {
        $this->inventory = null;
    }

    /**
     * @return void
     * @test
     */
    public function find()
    {
        $room = $this->inventory->find('2016-06-01', 1);

        $this->assertSame($room['room_id'], 1);
        $this->assertSame($room['number'], '101');
        $this->assertSame($room['date'], '2016-06-01');
        $this->assertSame($room['available'], true);
        $this->assertSame($room['rate'], 200);
    }

    /**
     * @return void
     * @test
     */
    public function updateRoomOnSpecificDate()
    {
        $this->inventory->updateRoomOnSpecificDate(1, 123, '2016-06-10', false);

        $room = $this->inventory->find('2016-06-10', 1);

        $this->assertSame($room['room_id'], 1);
        $this->assertSame($room['number'], '101');
        $this->assertSame($room['date'], '2016-06-10');
        $this->assertSame($room['available'], false);
        $this->assertSame($room['rate'], 123);
    }

    /**
     * @return void
     * @test
     */
    public function multidayUpdate()
    {
        $data = [
            'from' => '2016-06-02',
            'to' => '2016-06-03',
            'room_type' => '1',
            'available' => '0',
            'rate' => '789',
            'days' => [0, 1, 2, 3, 4, 5, 6],
        ];

        $this->inventory->multidayUpdate($data);

        $room = $this->inventory->find('2016-06-02', 1);

        $this->assertSame($room['room_id'], 1); // it's a room type 1 room (single)
        $this->assertSame($room['number'], '101');
        $this->assertSame($room['date'], '2016-06-02');
        $this->assertSame($room['available'], false);
        $this->assertSame($room['rate'], 789);

        $room = $this->inventory->find('2016-06-03', 2);

        $this->assertSame($room['room_id'], 2);// it's a room type 1 room (single)
        $this->assertSame($room['number'], '102');
        $this->assertSame($room['date'], '2016-06-03');
        $this->assertSame($room['available'], false);
        $this->assertSame($room['rate'], 789);
    }

    /**
     * @return void
     * @test
     */
    public function getInventory()
    {
        $inventory = $this->inventory->getInventory();
        $room = $inventory[0];

        $this->assertCount(1839, $inventory);
        $this->assertSame($room['id'], 'date=2017-06-19&room_id=1');
        $this->assertSame($room['name'], '101 (200฿)');
        $this->assertSame($room['startdate'], '2017-06-19');
        $this->assertSame($room['enddate'], '2017-06-19');
        $this->assertSame($room['starttime'], '12:00');
        $this->assertNull($room['endtime']);
        $this->assertSame($room['color'], '#7D3C98');
    }

}
