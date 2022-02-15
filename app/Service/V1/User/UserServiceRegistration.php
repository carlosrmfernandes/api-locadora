<?php

namespace App\Service\V1\User;

use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use App\Jobs\JobRegistrationConfirmation;
use function bcrypt;
use Validator;

class UserServiceRegistration {

    use Traits\RuleTrait;
    use \App\Service\Traits\VerifyCnpjOrCpfTrait;

    protected $userRepositor;
    protected $userTypeRepository;
    protected $addressRepository;

    public function __construct(
    UserRepository $userRepository, UserTypeRepository $userTypeRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
    }

    public function store($request) {
        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

        if (($attributes['user_type_id']) && $attributes['user_type_id'] == 1) {
            if (!empty($attributes['category_id'])) {
                return "Remove the field category_id.";
            }
        }
        $attributes['cpf_cnpj'] = preg_replace('/[^0-9]/', '', (string) $attributes['cpf_cnpj']);

        if (!$this->cnpjCpf($attributes['cpf_cnpj'])) {
            return "cpf_cnpj invalid";
        }

        $validator = Validator::make($attributes, $this->rules());

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!get_object_vars(($this->userTypeRepository->show($attributes['user_type_id'])))) {
            return "user_type_id invalid";
        }

        $attributes['password'] = bcrypt($attributes['password']);

        if (!empty($attributes['image']) && $request->hasFile('image')) {
            $image = $this->uploadImg($request->file('image'), $attributes['cpf_cnpj']);
        }

        $attributes['image'] = empty($image) ? null : $image;

        $user = $this->userRepository->save($attributes);

            if ($user) {
                    JobRegistrationConfirmation::dispatch($user)
                            ->delay(now()
                                    ->addSecond('15'));

                    return $user ? "Successful registration, check your email please, wait for admin approval" : 'unidentified user';
                }

            return 'unidentified user';

    }

    public function uploadImg($file, $cpf_cnpj) {
        return $file->store('archive/' . $cpf_cnpj, 'public');
    }

}
