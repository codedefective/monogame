<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    
    /**
     * @return array
     */
    public function getAll(): array
    {
        return User::all()->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        try {
            return User::findOrFail($id)->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param string $username
     * @return array
     */
    public function getUserByUsername(string $username): array
    {
        try {
            return User::whereUsername($username)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }

    }

    /**
     * @param string $email
     * @return array
     */
    public function getUserByEmail(string $email): array
    {
        try {
            return User::whereUsername($email)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param array $params
     * @return array
     */
    public function createUser(array $params): array
    {
        try {
            return (new User())->create($params)->toArray();
        }catch (QueryException $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     */
    public function updateById(int $id, array $params): array
    {
        try {
            return [
                'status' => User::findOrFail($id)->update($params)
            ];
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }catch (QueryException $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }

    /**
     * @param string $username
     * @param array $params
     * @return bool|array
     */
    public function updateUserByUserName(string $username, array $params): array
    {
        try {
            return [
                'status' => User::whereUsername($username)->firstOrFail()->update($params)
            ];
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }catch (QueryException $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }

    /**
     * @param string $email
     * @param array $params
     * @return array
     */
    public function updateUserByEmail(string $email, array $params): array
    {
        try {
            return [
                'status' => User::whereEmail($email)->firstOrFail()->update($params)
            ];
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }catch (QueryException $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function deleteById(int $id): array
    {
        try {
            return [
                'status' => User::findOrFail($id)->delete()
            ];
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }
}
