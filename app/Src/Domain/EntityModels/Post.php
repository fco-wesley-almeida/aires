<?php

namespace App\Src\Domain\EntityModels;


class Post extends Entity
{
	protected int $id;
	protected int $author_customer_id;
	protected string $register_date;
	protected int $likes;

	public function getId(): int
	{
		return $this->id;
	}

	public function getAuthorCustomerId(): int
	{
		return $this->author_customer_id;
	}

	public function getRegisterDate(): string
	{
		return $this->register_date;
	}

	public function getLikes(): int
	{
		return $this->likes;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setAuthorCustomerId(int $author_customer_id): void
	{
		$this->author_customer_id = $author_customer_id;
	}

	public function setRegisterDate(string $register_date): void
	{
		$this->register_date = $register_date;
	}

	public function setLikes(int $likes): void
	{
		$this->likes = $likes;
	}
}
