<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HtaccessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'htaccess:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $publicPath = public_path();
        //dd($publicPath); 
        $this->generateHtaccess($publicPath);
        $this->info('.htaccess files generated successfully.');
    }
    
    private function generateHtaccess($path)
    {
        $directories = \File::directories($path);
    
        foreach ($directories as $directory) {
            $htaccessContent = '<Files "*.php">' . PHP_EOL;
            $htaccessContent .= 'Deny from all' . PHP_EOL;
            $htaccessContent .= '</Files>';
    
            \File::put($directory . DIRECTORY_SEPARATOR . '.htaccess', $htaccessContent);
    
            $this->generateHtaccess($directory); // Recursive call for subdirectories
        }
    }
}
