<?php namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Modules\Core\Foundation\Theme\ThemeManager;
use Symfony\Component\Console\Input\InputArgument;

class PublishThemeAssetsCommand extends Command
{
    protected $name = 'asgard:publish:theme';
    protected $description = 'Publish theme assets';
    /**
     * @var \Modules\Core\Foundation\Theme\ThemeManager
     */
    private $themeManager;

    public function __construct(ThemeManager $themeManager)
    {
        parent::__construct();
        $this->themeManager = $themeManager;
    }

    public function fire()
    {
        $theme = $this->argument('theme') ?: '';
        if ($theme) {
            $this->comment("Publishing assets for [$theme] theme");
        } else {
            $this->comment('Publishing assets for all themes');
        }

        $this->themeManager->publishAssetsFor($theme);

        $this->info("Assets published for [$theme] theme");
    }

    protected function getArguments()
    {
        return array(
            array('theme', InputArgument::REQUIRED, 'The theme name')
        );
    }
}
