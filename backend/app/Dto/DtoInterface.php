<?php


namespace App\Dto;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface DtoInterface
{
    /**
     * @param array $payload
     * @return array
     */
    public function build(array $payload): array;
    /**
     * @param Collection $payload
     * @return array
     */
    public function transform(Collection $payload): array;
}
