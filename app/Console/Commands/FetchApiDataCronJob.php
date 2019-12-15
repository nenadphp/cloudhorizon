<?php

namespace App\Console\Commands;

use App\Events\StoreApiDataEvent;
use App\Exceptions\CustomException;
use Illuminate\Console\Command;

class FetchApiDataCronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_api_data:cron {--from=2019-04-15%10:00:00}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Api data';

    /**
     * Execute the console command.
     *
     * @throws CustomException
     */
    public function handle(): void
    {
        try {
            $from = $this->option('from');

            $this->validateFrom($from);

            event(new StoreApiDataEvent($from));
        } catch (\Exception $exception) {
            throw new CustomException($exception);
        }
    }

    /**
     * @param $from
     * @return bool
     * @throws CustomException
     */
    private function validateFrom($from):bool
    {
        $from = explode('%', $from);

        $from = implode(' ', $from);

        if (empty($from) ) {
            throw new CustomException('Param from iz required '. __METHOD__);
        }


        if (!(bool)strtotime($from)) {
            throw new CustomException('Wrong from param '. __METHOD__);
        }

        return true;
    }
}
