<?php

namespace App\Service\V1\Admin;

use App\Repository\V1\Admin\AdminRepository;
use App\Repository\V1\User\UserRepository;
use App\Jobs\JobIsActiveUser;

class AdminService {

    protected $adminRepository;
    protected $userRepository;

    public function __construct(AdminRepository $adminRepository, UserRepository $userRepository
    ) {
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
    }

    public function isActiveUser($userId, $attributes) {
        if (!get_object_vars(($this->userRepository->show($userId)))) {
            return "user_id invalid";
        }

        $user = $this->adminRepository->isActiveUser($userId, $attributes);

        if ($user) {
            JobIsActiveUser::dispatch($user, $attributes['is_active'])
                    ->delay(now()
                            ->addSecond('15'));

            return $user ? "Success, an email has been sent to the user" : 'unidentified user';
        }

        return 'unidentified user';
    }

}
