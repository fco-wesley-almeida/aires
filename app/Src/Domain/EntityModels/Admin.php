<?php

namespace App\Src\Domain\EntityModels;


class Admin extends Entity
{
	protected int $id;
	protected int $user_id;

	public function getId(): int
	{
		return $this->id;
	}

	public function getUserId(): int
	{
		return $this->user_id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setUserId(int $user_id): void
	{
		$this->user_id = $user_id;
	}
}
