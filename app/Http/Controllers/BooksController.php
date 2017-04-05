<?php

namespace CodeEditora\Http\Controllers;

use CodeEditora\Criteria\FindByAuthorCriteria;
use CodeEditora\Criteria\FindByTitle;
use CodeEditora\Criteria\FindByTitleCriteria;
use CodeEditora\Http\Requests\BookCreateRequest;
use CodeEditora\Http\Requests\BookUpdateRequest;
use CodeEditora\Models\Book;
use CodeEditora\Http\Requests\BookRequest;
use CodeEditora\Repositories\BookRepository;
use CodeEditora\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    private $repository;
    private $categoryRepository;
    /**
     * BooksController constructor.
     */
    public function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        //$this->repository->pushCriteria(new FindByAuthorCriteria());
        $books = $this->repository->paginate(5);
        return view('books.index', compact('books', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookCreateRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = \Auth::user()->id;
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Created successfully');
        return redirect()->to($url);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = $this->repository->find($id);
        $categories = $this->categoryRepository->lists('name', 'id');
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, $id)
    {
        $data = $request->except(['author_id']);
        $book =  $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Updated successfully');
        return redirect()->to($url);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Deleted successfully');
        return redirect()->to(\URL::previous());

    }
}
