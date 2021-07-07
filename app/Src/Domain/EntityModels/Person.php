<?php

namespace App\Src\Domain\EntityModels;


class Person extends Entity
{
	protected int $id;
	protected int $user_id;
	protected string $name;
	protected string $alias;
	protected string $birth_date;

	public function getId(): int
	{
		return $this->id;
	}

	public function getUserId(): int
	{
		return $this->user_id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getAlias(): string
	{
		return $this->alias;
	}

	public function getBirthDate(): string
	{
		return $this->birth_date;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setUserId(int $user_id): void
	{
		$this->user_id = $user_id;
	}

	public function setName(string $name): void
	{
		$this->name = $name;
	}

	public function setAlias(string $alias): void
	{
		$this->alias = $alias;
	}

	public function setBirthDate(string $birth_date): void
	{
		$this->birth_date = $birth_date;
	}
}
