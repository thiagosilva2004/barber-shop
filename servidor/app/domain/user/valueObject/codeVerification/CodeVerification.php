<?php

namespace App\domain\user\valueObject\codeVerification;

class CodeVerification
{
    private function __construct(
        private string $code
    ){}


    public static function create(string $code):CodeVerification
    {
        if (empty($code)){
            return self::generate();
        }

        if (!self::isValid($code)){
            throw new CodeVerificationInvalidException;
        }

        return new CodeVerification($code);
    }

    public static function generate():CodeVerification
    {
        return new CodeVerification(self::generateCode());
    }

    private static function generateCode():string
    {
        $code = '';
        for ($i=1; $i <= 6;$i++){
            $code .= random_int(0,9);
        }

        return $code;
    }

    private static function isValid(string $code):bool
    {
        return strlen($code) === 6 && is_numeric($code);
    }

    public function getValue():string
    {
        return $this->code;
    }
}
