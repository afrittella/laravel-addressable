<?php
namespace Tests\Unit;

use Afrittella\LaravelAddressable\Http\Requests\AddressStore;
use Tests\TestCaseNoDb;

class AddressAddRequestTest extends TestCaseNoDb
{
    protected $rules;
    protected $validator;

    public function setUp()
    {
        parent::setUp();

        $this->rules = (new AddressStore())->rules();
        $this->validator = $this->app['validator'];
    }

    public function testType() {
        $this->assertTrue($this->validateField('type', 'billing'));
        $this->assertFalse($this->validateField('type', 'test'));
    }

    public function testOrganization()
    {
        $this->assertFalse($this->validateField('organization', ['test', 'test2']));
        $this->assertTrue($this->validateField('organization', ''));
        $this->assertTrue($this->validateField('organization', 'Org'));
    }

    public function testName()
    {
        // Can't test because is not a real life example
        /*$this->assertFalse($this->validateFields(
            [
                'first_name' => 'andrea'
            ]
        ));

        $this->assertFalse($this->validateFields(
           [
               'last_name' => 'frittella'
           ]
        ));

        $this->assertTrue($this->validateFields(
            [
                'first_name' => null,
                'last_name' => null
            ]
        ));*/

        $this->assertFalse($this->validateFields(
           [
               'first_name' => 'john',
               'last_name' => ''
           ]
        ));

        $this->assertFalse($this->validateFields(
            [
                'first_name' => '',
                'last_name' => 'doe'
            ]
        ));

        $this->assertTrue($this->validateFields(
            [
                'first_name' => 'john',
                'last_name' => 'doe'
            ]
        ));
    }

    public function testStreet()
    {
        $this->assertFalse($this->validateField('street', ''));
        $this->assertTrue($this->validateField('street', 'street test'));
    }

    public function testCity()
    {
        $this->assertFalse($this->validateField('city', ''));
        $this->assertTrue($this->validateField('city', 'Springfield'));
    }

    public function testState()
    {
        $this->assertFalse($this->validateField('state', ''));
        $this->assertTrue($this->validateField('state', 'AQ'));
    }

    public function testCountry()
    {
        $this->assertFalse($this->validateField('country', ''));
        $this->assertFalse($this->validateField('country', 'Italysss'));
        $this->assertTrue($this->validateField('country', 'Italy'));
    }

    public function testCountryCode()
    {
        $this->assertFalse($this->validateField('country_code', 'ITU'));
        $this->assertTrue($this->validateField('country_code', 'ITA'));
    }

    public function testPostcode()
    {
        $this->assertFalse($this->validateField('postcode', ''));
        $this->assertTrue($this->validateField('postcode', '123456'));
        $this->assertFalse($this->validateField('postcode', '1234567890123'));
    }

    public function testLatLng()
    {
        $this->assertFalse($this->validateField('lat', 'foo'));
        $this->assertFalse($this->validateField('lng', 'foo'));

        $this->assertFalse($this->validateField('lat', -91.0));
        $this->assertFalse($this->validateField('lng', 181.0));

        $this->assertTrue($this->validateField('lat', 43.234));
        $this->assertTrue($this->validateField('lng', 40.203));
    }

    /*** Utility functions ***/

    protected function getFieldValidator($field, $value)
    {
        return $this->validator->make(
            [$field => $value],
            [$field => $this->rules[$field]]
        );
    }

    protected function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }

    protected function validateFields($fields)
    {

        foreach ($fields as $field => $value) {

            $rules[$field] = $this->rules[$field];
        }

        return $this->validator->make(
            $fields,
            $rules
        )->passes();
    }
}