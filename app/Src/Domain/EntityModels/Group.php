<?php

namespace App\Src\Domain\EntityModels;


class Group extends Entity
{
	protected int $id;
	protected string $name;

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setName(string $name): void
	{
		$this->name = $name;
	}
}
