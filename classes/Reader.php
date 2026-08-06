<?php

class Reader
{
    // =========================
    // PROPERTIES
    // =========================

    private string $id;
    private string $firstName;
    private string $lastName;
    private string $color;
    private string $avatar;

    // =========================
    // CONSTRUCTOR
    // =========================

    public function __construct(
        string $id,
        string $firstName,
        string $lastName,
        string $color,
        string $avatar
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->color = $color;
        $this->avatar = $avatar;
    }

    // =========================
    // GETTERS
    // =========================

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }
}