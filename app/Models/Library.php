<?php

class Library
{
    // =========================
    // PROPERTIES
    // =========================

    private array $books = [];
    private array $readers = [];
    private array $loans = [];

    // =========================
    // BOOK MANAGEMENT
    // =========================

    public function addBook(Book $book): void
    {
        if ($this->findBookByIsbn($book->getIsbn()) !== null) {
            return;
        }

        $this->books[] = $book;
    }

    public function deleteBook(Book $book): void
    {
        if (!$book->isAvailable()) {
            return;
        }

        foreach ($this->books as $key => $currentBook) {
            if ($book === $currentBook) {
                unset($this->books[$key]);
                return;
            }
        }
    }

    // =========================
    // READER MANAGEMENT
    // =========================

    public function addReader(Reader $reader): void
    {
        if ($this->findReaderById($reader->getId()) !== null) {
            return;
        }

        $this->readers[] = $reader;
    }

    public function deleteReader(Reader $reader): void
    {
        foreach ($this->loans as $loan) {
            if ($reader === $loan->getReader()) {
                return;
            }
        }

        foreach ($this->readers as $key => $currentReader) {
            if ($reader === $currentReader) {
                unset($this->readers[$key]);
                return;
            }
        }
    }

    // =========================
    // LOAN MANAGEMENT
    // =========================

    public function loanBook(Book $book, Reader $reader): void
    {
        if (!$book->isAvailable()) {
            return;
        }

        $book->borrow();

        $loan = new Loan($book, $reader);

        $this->loans[] = $loan;
    }

    public function returnBook(Book $book): void
    {
        foreach ($this->loans as $key => $loan) {
            if ($book === $loan->getBook()) {
                $book->returnBook();
                unset($this->loans[$key]);
                return;
            }
        }
    }

    // =========================
    // BOOK SEARCH
    // =========================

    public function findBookById(string $id): ?Book
    {
        foreach ($this->books as $book) {
            if ($id === $book->getId()) {
                return $book;
            }
        }

        return null;
    }

    public function findBookByTitle(string $title): ?Book
    {
        foreach ($this->books as $book) {
            if ($title === $book->getTitle()) {
                return $book;
            }
        }

        return null;
    }

    public function findBookByAuthor(string $author): ?Book
    {
        foreach ($this->books as $book) {
            if ($author === $book->getAuthor()) {
                return $book;
            }
        }

        return null;
    }

    public function findBookByIsbn(string $isbn): ?Book
    {
        foreach ($this->books as $book) {
            if ($isbn === $book->getIsbn()) {
                return $book;
            }
        }

        return null;
    }

    // =========================
    // READER SEARCH
    // =========================

    public function findReaderById(string $id): ?Reader
    {
        foreach ($this->readers as $reader) {
            if ($id === $reader->getId()) {
                return $reader;
            }
        }

        return null;
    }

    public function findReaderByLastName(string $lastName): ?Reader
    {
        foreach ($this->readers as $reader) {
            if ($lastName === $reader->getLastName()) {
                return $reader;
            }
        }

        return null;
    }

    public function findReaderByFirstName(string $firstName): ?Reader
    {
        foreach ($this->readers as $reader) {
            if ($firstName === $reader->getFirstName()) {
                return $reader;
            }
        }

        return null;
    }

    public function findReaderByColor(string $color): ?Reader
    {
        foreach ($this->readers as $reader) {
            if ($color === $reader->getColor()) {
                return $reader;
            }
        }

        return null;
    }

    // =========================
    // BOOK DISPLAY
    // =========================

    public function showBooks(): void
    {
        foreach ($this->books as $book) {
            if ($book->isAvailable()) {
                $status = "Disponible";
            } else {
                $status = "Emprunté";
            }

            echo "Titre : " . $book->getTitle()
                . " - Auteur : " . $book->getAuthor()
                . " - Statut : " . $status
                . "<br>";
        }
    }

    public function showAvailableBooks(): void
    {
        foreach ($this->books as $book) {
            if ($book->isAvailable()) {
                echo "Titre : " . $book->getTitle()
                    . " - Auteur : " . $book->getAuthor()
                    . "<br>";
            }
        }
    }

    public function showBorrowedBooks(): void
    {
        foreach ($this->books as $book) {
            if (!$book->isAvailable()) {
                echo "Titre : " . $book->getTitle()
                    . " - Auteur : " . $book->getAuthor()
                    . "<br>";
            }
        }
    }

    // =========================
    // READER DISPLAY
    // =========================

    public function showReaders(): void
    {
        foreach ($this->readers as $reader) {
            echo "Nom : " . $reader->getLastName()
                . " - Prénom : " . $reader->getFirstName()
                . " - Couleur : " . $reader->getColor()
                . " - Avatar : " . $reader->getAvatar()
                . "<br>";
        }
    }

    // =========================
    // LOAN DISPLAY
    // =========================

    public function showLoans(): void
    {
        foreach ($this->loans as $loan) {
            echo "Titre : " . $loan->getBook()->getTitle()
                . " - Lecteur : "
                . $loan->getReader()->getFirstName()
                . " "
                . $loan->getReader()->getLastName()
                . "<br>";
        }
    }

    public function showReaderLoans(Reader $reader): void
    {
        foreach ($this->loans as $loan) {
            if ($reader === $loan->getReader()) {
                echo $loan->getBook()->getTitle()
                    . "<br>";
            }
        }
    }

    public function showBookLoans(Book $book): void
    {
        foreach ($this->loans as $loan) {
            if ($book === $loan->getBook()) {
                echo $loan->getReader()->getFirstName()
                    . " "
                    . $loan->getReader()->getLastName()
                    . "<br>";
            }
        }
    }

    // =========================
    // COUNTERS
    // =========================

    public function countBooks(): int
    {
        return count($this->books);
    }

    public function countReaders(): int
    {
        return count($this->readers);
    }

    public function countLoans(): int
    {
        return count($this->loans);
    }

    public function countAvailableBooks(): int
    {
        $counter = 0;

        foreach ($this->books as $book) {
            if ($book->isAvailable()) {
                $counter++;
            }
        }

        return $counter;
    }

    public function countBorrowedBooks(): int
    {
        $counter = 0;

        foreach ($this->books as $book) {
            if (!$book->isAvailable()) {
                $counter++;
            }
        }

        return $counter;
    }

    // =========================
    // STATISTICS
    // =========================

    public function showStatistics(): void
    {
        echo "Nombre de livres : " . $this->countBooks() . "<br>"
            . "Nombre de livres empruntés : " . $this->countBorrowedBooks() . "<br>"
            . "Nombre de lecteurs : " . $this->countReaders() . "<br>"
            . "Nombre de livres disponibles : " . $this->countAvailableBooks() . "<br>"
            . "Nombre d'emprunts : " . $this->countLoans() . "<br>";
    }
}