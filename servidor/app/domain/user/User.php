<?php

namespace App\domain\user;

use App\domain\user\exception\EmailNotVerifyException;
use App\domain\user\exception\LoginInvalidException;
use App\domain\user\exception\UserCodeVerificationIsDifferent;
use App\domain\user\exception\UserEmailAlreadyVerify;
use App\domain\user\valueObject\codeVerification\CodeVerification;
use App\domain\user\valueObject\email\Email;
use App\domain\user\valueObject\name\Name;
use App\domain\user\valueObject\password\Password;
use App\domain\user\valueObject\uuid\Uuid;
use DateTime;

class User
{
    public function __construct(
        private readonly Uuid $id,
        private Name $name,
        private Email $email,
        private Password $password,
        private ?DateTime $email_verified_at,
        private ?CodeVerification $codeVerification,
        private readonly DateTime $created_at,
    ){}

    public function verifyEmail(string $code):void
    {
        if (!is_null($this->getEmailVerifiedAt())){
            throw new UserEmailAlreadyVerify;
        }

        if ($this->getCodeVerification()?->getValue() !== $code){
            throw new UserCodeVerificationIsDifferent;
        }

        $this->setCodeVerification(null);
        $this->setEmailVerifiedAt(new DateTime);
    }

    public function login(string $password):void
    {
        if (is_null($this->getEmailVerifiedAt())){
            throw new EmailNotVerifyException();
        }

        if (!$this->getPassword()->compare($password)){
            throw new LoginInvalidException();
        }
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function setPassword(Password $password): void
    {
        $this->password = $password;
    }

    public function getEmailVerifiedAt(): ?DateTime
    {
        return $this->email_verified_at;
    }

    public function setEmailVerifiedAt(?DateTime $email_verified_at): void
    {
        $this->email_verified_at = $email_verified_at;
    }

    public function getCodeVerification(): ?CodeVerification
    {
        return $this->codeVerification;
    }

    public function setCodeVerification(?CodeVerification $codeVerification): void
    {
        $this->codeVerification = $codeVerification;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
}
