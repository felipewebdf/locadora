<?php
namespace Test\App\Domain\Service;

use Tests\TestCase;
use App\Domain\Service\UserService;
use App\User;

/**
 * @group user
 */
class UserServiceTest extends TestCase
{
    private $db;

    /**
     *
     * @var UserService
     */
    protected $userService;

    public function setUp()
    {
        parent::setUp();
        $this->db = $this->app->make('db');
        $this->db->connection()->beginTransaction();
        $this->userService = $this->app->make(UserService::class);
    }

    public function tearDown()
    {
        $this->db->connection()->rollback();
    }

   public function testGetForIdReturnUserEntity()
   {
       $this->assertInstanceOf(User::class, $this->userService->getForId(2));
   }

   /**
    * @expectedException \App\Exceptions\RulesException
    */
   public function testGetForIdNotExistsLaunchException()
   {
       $this->userService->getForId(0);
   }

}
