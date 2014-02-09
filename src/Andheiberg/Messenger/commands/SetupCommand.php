<?php namespace Andheiberg\Messenger\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;
use \Artisan;

class SetupCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'messenger:setup';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Setup messenger migrations and models.';

	/**
	 * The filesystem instance.
	 *
	 * @var Illuminate\Filesystem\Filesystem
	 */
	protected $filesystem;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Filesystem $filesystem)
	{
		parent::__construct();

		$this->filesystem = $filesystem;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->createModels();
		$this->createControllers();
		$this->createMigrations();

		Artisan::call('config:publish', ['package' => 'andheiberg/messenger']);

		$this->info('Messenger setup!');
		$this->info("You should add 'use \Andheiberg\Messenger\Traits\UserCanMessage;' inside your user class.");
		$this->info("You should create a route for the controller.");
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function createModels()
	{
		$stubs = [
			'Conversation' => __DIR__.'/../stubs/Conversation.php',
			'Message' => __DIR__.'/../stubs/Message.php',
			'Participant' => __DIR__.'/../stubs/Participant.php',
		];

		foreach ($stubs as $name => $stub)
		{
			$destination = app_path()."/models/{$name}.php";

			if ($this->filesystem->exists($destination))
			{
				if ($this->confirm("\"app/models/{$name}.php\" already exists do you wish to overwrite it? [yes|no]"))
				{
					$this->filesystem->copy($stub, $destination);
					$this->info("Created \"app/models/{$name}.php\"");
				}
			}
			else
			{
				$this->filesystem->copy($stub, $destination);
				$this->info("Created \"app/models/{$name}.php\"");
			}
		}
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function createControllers()
	{
		$stubs = [
			'ConversationsController' => __DIR__.'/../stubs/ConversationsController.php',
		];

		foreach ($stubs as $name => $stub)
		{
			$destination = app_path()."/controllers/{$name}.php";

			if ($this->filesystem->exists($destination))
			{
				if ($this->confirm("\"app/controllers/{$name}.php\" already exists do you wish to overwrite it? [yes|no]"))
				{
					$this->filesystem->copy($stub, $destination);
					$this->info("Created \"app/controllers/{$name}.php\"");
				}
			}
			else
			{
				$this->filesystem->copy($stub, $destination);
				$this->info("Created \"app/controllers/{$name}.php\"");
			}
		}
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function createMigrations()
	{
		Artisan::call('migrate', ['--package' => 'andheiberg/messenger']);

		// $stubs = [
		// 	'2013_05_23_114020_create_conversations_table' => __DIR__.'/../migrations/2013_05_23_114020_create_conversations_table.php',
		// 	'2013_05_23_114039_create_messages_table' => __DIR__.'/../migrations/2013_05_23_114039_create_messages_table.php',
		// 	'2013_05_24_140404_create_conversation_user_table' => __DIR__.'/../migrations/2013_05_24_140404_create_conversation_user_table.php',
		// ];

		// foreach ($stubs as $name => $stub)
		// {
		// 	$destination = app_path()."/migrations/{$name}.php";

		// 	if ($this->filesystem->exists($destination))
		// 	{
		// 		if ($this->confirm("\"app/migrations/{$name}.php\" already exists do you wish to overwrite it? [yes|no]"))
		// 		{
		// 			$this->filesystem->move($stub, $destination);
		// 			$this->info("Created \"app/migrations/{$name}.php\"");
		// 		}
		// 	}
		// 	else
		// 	{
		// 		$this->filesystem->move($stub, $destination);
		// 		$this->info("Created \"app/migrations/{$name}.php\"");
		// 	}
		// }
	}

}