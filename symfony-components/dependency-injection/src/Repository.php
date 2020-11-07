<?php

namespace App;

class Repository implements IRepository
{
    public function save(): string
    {
        return "Repo::save method was called";
    }
}