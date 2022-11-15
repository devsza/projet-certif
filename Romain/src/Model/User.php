<?php

class User
{

    private int $id;

    private string $pseudo;

    private string $mail;

    private string $password;
    
    private string $role;

    public function __construct()
    {
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of pseudo
     */
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  void
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Get the value of mail
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  void
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;

    }
    
    /**
     * Get the value of role
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
        
    }
}