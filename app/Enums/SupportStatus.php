<?php

namespace App\Enums;

enum SupportStatus: string{
    
    case A = "Active";
    case P = "Pending";
    case C = "Closed";

    public static function fromValue(string $value): string {
        foreach(self::cases() as $status){
            if($value === $status->name)
                return $status->value;
        }

        throw new \ValueError("$value is not valid");
    }

}  