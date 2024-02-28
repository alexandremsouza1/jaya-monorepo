<?php


namespace App\Dto;

interface DtoInterface
{
    /**
     * @param array $payload
     * @return array
     */
    public function build(array $payload): array;
    /**
     * @param Model $payload
     * @return array
     */
    public function transform($payload): array;
}
