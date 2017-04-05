<?php

namespace CodeEditora\Http\Requests;

use CodeEditora\Repositories\BookRepository;
use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{
    /**
     * BookUpdate constructor.
     */
    private $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = (int)$this->route('book');
        if($id == 0){
            return false;
        }

        $book = $this->repository->find($id);
        return $book->author_id = \Auth::user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
