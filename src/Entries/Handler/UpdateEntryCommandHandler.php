<?php

namespace Hechoenlaravel\JarvisFoundation\Entries\Handler;

use DB;
use Carbon\Carbon;
use Hechoenlaravel\JarvisFoundation\Entries\Events\EntryWasUpdated;

/**
 * Class UpdateEntryCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\Entries\Handler
 */
class UpdateEntryCommandHandler
{
    /**
     * @param $command
     * @return array
     */
    public function handle($command)
    {
        $command->input['updated_at'] = Carbon::now();
        DB::table($command->entity->getTableName())->where('id', $command->entry_id)->update($command->input);
        event(new EntryWasUpdated($command->entity, $command->entry_id, $command->input));
        return [
            'entry_id' => $command->entry_id,
            'input' => $command->input
        ];
    }
}
