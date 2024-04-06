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
     * @param \Discord\Parts\Channel\Message $message
     * @param array $args
     * @return \React\Promise\ExtendedPromiseInterface
     */
    public function handle($message, $args)
    {
        $voiceChannel = $message->member->getVoiceChannel();

        if (is_null($voiceChannel)) {
            return $this
                ->message()
                ->title(sprintf('%s, por favor, entre em algum canal de voz e repita o comando.', $message->member->display_name))
                ->content('Você deve estar em algum canal de voz para me convidar!.')
                ->send($message);
        }

        $this->discord()->joinVoiceChannel($voiceChannel);

        return $this
            ->message()
            ->title(sprintf('%s me convidou para o canal de voz "%s"!.', $message->member->display_name, $voiceChannel->name))
            ->content(sprintf('Entrei no canal de voz "%s"!', $voiceChannel->name))
            ->send($message);
    }
}
