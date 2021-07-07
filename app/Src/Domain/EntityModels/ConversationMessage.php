<?php

namespace App\Src\Domain\EntityModels;


class ConversationMessage extends Entity
{
	protected int $id;
	protected int $customer_id;
	protected int $conversation_id;
	protected string $message;

	public function getId(): int
	{
		return $this->id;
	}

	public function getCustomerId(): int
	{
		return $this->customer_id;
	}

	public function getConversationId(): int
	{
		return $this->conversation_id;
	}

	public function getMessage(): string
	{
		return $this->message;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setCustomerId(int $customer_id): void
	{
		$this->customer_id = $customer_id;
	}

	public function setConversationId(int $conversation_id): void
	{
		$this->conversation_id = $conversation_id;
	}

	public function setMessage(string $message): void
	{
		$this->message = $message;
	}
}
