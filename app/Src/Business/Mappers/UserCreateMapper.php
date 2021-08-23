<?php


namespace App\Src\Business\Mappers;


use App\Src\Business\Mappers\Interfaces\IUserCreateMapper;
use App\Src\Domain\EloquentModels\Customer;
use App\Src\Domain\EloquentModels\Password;
use App\Src\Domain\EloquentModels\Person;
use App\Src\Domain\EloquentModels\User;
use App\Src\Domain\RequestModels\UserCreateRequestModel;

/**
 * Class UserCreateMapper
 * @package App\Src\Business\Mappers
 */
class UserCreateMapper extends Mapper implements IUserCreateMapper
{
    /**
     * @var UserCreateRequestModel
     */
    private UserCreateRequestModel $baseMapping;
    /**
     * @var User
     */
    private User $user;
    /**
     * @var Customer
     */
    private Customer $customer;
    /**
     * @var Password
     */
    private Password $password;
    /**
     * @var Person
     */
    private Person $person;

    /**
     * UserCreateMapper constructor.
     */
    public function __construct()
    {
        $this->user = new User();
        $this->customer = new Customer();
        $this->password = new Password();
        $this->person = new Person();
    }

    public function setBaseMapping(UserCreateRequestModel $user)
    {
        $this->baseMapping = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        $this->user->email = $this->baseMapping->getEmail();
        $this->user->nickname = $this->baseMapping->getNickname();
        $this->user->customers = [$this->getCustomer()];
        $this->user->person = $this->getPerson();
        $this->user->passwords = [$this->getPassword()];
        return $this->user;
    }

    /**
     * @return Customer
     */
    private function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return Person
     */
    private function getPerson(): Person
    {
        $this->person->alias = $this->baseMapping->getAlias();
        $this->person->name = $this->baseMapping->getName();
        $this->person->birth_date = $this->baseMapping->getBirthDate();
        return $this->person;
    }

    /**
     * @return Password
     */
    private function getPassword(): Password
    {
        $this->password->password = $this->baseMapping->getPassword();
        return $this->password;
    }
}
