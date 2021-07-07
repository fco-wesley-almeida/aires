<?php

namespace App\Src\Domain\EntityModels;


class FriendshipInvitation extends Entity
{
	protected int $id;
	protected int $requester_customer_id;
	protected int $target_customer_id;
	protected int $accepted;

	public function getId(): int
	{
		return $this->id;
	}

	public function getRequesterCustomerId(): int
	{
		return $this->requester_customer_id;
	}

	public function getTargetCustomerId(): int
	{
		return $this->target_customer_id;
	}

	public function getAccepted(): int
	{
		return $this->accepted;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setRequesterCustomerId(int $requester_customer_id): void
	{
		$this->requester_customer_id = $requester_customer_id;
	}

	public function setTargetCustomerId(int $target_customer_id): void
	{
		$this->target_customer_id = $target_customer_id;
	}

	public function setAccepted(int $accepted): void
	{
		$this->accepted = $accepted;
	}
}
