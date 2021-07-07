<?php

namespace App\Src\Domain\EntityModels;


class GroupParticipant extends Entity
{
	protected int $id;
	protected int $customer_id;
	protected int $group_id;

	public function getId(): int
	{
		return $this->id;
	}

	public function getCustomerId(): int
	{
		return $this->customer_id;
	}

	public function getGroupId(): int
	{
		return $this->group_id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setCustomerId(int $customer_id): void
	{
		$this->customer_id = $customer_id;
	}

	public function setGroupId(int $group_id): void
	{
		$this->group_id = $group_id;
	}
}
