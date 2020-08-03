<?php


/**
 * Nu stiu daca este neaparata corecta abordarea in toate situatiile, insa mi s-a parut comod sa folosesc
 * MVC cu repository si service. Implementarea poate lasa de dorit, din lipsa orm-ului
 * nu am incercat sa fac nimic in plus, sau prea complicat, ba din contra, am vrut sa separ logica mai mult
 * Astfel: Routerul ruteaza catre functiile din controller---> controllerul nu se ocupa propriu zis de ceva,
 * ci redirectioneaza datele catre servicii.Serviciile proceseaza datele, si cu ajutorul repositoriului, modifica
 * modelul, [logica asta am folosit-o in java Spring, si banuiesc ca si in laravel e asemanator], insa in cazul actual
 * controllerul trimite date la repository care la randul lui modifica modelul, si db-ul
 * initial am facut rutarea destul de diferit de cum a fost facuta la prezentare, insa am constatat dupa ca este
 * mai eficienta abordarea facuta de voi, si am folosit-o.
 * datorita lipsei unui model mapper, poate clasele si pachetele nu sunt structurate chiar cum trebuie, asa au avut
 * logica ptr mine la momentul asta
 * Stiu ca nu este un best practice, dar am folosit destul de multe metode statice :(
 * La creare as fi vrut sa fac new class de ceva, si sa il mapez la entitatea din BD, insa nu am reusit cu succes
 * Sper ca este cat de cat ok ce am facut eu aici, si astept feedback
 * ==========> sorry for being late, again . In was not on purpose :(
 *
 */

namespace BookStore\controller;

use BookStore\repository\BookStoreRepository;
use BookStore\router\Functions;

class BookStoreController
{
    public BookStoreRepository $bookStoreRepository;

    public function __construct()
    {
        $this->bookStoreRepository = new BookStoreRepository();
    }


    public function index()
    {
        $books = $this->bookStoreRepository->getAllBooks();
        if ( ! $books) {
            Functions::loadView('/?error=empty', ['books' => $books]);
        } else {
            Functions::loadView('index.view.php', ['books' => $books]);
        }
    }

    public function create()
    {
        Functions::loadView('create.view.php');
    }

    public function store()
    {
        $values = [
            'title'          => $_POST['title'],
            'author_name'    => $_POST['author_name'],
            'publisher_name' => $_POST['publisher_name'],
            'publish_year'   => $_POST['publish_year'],

        ];

//        $isCreated = BookStoreRepository::saveNewBook($values);
        $isCreated = $this->bookStoreRepository->saveNewBook($values);

        if ( ! $isCreated) {
            header("Location: /?error=create");
        } else {
            header("Location: /?success=create");
        }
    }

    public function edit()
    {
        $values = [
            'id' => $_GET['id'],
        ];
        $book   = $this->bookStoreRepository->getBookById($values);

        if ( ! $book) {
            Functions::loadView('404.error.php');
        } else {
            Functions::loadView('edit.view.php', ['book' => $book]);
        }
    }

    public function update()
    {
        $values    = [
            'id'             => $_POST['id'],
            'title'          => $_POST['title'],
            'author_name'    => $_POST['author_name'],
            'publisher_name' => $_POST['publisher_name'],
            'publish_year'   => $_POST['publish_year'],
        ];
        $isUpdated = $this->bookStoreRepository->updateBook($values);
        if ( ! $isUpdated) {
            header("Location: /?error=update");
        } else {
            header("Location: /?success=update");
        }
    }

    public function delete()
    {
        $values    = ['id' => $_GET['id']];
        $isDeleted = $this->bookStoreRepository->deleteBookById($values);
        if ( ! $isDeleted) {
            header("Location: /?error=delete");
        } else {
            header("Location: /?success=delete");
        }
    }
}