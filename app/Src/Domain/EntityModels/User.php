<?php

namespace App\Src\Domain\EntityModels;


class User extends Entity
{
	protected int $id;
	protected string $email;
	protected string $nickname;

	public function getId(): int
	{
		return $this->id;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function getNickname(): string
	{
		return $this->nickname;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	public function setNickname(string $nickname): void
	{
		$this->nickname = $nickname;
	}
}
