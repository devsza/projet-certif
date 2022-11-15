<?php

class Sheet
{
    /**
     * @var int $id
     */
    private int $id;

    /**
     * @var string|null $file_path_image
     */
    private ?string $file_path_image;

    /**
     * @var string|null $description
     */
    private ?string $description;
    
    /**
     * @var string|null $name
     */
     private ?string $name;
     
     /**
      * @var string|null $difficulty
      */
     private ?string $difficulty;
     
     /**
     * @var string|null $gender
     */
    private ?string $gender;
    
    /**
     * @var string|null $nationality
     */
    private ?string $nationality;
    
    /**
     * @var string|null $power
     */
    private ?string $power;
    
    /**
     * @var string|null $weapon
     */
    private ?string $weapon;
    
    
    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get $file_path_image
     *
     * @return  string|null
     */
    public function getFile_path_image(): ?string
    {
        return $this->file_path_image;
    }

    /**
     * Set $file_path_image
     *
     * @param  string|null  $file_path_image
     *
     * @return  void
     */
    public function setFile_path_image(string $file_path_image): void
    {
        $this->file_path_image = $file_path_image;
    }
    
    /**
     * Get $description
     *
     * @return  string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set $description
     *
     * @param  string|null  $description
     *
     * @return  void
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
    
    /**
     * Get the value of difficulty
     */
    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    /**
     * Set the value of difficulty
     *
     * @return  self
     */
    public function setDifficulty(?string $difficulty): self
    {
        $this->difficulty = $difficulty;
        return $this;
    }
    
    /**
     * Get the value of gender
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */
    public function setGender(?string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * Get the value of nationality
     */
    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    /**
     * Set the value of nationality
     *
     * @return  self
     */
    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;
        return $this;
    }
    
    /**
     * Get the value of power
     */
    public function getPower(): ?string
    {
        return $this->power;
    }

    /**
     * Set the value of power
     *
     * @return  self
     */
    public function setPower(?string $power): self
    {
        $this->power = $power;
        return $this;
    }
  
    /**
     * Get the value of weapon
     */
    public function getWeapon(): ?string
    {
        return $this->weapon;
    }

    /**
     * Set the value of weapon
     *
     * @return  self
     */
    public function setWeapon(?string $weapon): self
    {
        $this->weapon = $weapon;
        return $this;
    }
}
