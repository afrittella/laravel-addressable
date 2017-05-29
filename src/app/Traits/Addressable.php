<?php
namespace Afrittella\LaravelAddressable\Traits;


use Illuminate\Database\Eloquent\Model;

trait Addressable
{
    protected $types;

    public function addresses()
    {
        return $this->morphMany(config('laravel-addressable.tables.addresses'), 'addressable');
    }

    public function address($type, $address = null)
    {
        $types = config('laravel-addressable.types');

        // You can add only types specified in configuration file
        if (!in_array($type, $types)) {
            return false;
        }

        if (is_array($address)) {
            $address = $this->addresses()->create($address);
        }

        if ($address instanceof Model) {
            $address->type($type);
        }

        return $this->addresses()->whereType($type)->first();
    }

    public function hasAddresses()
    {
        return (count($this->addresses->toArray()) > 0);
    }

    public function hasAddressOfType($type)
    {
        return (!empty($this->address($type)));
    }
}