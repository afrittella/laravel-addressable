<?php
namespace Afrittella\LaravelAddressable\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function addressable()
    {
        return $this->morphTo();
    }


    public function type(string $type)
    {
        // You can add only types specified in configuration file
        if (!in_array($type, $types)) {
            return false;
        }

        return $this->update(compact($type));
    }
}