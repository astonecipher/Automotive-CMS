<?php
require_once 'classes/db.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * db test case.
 */
class dbTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var db
     */
    private $db;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated dbTest::setUp()
        
        $this->db = new db();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated dbTest::tearDown()
        $this->db = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests db->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated dbTest->test__construct()
        $this->markTestIncomplete("__construct test not implemented");
        
        $this->db->__construct(/* parameters */);
    }

    /**
     * Tests db->insertUser()
     */
    public function testInsertUser()
    {
        $this->markTestIncomplete("__construct test not implemented");
        $values = array(
            ':username' => 'jsmith',
            ':password' => hash('whirlpool', 'password'),
            ':fname'    => 'James',
            ':lname'    => 'Smith',
        );
        
        $fail = array();
//  echo "<pre>";
//         print_r( $this->db->insertUser($values) );
//         echo "</pre>";
        $this->assertEquals( "Missing parameter, ':username'", $this->db->insertUser( $fail ) );
        $this->assertTrue( $this->db->insertUser( $values ) );
        
    }
    
    public function testGetUserById()
    {
        
        print_r( $this->db->getUserById(1) );
        $id = 1;
        $this->assertFalse( $this->db->getUserById(99));
        $this->assertEquals('Andrew', $this->db->getUserById(1));
    }

}

