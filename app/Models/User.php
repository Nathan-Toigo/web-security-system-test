<?php 
namespace App\Models;

class User
{
	protected $id;
	protected $firstname;
	protected $lastname;
	protected $email;
	protected $password;
	protected $address;

	public function __construct(array $data = [])
	{
		if (!empty($data)) {
			$this->id = $data['id'] ?? null;
			$this->firstname = $data['firstname'] ?? '';
			$this->lastname = $data['lastname'] ?? '';
			$this->email = $data['email'] ?? '';
			$this->password = $data['password'] ?? '';
			$this->address = $data['address'] ?? '';
		}
	}

	
	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	public function getFirstName()
	{
		return $this->firstname;
	}

	public function setFirstName($firstName)
	{
		$this->firstname = $firstName;
		return $this;
	}

	public function getLastName()
	{
		return $this->lastname;
	}

	public function setLastName($lastName)
	{
		$this->lastname = $lastName;
		return $this;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress($address)
	{
		$this->address = $address;
		return $this;
	}
	

	public function __toString()
	{
		return "User: {$this->firstname} {$this->lastname}, Email: {$this->email}, Address: {$this->address}";
	}
}