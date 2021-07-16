<?php


namespace App\Src\Business\Validations;


class UserCreateValidation extends Validation
{
    protected function getPersistenceRules(): array
    {
        return [
            'email_iudex'    => ['email' => 'This email already exists.'],
            'nickname_iudex' => ['nickname' => 'This nickname already exists.'],
        ];
    }

    protected function validations(): array
    {
        return [
            'nickname'  => [$this->isRequired(), $this->isNotEmpty()],
            'email'     => [$this->isRequired(), $this->isNotEmpty(), $this->isEmail()],
            'name'      => [$this->isRequired(), $this->isNotEmpty()],
            'alias'     => [$this->isRequired(), $this->isNotEmpty()],
            'password'  => [$this->isRequired(), $this->isNotEmpty()],
            'birthDate' => [$this->isRequired(), $this->isValidDate()]
        ];
    }
}
