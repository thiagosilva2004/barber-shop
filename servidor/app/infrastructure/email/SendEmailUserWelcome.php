<?php

interface SendEmailUserWelcome
{
    public function execute(string $name, string $email);
}
