<?php

namespace App\Service\V1\Movies;

use App\Repository\V1\Movies\MovieRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Validator;

class MoviesUpdate {

    use Traits\RuleTrait;

    protected $movieRepository;

    public function __construct(
        MovieRepository $movieRepository
    ) {
        $this->movieRepository = $movieRepository;
    }

    public function update(int $id, Request $request) {
        $attributes = $request->all();

        $validator = Validator::make($attributes, $this->rules());

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!get_object_vars(($this->movieRepository->show($id)))) {
            return "movie not found";
        }
        if ($request->hasFile('archive')) {
            $file = $this->uploadFile($request->file('archive'), $id);
        }

        $attributes['archive']= empty($file)?null:$file;
        $movie = $this->movieRepository->update($id, $attributes);

        return $movie ?? "movie invalid";
    }

    public function uploadFile($file, $id)
    {
        if ($this->movieRepository->show($id)->archive) {
            Storage::delete('public/' . $this->movieRepository->show($id)->archive);
        }

        return  $file->store('archive/' . auth('api')->user()->cpf_cnpj, 'public');
    }

}
