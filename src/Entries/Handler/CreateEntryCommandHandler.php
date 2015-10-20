<?php

namespace Hechoenlaravel\JarvisFoundation\Entries\Handler;

use DB;
use Carbon\Carbon;
use Hechoenlaravel\JarvisFoundation\Entries\Events\EntryWasInserted;

/**
 * Class CreateEntryCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\Entries\Handler
 */
class CreateEntryCommandHandler
{
    /**
     * @param $command
     */
    public function handle($command)
    {
        $table = $command->entity->namespace.'_'.$command->entity->slug;
        $command->input['created_at'] = Carbon::now();
        $command->input['updated_at'] = Carbon::now();
        $entry = DB::table($table)->insert($command->input);
        event(new EntryWasInserted($command->entity, $entry, $command->input));
        return [
            'entry' => $entry,
            'input' => $command->input
        ];
    }
}