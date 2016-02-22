<?php

namespace selftotten\Policies;


trait AdminOverride
{
    protected function checkIfEitherManagerOrAdmin()
    {
        if ($this->ifAdmin()) {
            return true;
        }
        if ($this->ifManager()) {
            return true;
        }

    }

    public function ifAdmin()
    {
        return auth()->user()->hasRole('admin');
    }

    public function ifManager()
    {
        return auth()->user()->hasRole('manager');
    }
}