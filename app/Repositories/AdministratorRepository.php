<?php

namespace App\Repositories;

use App\Models\Administrator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class AdministratorRepository extends BaseRepository implements Interfaces\AdminRepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array
    {
        return Administrator::all()->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        try {
            return Administrator::findOrFail($id)->toArray();
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
            return Administrator::whereUsername($username)->firstOrFail()->toArray();
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
            return Administrator::whereUsername($email)->firstOrFail()->toArray();
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
            return (new Administrator())->create($params)->toArray();
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
                'status' => Administrator::findOrFail($id)->update($params)
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
     * @return array
     */
    public function updateUserByUserName(string $username, array $params): array
    {
        try {
            return [
                'status' => Administrator::whereUsername($username)->firstOrFail()->update($params)
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
                'status' => Administrator::whereEmail($email)->firstOrFail()->update($params)
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
                'status' => Administrator::findOrFail($id)->delete()
            ];
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }
}
