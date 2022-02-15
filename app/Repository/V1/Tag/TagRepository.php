<?php

namespace App\Repository\V1\Tag;

use App\Models\Tag;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class TagRepository extends BaseRepository
{

    public function __construct(Tag $tag)
    {
        parent::__construct($tag);
    }
    public function all($searchQuery = null): object
    {
        if ($searchQuery) {
            return $this->obj
                ->where('name','LIKE','%'.$searchQuery.'%')
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
            $user = $this->obj->find($id);
            if ($user) {
                $user=$user->updateOrCreate([
                    'id' => $id,
                        ], $attributes);
            }

            DB::commit();
            return $user
                    ->where('id', $user->id)
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

    public function tagWithMovie($searchQuery = null): object
    {
        if ($searchQuery) {
            return $this->obj
                ->with('movies')
                ->where('name','LIKE','%'.$searchQuery.'%')
                ->paginate(15);
        }

        return $this->obj
            ->with('movies')
            ->paginate(15);
    }

    public function delete($id): bool
    {
        return $this->obj->destroy($id);
    }

}
