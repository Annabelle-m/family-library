<?php

class Book
{
    // =========================
    // PROPERTIES
    // =========================

    private string $id;
    private string $title;
    private string $author;
    private string $isbn;
    private bool $available;

    // =========================
    // CONSTRUCTOR
    // =========================

    public function __construct(
        string $id,
        string $title,
        string $author,
        string $isbn
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->available = true;
    }

    // =========================
    // GETTERS
    // =========================

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    // =========================
    // LOAN MANAGEMENT
    // =========================

    public function borrow(): void
    {
        $this->available = false;
    }

    public function returnBook(): void
    {
        $this->available = true;
    }
}