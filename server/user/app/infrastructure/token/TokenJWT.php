<?php

namespace app\infrastructure\token;

use DateTimeImmutable;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\UnencryptedToken;
use Throwable;

class TokenJWT implements Token
{
    private string $iss;
    private string $key;
    private ?UnencryptedToken $token = null;

    public function __construct()
    {
        $this->iss = $_ENV['APP_URL'];
        $this->key = $_ENV['JWT_SECRET'];
    }

    public function generate(string $aud, string $user_id): string
    {
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $algorithm = new Sha256();
        $signingKey = InMemory::plainText($this->key);

        $now = new DateTimeImmutable();
        $this->token = $tokenBuilder
            ->issuedBy($this->iss)
            ->permittedFor($aud)
            ->withClaim('user_id', $user_id)
            ->issuedAt($now)
            ->expiresAt($now->modify('+24 hour'))
            ->getToken($algorithm, $signingKey);

        return $this->token->toString();
    }

    public function loadFromString(string $token): void
    {
        try {
            $parser = new Parser(new JoseEncoder());
            $this->token = $parser->parse($token);

            if (empty($this->token->claims()->get('user_id'))) {
                throw new TokenInvalidException();
            }
        } catch (Throwable $exception) {
            throw new TokenInvalidException();
        }
    }

    public function getUserID(): string
    {
        return $this->token?->claims()->get('user_id');
    }
}
