<?php

namespace App\Src\Domain\EntityModels;


class Friend extends Entity
{
	protected int $id;
	protected int $customer_id;
	protected int $friendship_id;

	public function getId(): int
	{
		return $this->id;
	}

	public function getCustomerId(): int
	{
		return $this->customer_id;
	}

	public function getFriendshipId(): int
	{
		return $this->friendship_id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setCustomerId(int $customer_id): void
	{
		$this->customer_id = $customer_id;
	}

	public function setFriendshipId(int $friendship_id): void
	{
		$this->friendship_id = $friendship_id;
	}
}
