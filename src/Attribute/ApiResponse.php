<?php

namespace App\Attribute;

use Attribute;
use Symfony\Component\HttpFoundation\Response;

#[Attribute(Attribute::TARGET_METHOD)]
class ApiResponse
{
    public function __construct(
        public int $status = Response::HTTP_CREATED
    ) {}
}
