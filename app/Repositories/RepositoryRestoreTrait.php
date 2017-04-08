<?php

namespace CodeEditora\Repositories;

trait RepositoryRestoreTrait{
    public function restore($id){
        $this->applyScope();
        $model = $this->find($id);
        $model->restore();
    }
}