<?php namespace Andheiberg\Messenger;

use Andheiberg\Messenger\Commands\SetupCommand;
use Illuminate\Support\ServiceProvider;

class MessengerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('andheiberg/messenger', 'messenger');

		$this->registerConsoleCommands();
	}

	/**
	 * Register the console commands.
	 * 
	 * @return void
	 */
	protected function registerConsoleCommands()
	{
		$this->app['messenger.setup'] = $this->app->share(function($app)
		{
			return new SetupCommand($app['files']);
		});

		$this->commands('messenger.setup');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('messenger');
	}

}