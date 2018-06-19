<?php

namespace KTS\Traits;

trait UserTrait
{
    private function me()
    {
        return auth()->user();
    }    

    private function errorMessage()
    {
        return ['type' => 'danger',  'message' => 'Something went wrong. Please contact admin.'];
    } 
}