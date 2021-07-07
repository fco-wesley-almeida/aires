<?php

namespace App\Src\Domain\EntityModels;


class PostComment extends Entity
{
	protected int $id;
	protected int $post_id;
	protected int $customer_id;
	protected string $text;
	protected int $likes;

	public function getId(): int
	{
		return $this->id;
	}

	public function getPostId(): int
	{
		return $this->post_id;
	}

	public function getCustomerId(): int
	{
		return $this->customer_id;
	}

	public function getText(): string
	{
		return $this->text;
	}

	public function getLikes(): int
	{
		return $this->likes;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setPostId(int $post_id): void
	{
		$this->post_id = $post_id;
	}

	public function setCustomerId(int $customer_id): void
	{
		$this->customer_id = $customer_id;
	}

	public function setText(string $text): void
	{
		$this->text = $text;
	}

	public function setLikes(int $likes): void
	{
		$this->likes = $likes;
	}
}
