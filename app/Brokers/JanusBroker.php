<?php

namespace App\Brokers;

use RTippin\Janus\Exceptions\JanusApiException;
use RTippin\Janus\Exceptions\JanusPluginException;
use RTippin\Janus\Plugins\VideoRoom;
use RTippin\Messenger\Contracts\VideoDriver;
use RTippin\Messenger\Models\Call;
use RTippin\Messenger\Models\Thread;

class JanusBroker implements VideoDriver
{
    /**
     * @var VideoRoom
     */
    protected VideoRoom $videoRoom;

    /**
     * @var string|null
     */
    protected ?string $roomId = null;

    /**
     * @var string|null
     */
    protected ?string $roomPin = null;

    /**
     * @var string|null
     */
    protected ?string $roomSecret = null;

    /**
     * @var string|null
     */
    protected ?string $extraPayload = null;

    /**
     * JanusBroker constructor.
     *
     * @param  VideoRoom  $videoRoom
     */
    public function __construct(VideoRoom $videoRoom)
    {
        $this->videoRoom = $videoRoom;
    }

    /**
     * @inheritDoc
     */
    public function create(Thread $thread, Call $call): bool
    {
        try {
            $janus = $this->videoRoom->create(
                $this->settings($thread)
            );
        } catch (JanusApiException|JanusPluginException $e) {
            report($e);

            return false;
        }

        $this->roomId = $janus['room'];
        $this->roomPin = $janus['pin'];
        $this->roomSecret = $janus['secret'];

        return true;
    }

    /**
     * @inheritDoc
     */
    public function destroy(Call $call): bool
    {
        try {
            $this->videoRoom->destroy(
                $call->room_id,
                $call->room_secret
            );
        } catch (JanusApiException|JanusPluginException $e) {
            report($e);

            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function getRoomId(): ?string
    {
        return $this->roomId;
    }

    /**
     * @inheritDoc
     */
    public function getRoomPin(): ?string
    {
        return $this->roomPin;
    }

    /**
     * @inheritDoc
     */
    public function getRoomSecret(): ?string
    {
        return $this->roomSecret;
    }

    /**
     * @inheritDoc
     */
    public function getExtraPayload(): ?string
    {
        return $this->extraPayload;
    }

    /**
     * @param  Thread  $thread
     * @return array
     */
    protected function settings(Thread $thread): array
    {
        return [
            'description' => $thread->id,
            'publishers' => $this->publishersCount($thread),
            'bitrate' => $this->bitrate($thread),
        ];
    }

    /**
     * @param  Thread  $thread
     * @return int
     */
    protected function publishersCount(Thread $thread): int
    {
        return $thread->isGroup()
            ? $thread->participants()->count() + 6
            : 4;
    }

    /**
     * @param  Thread  $thread
     * @return int
     */
    protected function bitrate(Thread $thread): int
    {
        return $thread->isGroup()
            ? 600000
            : 1024000;
    }
}