<?php

namespace Tests\Feature;
use App\Models\Historial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Factories\HistorialFactory;
use Tests\TestCase;

class ControllerWheatherTest extends TestCase
{

    public function testfindhistoric()
    {

        $historial = Historial::factory()->create([]);

        $response = $this->get('api/search-historic/miami');
        $response->assertStatus(200);
        $responseData = $response->json();

        $this->assertCount(1, $responseData);
        $this->assertArrayHasKey('state', $responseData[0]);
        $this->assertArrayHasKey('country', $responseData[0]);
        $this->assertArrayHasKey('info', $responseData[0]);


        $this->assertEquals('Miami', $responseData[0]['state']);
        $this->assertEquals('US', $responseData[0]['country']);

        $this->assertArrayHasKey('id', $responseData[0]['info'][0]);
        $this->assertArrayHasKey('lat', $responseData[0]['info'][0]);
        $this->assertArrayHasKey('lon', $responseData[0]['info'][0]);
        $this->assertArrayHasKey('humidity', $responseData[0]['info'][0]);
        $this->assertArrayHasKey('created_at', $responseData[0]['info'][0]);
    }

    public function testcreatehistory()
    {
        $historial = new Historial();
        $historial->lat = 12.4523236;
        $historial->lon = 78.012342;
        $historial->humidity = 50;
        $historial->country = 'Orlando';
        $historial->state = 'US';

        $result = $historial->save();

        $this->assertTrue($result);

    }
}
