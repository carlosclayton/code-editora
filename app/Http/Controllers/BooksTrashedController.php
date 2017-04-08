<?php

namespace CodeEditora\Http\Controllers;

use CodeEditora\Criteria\FindByAuthorCriteria;
use CodeEditora\Criteria\FindByTitle;
use CodeEditora\Criteria\FindByTitleCriteria;
use CodeEditora\Criteria\FindOnlyTrashedCriteria;
use CodeEditora\Http\Requests\BookCreateRequest;
use CodeEditora\Http\Requests\BookUpdateRequest;
use CodeEditora\Models\Book;
use CodeEditora\Http\Requests\BookRequest;
use CodeEditora\Repositories\BookRepository;
use CodeEditora\Repositories\CategoryRepository;
use CodeEditora\Repositories\RepositoryRestoreTrait;
use Illuminate\Http\Request;

class BooksTrashedController extends Controller
{
    use RepositoryRestoreTrait;
    private $repository;
    private $categoryRepository;
    /**
     * BooksController constructor.
     */
    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        //$this->repository->pushCriteria(FindOnlyTrashedCriteria::class);

        $books = $this->repository->onlyTrashed()->paginate(5);
        return view('trashed.books.index', compact('books', 'search'));
    }

    public function show($id){
        $this->repository->onlyTrashed();
        $book = $this->repository->find($id);
        return view('trashed.books.show', compact('book'));
    }

    public function update(Request $request, $id){

        $this->repository->onlyTrashed();

        $this->repository->restore($id);
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Restored successfully');
        return redirect()->to($url);

    }

}
