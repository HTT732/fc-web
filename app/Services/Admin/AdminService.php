<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use Auth;
use Schema;
use App\Traits\ImageManipulation;

/**
 * Service AdminService
 *
 * @package App\Services\AdminService
 * @author HTT
 */
Class AdminService
{
    use ImageManipulation;

    public function __construct(
        UserRepositoryInterface $userRepo
    ){
        $this->userRepo = $userRepo;
    }

    public function getAdmin()
    {
        return $this->userRepo->getAdmin();
    }

    public function update($request, $id)
    {
        $data = $request->all();


        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->has('avatar')) {
            $result = $this->processImg($request->file('avatar'));

            if ($result) {
                $data['avatar'] = $result['image']['medium'];
            }
        }

        if (Auth::id() != $id) {
            return false;
        }

        $update = $this->userRepo->update($data, $id);

        return $update;
    }

    public function processImg($file)
    {
        // get info image
        $rootFolder = config('constants.upload.avatar.root');
        $listSize = config('constants.upload.avatar.size');

        if (!$rootFolder || !$listSize) {
            return false;
        }

        $result = $this->processUploadImage($file, $rootFolder, $listSize);
            
        if ($result['msgCode'] === 400) {
            return false;
        }
        
        return $result;
    }
}