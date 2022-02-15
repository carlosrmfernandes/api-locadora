<?php

namespace App\Service\V1\Movies;

use App\Repository\V1\Movies\MovieRepository;

use Validator;

class MoviesRegistration {

    use Traits\RuleTrait;

    protected $movieRepository;

    public function __construct(
     MovieRepository $movieRepository
    ) {
        $this->movieRepository = $movieRepository;

    }

    public function store($request) {

        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

        $validator = Validator::make($attributes, $this->rules());
        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!empty($attributes['archive']) && $request->hasFile('archive')) {
            $file = $this->uploadFile($request->file('archive'), auth('api')->user()->cpf_cnpj);
        }

        $attributes['archive'] = empty($file) ? null : $file;

        $attributes['user_id'] = auth('api')->user()->id;
        $movie = $this->movieRepository->save($attributes);

        return $movie ?? "unidentified movie";

    }

    public function uploadFile($file, $cpf_cnpj) {
        return $file->store('archive/' . $cpf_cnpj, 'public');
    }

}
