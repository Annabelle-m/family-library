<?php

class Loan
{
    // =========================
    // PROPERTIES
    // =========================

    private Book $book;
    private Reader $reader;

    // =========================
    // CONSTRUCTOR
    // =========================

    public function __construct(Book $book, Reader $reader)
    {
        $this->book = $book;
        $this->reader = $reader;
    }

    // =========================
    // GETTERS
    // =========================

    public function getBook(): Book
    {
        return $this->book;
    }

    public function getReader(): Reader
    {
        return $this->reader;
    }
}