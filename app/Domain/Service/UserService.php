<?php
namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Exceptions\RulesException;
use App\User;

class UserService
{
    use ContainerTrait;

    /**
     * Get user for id
     * @param integer $id
     * @return User
     * @throws RulesException
     */
    public function getForId($id)
    {
        $user = User::find($id);

        if (!$user) {
            throw new RulesException('Usuário não encontrado');
        }

        return $user;
    }
}