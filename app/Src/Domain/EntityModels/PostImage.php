<?php

namespace App\Src\Domain\EntityModels;


class PostImage extends Entity
{
	protected int $id;
	protected int $post_id;
	protected string $path;

	public function getId(): int
	{
		return $this->id;
	}

	public function getPostId(): int
	{
		return $this->post_id;
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setPostId(int $post_id): void
	{
		$this->post_id = $post_id;
	}

	public function setPath(string $path): void
	{
		$this->path = $path;
	}
}
