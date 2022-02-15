<?php

namespace App\Repository\V1\MovieTag;

use App\Models\MovieTag;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class MovieTagRepository extends BaseRepository
{

    public function __construct(MovieTag $movieTag)
    {
        parent::__construct($movieTag);
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

    public function save(array $movieTag): object
    {
        DB::beginTransaction();
        try {
            $movieTag = $this->obj->create($movieTag);
            DB::commit();
            return $movieTag;
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

}
