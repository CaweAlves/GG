<?php

namespace App\Commands;

use Laracord\Commands\Command;

class JoinChannel extends Command
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'join';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'The join-channel command.';

    /**
     * Determines whether the command requires admin permissions.
     *
     * @var bool
     */
    protected $admin = false;

    /**
     * Determines whether the command should be displayed in the commands list.
     *
     * @var bool
     */
    protected $hidden = false;

    /**
     * Handle the command.
     *
     * @param  \Discord\Parts\Channel\Message  $message
     * @param  array  $args
     * @return void
     */
    public function handle($message, $args)
    {

        $channel = $this->discord()->getChannel("channel-id");

        $this->discord()->joinVoiceChannel($channel);
        
        return $this
            ->message()
            ->title('JoinChannel')
            ->content('Hello world!')
            ->send($message);
    }
}
