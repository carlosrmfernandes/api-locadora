<?php

namespace App\Repository\V1\Admin;

use App\Models\User;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class AdminRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }


    public function isActiveUser(int $userId, $attributes): object
    {
       DB::beginTransaction();
        try {

            $user = $this->obj->find($userId);
            if ($user) {
                $user = $user->update([
                    'is_active' => $attributes['is_active'],
                ]);
            }
            DB::commit();
            return  $this->obj->find($userId)->first();
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

}
