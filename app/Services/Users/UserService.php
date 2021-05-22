<?php


namespace App\Services\Users;


use App\Http\Resources\Users\UserCollection;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserService implements \App\Services\BaseServiceInterface
{

    public function getAll(): UserCollection
    {
        $users = User::orderBy('id','DESC')->paginate(10);
        return new UserCollection($users);
    }

    public function getOne($id): UserResource
    {
        $user = User::find($id);
        return new UserResource($user);
    }

    public function store($request): \Illuminate\Http\JsonResponse
    {
        $user = User::create($request);

        $data['token'] = $user->createToken('test_ecommerce')->accessToken;
        $data['name']  = $user->name;
        $data['token_type'] = 'Bearer';

        return response()->json(['message'=>'User saved successfully','data'=>$data],Response::HTTP_CREATED);
    }

    public function update($request, $id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);
        $user->update($request);
        return response()->json('User updated successfully',Response::HTTP_OK);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json('User deleted successfully',Response::HTTP_OK);
        }
        return response()->json('User Not Found',Response::HTTP_NOT_FOUND);
    }

    public function profile(): UserResource
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    public function search()
    {
        // TODO: Implement search() method.
    }
}
