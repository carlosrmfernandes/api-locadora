<?php

namespace App\Repository\V1\Movies;

use App\Models\Movie;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class MovieRepository extends BaseRepository
{

    public function __construct(Movie $movie)
    {
        parent::__construct($movie);
    }
    public function all($searchQuery = null): object
    {
        if ($searchQuery) {
            return $this->obj
                ->orderBy('name', $searchQuery)
                ->paginate(15);
        }

        return $this->obj
            ->paginate(15);
    }
    public function save(array $movie): object
    {
        DB::beginTransaction();
        try {
            $movie = $this->obj->create($movie);
            DB::commit();
            return $movie;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {

        DB::beginTransaction();
        try {
            $movie = $this->obj->find($id);
            if ($movie) {
                $movie=$movie->updateOrCreate([
                    'id' => $id,
                        ], $attributes);
            }

            DB::commit();
            return $movie
                    ->where('id', $movie->id)
                    ->first();
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function show(int $id): object
    {
        return (object) $this->obj
            ->where('id', $id)
            ->first();
    }

    public function delete($id): bool
    {
        return $this->obj->destroy($id);
    }

}
