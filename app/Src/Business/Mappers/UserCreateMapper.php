<?php


namespace App\Src\Business\Mappers;


use App\Src\Domain\EloquentModels\Customer;
use App\Src\Domain\EloquentModels\Password;
use App\Src\Domain\EloquentModels\Person;
use App\Src\Domain\EloquentModels\User;
use App\Src\Domain\RequestModels\UserCreateRequestModel;
use Mockery\Generator\StringManipulation\Pass\Pass;

class UserCreateMapper extends Mapper
{
    private UserCreateRequestModel $userRequest;
    private User $user;
    private Customer $customer;
    private Password $password;
    private Person $person;
    /**
     * @var Person[]
     */

    public function __construct(UserCreateRequestModel $userRequest)
    {
        $this->userRequest = $userRequest;
        $this->user = new User();
        $this->customer = new Customer();
        $this->password = new Password();
        $this->person = new Person();
    }

    public function getUser(): User
    {
        $this->user->email = $this->userRequest->getEmail();
        $this->user->nickname = $this->userRequest->getNickname();
        $this->user->customers = [$this->getCustomer()];
        $this->user->person = $this->getPerson();
        $this->user->passwords = [$this->getPassword()];
        return $this->user;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getPerson(): Person
    {
        $this->person->alias = $this->userRequest->getAlias();
        $this->person->name = $this->userRequest->getName();
        $this->person->birth_date = $this->userRequest->getBirthDate();
        return $this->person;
    }

    public function getPassword(): Password
    {
        $this->password->password = $this->userRequest->getPassword();
        return $this->password;
    }
}
