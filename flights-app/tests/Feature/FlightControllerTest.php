<?php

namespace Tests\Feature;

use App\Http\Controllers\FlightController;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\FlightRequestDataFactory;
use Tests\TestCase;

class FlightControllerTest extends TestCase
{

    use RefreshDatabase;
    private Flight $flight;
    private FlightRequestDataFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->flight = Flight::factory()->newRandomRoute()->create();
        $this->factory = FlightRequestDataFactory::new()->withFlight($this->flight);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index_successful_response()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_post_required_fields_missing()
    {
        $this
            ->post(action([FlightController::class, 'store']), [])
            ->assertInvalid();

        // ->assertSessionHasErrors(collect([
        //     'airline_id',
        //     'origin_city_id',
        //     'destination_city_id',
        //     'departure_at',
        //     'arrival_at'
        // ])->map(function ($field) {
        //     return $this->getRequiredErrorMessageFromField($field);
        // })->toArray());
    }

    public function test_invalid_foreign_keys()
    {
        $this
            ->post(
                action([FlightController::class, 'store']),
                $this->factory->create(['airline_id' => 165, 'origin_city_id' => 165, 'destination_city_id' => 164,])
            )
            ->assertInvalid();
    }

    public function test_invalid_dates()
    {
        $this
            ->post(
                action([FlightController::class, 'store']),
                $this->factory->create(['departure_at' => '2022-01-01 15:03:01', 'arrival_at' => '2022-01-01 15:03:01',])
            )
            ->assertInvalid();
    }

    public function test_same_cities_flight_fail()
    {
        $this
            ->post(
                action([FlightController::class, 'store']),
                $this->factory->create(['origin_city_id' => 165, 'destination_city_id' => 165,])
            )
            ->assertInvalid();
    }

    public function test_city_without_airline_fail()
    {
        $city = City::factory()->create();
        $this
            ->post(
                action([FlightController::class, 'store']),
                $this->factory->create(['origin_city_id' => $city->id,])
            )
            ->assertInvalid();
    }

    public function test_post_ok()
    {
        $this->post(
            action([FlightController::class, 'store']),
            $this->factory->create()
        )
            ->assertSuccessful();
    }

    public function test_delete_ok()
    {
        $this->delete(
            action([FlightController::class, 'delete'], $this->flight->id)
        )
            ->assertSuccessful();
    }

    public function test_delete_invalid_id()
    {
        $this->delete(
            action([FlightController::class, 'delete'], 0)
        )
            ->assertStatus(404);
    }

    public function test_update_ok()
    {
        $this->put(
            action([FlightController::class, 'update'], $this->flight->id),
            $this->factory->create(['departure_at' => '2025-01-01 15:03:01', 'arrival_at' => '2025-01-01 16:03:01'])
        )
            ->assertSuccessful();
    }

    public function test_get_flights()
    {
        $response = $this->get(
            action([FlightController::class, 'getFlights'])
        );
        $response->assertSuccessful();
        $flights = $response->decodeResponseJson()['data'];
        $this->assertCount(1, $flights);
        $this->assertEquals($this->flight->id, $flights[0]['id']);
    }

    private function getRequiredErrorMessageFromField(string $field)
    {
        $fieldName = str_replace('_', ' ', $field);
        return "The {$fieldName} field is required.";
    }
}
