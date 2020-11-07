<?php

namespace App;

class MockRepository implements IRepository
{
    public function save(): string
    {
        return "Mock::save method was called";
    }
}