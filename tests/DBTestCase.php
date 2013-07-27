<?php

abstract class DBTestCase extends Orchestra\Testbench\TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('database.default', 'messenger-test');
        $this->app['config']->set('database.connections.messenger-test', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $this->app['artisan']->call('migrate', array(
            '--path' => '../../../../../src/migrations/', 
            '--database' => 'messenger-test',
            '--verbose' => 3,

        ));


        /** seeds **/

        DB::table('users')->insert(
            array(
                'username' => 'maxmustermann',
                'firstname' => 'max',
                'surname' => 'mustermann',
                'email' => 'max.mustermann@gmail.com',
                'password' => Hash::make('123')
            )
        );

    }



    public function testRunningMigration()
    {
        $users = \DB::table('users')->where('id', '=', 1)->first();

        $this->assertEquals('max.mustermann@gmail.com', $users->email);
        $this->assertTrue(\Hash::check('123', $users->password));
    }
}