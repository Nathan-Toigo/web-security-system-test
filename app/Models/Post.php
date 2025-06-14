<?php

namespace App\Models;

class Post
{
    protected $id;
	protected $creator;
    protected $title;
    protected $content;
    protected $created_at;

    public function __construct(array $data = [])
	{
		if (!empty($data)) {
			$this->id = $data['id'] ?? null;
			$this->creator = new User($data);
			$this->title = $data['title'] ?? '';
			$this->content = $data['content'] ?? '';
			$this->created_at = $data['created_at'] ?? '';
		}
	}

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCreator() : User
    {
        return $this->creator;
    }

    public function setCreator(User $creator)
    {
        $this->creator = $creator;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
}
