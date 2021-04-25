<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once 'full_path\source\src/interfaces/ValidationRuleInterface.php';
require_once 'full_path\source\src/Validation.php';
require_once 'full_path\source\src/validationRules/ValidateEmail.php';

final class ValidationTest extends TestCase
{
    public function testValidationEmail(): void
    {
        $validationClass = new Validation();
        $validationClass->addRule(new ValidateEmail());
        
        $this->assertFalse($validationClass->validate('t123123'));
        $this->assertTrue($validationClass->validate('test@email.com'));
        
    }

}
