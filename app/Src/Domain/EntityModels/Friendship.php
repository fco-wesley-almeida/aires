<?php

namespace App\Src\Domain\EntityModels;


class Friendship extends Entity
{
	protected int $id;

	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}
}
