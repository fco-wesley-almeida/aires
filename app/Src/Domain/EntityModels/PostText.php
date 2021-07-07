<?php

namespace App\Src\Domain\EntityModels;


class PostText extends Entity
{
	protected int $id;
	protected int $post_id;
	protected string $text;

	public function getId(): int
	{
		return $this->id;
	}

	public function getPostId(): int
	{
		return $this->post_id;
	}

	public function getText(): string
	{
		return $this->text;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setPostId(int $post_id): void
	{
		$this->post_id = $post_id;
	}

	public function setText(string $text): void
	{
		$this->text = $text;
	}
}
