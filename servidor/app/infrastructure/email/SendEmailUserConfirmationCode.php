<?php

interface SendEmailUserConfirmationCode
{
    public function execute(string $code);
}
