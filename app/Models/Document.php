<?php

namespace App\Models;

class Document
{
    protected $id;
	protected $path;

    public function __construct(array $data = [])
	{
		if (!empty($data)) {
			$this->id = $data['id'] ?? null;
			$this->path = $data['path'] ?? '';
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

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }
}
