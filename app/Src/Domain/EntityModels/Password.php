<?php

namespace App\Src\Domain\EntityModels;


class Password extends Entity
{
	protected int $id;
	protected string $password;
	protected int $user_id;

	public function getId(): int
	{
		return $this->id;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function getUserId(): int
	{
		return $this->user_id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setPassword(string $password): void
	{
		$this->password = $password;
	}

	public function setUserId(int $user_id): void
	{
		$this->user_id = $user_id;
	}
}
