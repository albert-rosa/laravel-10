<?php

namespace App\DTO\Supports;

use App\Http\Requests\StoreUpdateSupport;

class CreateSupportDTO{
    public function __construct(
        public string $subject,
        public string $status,
        public string $body
    ){}

    public static function makeFromRequest(StoreUpdateSupport $request): self{
        return new CreateSupportDTO(
            $request->subject,
            'a',
            $request->body
        );
    }
}