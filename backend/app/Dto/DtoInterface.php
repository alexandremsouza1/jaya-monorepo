<?php


namespace App\Dto;

interface DtoInterface
{
    public function build($payload) : array;
}