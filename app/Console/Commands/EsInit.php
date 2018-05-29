<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\V1\ElasticsearchController;
use Illuminate\Console\Command;

class EsInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'init elasticsearch(create index for post,use ik,set mappings)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $es = new ElasticsearchController();
        $index = env('ES_INDEX', 'masked');
        $type = env('ES_TYPE', 'post');
        $res = $es->indexCreate($index);

        if (array_key_exists('acknowledged', $res) && $res['acknowledged']) {
            $this->info('===== create index successed =====');
            $mapping = $es->putMappingsForPost($index, $type);
            if (array_key_exists('acknowledged', $mapping) && $mapping['acknowledged']) {
                $this->info('===== create mapping successed =====');
            } else {
                $this->info('===== create mapping failed:' . $mapping['message'] . '=====');
            }
        } else {
            $this->info('===== create index failed:' . $res['message'] . '=====');
        }
    }

}
