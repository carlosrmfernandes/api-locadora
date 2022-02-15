<?php

namespace App\Service\V1\User;

use Illuminate\Http\Request;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use Illuminate\Support\Facades\Storage;
use function bcrypt;
use Validator;

class UserServiceUpdate
{

    use Traits\RuleTrait;
    use \App\Service\Traits\VerifyCnpjOrCpfTrait;

    protected $userRepository;
    protected $userTypeRepository;
    protected $addressRepository;

    public function __construct(
        UserRepository $userRepository,
        UserTypeRepository $userTypeRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
    }

    public function update(int $id, Request $request)
    {
        $attributes = $request->all();


        $attributes['cpf_cnpj'] = preg_replace('/[^0-9]/', '', (string) $attributes['cpf_cnpj']);

        if (!$this->cnpjCpf($attributes['cpf_cnpj'])) {
            return "cpf_cnpj invalid";
        }

        $validator = Validator::make($attributes, $this->rules($id));

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!get_object_vars(($this->userTypeRepository->show($attributes['user_type_id'])))) {
            return "user_type_id invalid";
        }


        if ($request->hasFile('image')) {
            $image = $this->uploadImg($request->file('image'), $id);
        }


        $attributes['image']= empty($image)?null:$image;
        $attributes['password'] = bcrypt($attributes['password']);

        $user = $this->userRepository->update($id, $attributes);

        if ($user) {
           return $user ?? 'unidentified addres';
        }
        return 'unidentified addres';
    }
    public function uploadImg($file, $id)
    {
        if ($this->userRepository->show($id)->image) {
            Storage::delete('public/' . $this->userRepository->show($id)->image);
        }

        return  $file->store('archive/' . auth('api')->user()->cpf_cnpj, 'public');
    }
}
