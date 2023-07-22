<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Testlist;

class TestlistTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    // use RefreshDatabase; 
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }


    public function test_create_testlist(): void
    {
        $testlistData = [
            'make_day' => '2023-07-18',
            'test_day' => '2023-07-20',
            'age' => 2,
            'type' => '21-15-20N',
            'site' => '現場A',
            'result' => null,
            'author' => '山田 太郎',
            'editor' => null,
            'tester' => null,
            'test_editor' => null,
            'comment' => null,
        ];

        $testlist = Testlist::create($testlistData);

        $this->assertInstanceOf(Testlist::class, $testlist);
        $this->assertDatabaseHas('testlists', $testlistData);
    }



    // public function test_update_testlist(): void
    // {
    //     $testlist = Testlist::factory()->create();

    //     $updatedData = [
    //         'make_day' => '2023-07-19',
    //         'test_day' => '2023-07-21',
    //         // 更新する他の属性
    //     ];

    //     $response = $this->put('/testlists/' . $testlist->id, $updatedData);

    //     $response->assertStatus(200);

    //     $this->assertDatabaseHas('testlists', $updatedData);
    // }

    // public function test_delete_testlist(): void
    // {
    //     $testlist = Testlist::factory()->create();

    //     $response = $this->delete('/testlists/' . $testlist->id);

    //     $response->assertStatus(200);

    //     $this->assertDatabaseMissing('testlists', ['id' => $testlist->id]);
    // }

}
