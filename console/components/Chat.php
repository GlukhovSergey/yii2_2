<?php


namespace console\components;


use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\WebSocket\WsConnection;

class Chat implements MessageComponentInterface
{

    private $clients = [];

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        echo "Server started\n";
    }

    /**
     * @param WsConnection $conn
     */
    function onOpen(ConnectionInterface $conn)
    {
        $queryString = $conn->httpRequest->getUri()->getQuery();
        $channel = explode('=', $queryString)[1];

        $this->clients[$channel][$conn->resourceId] = $conn;
        echo "New connection: {$conn->resourceId}";
    }

    /**
     * @param WsConnection $conn
     */
    function onClose(ConnectionInterface $conn)
    {
        unset($this->clients[$conn->resourceId]);
    }

    /**
     * @param WsConnection $conn
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo $e->getMessage() . PHP_EOL;
        $conn->close();
        unset($this->clients[$conn->resourceId]);
    }

    /**
     * @param WsConnection $from
     * @param string $msg {user_id : 1, message : '', channel: 'Task_1'}
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        echo "{$from->resourceId}: {$msg}";
        $data = json_decode($msg, true);
        $channel = $data['channel'];

        $recordChat = new \common\models\tables\Chat();
        $recordChat->channel = $channel;
        $recordChat->message = $data['message'];
        $recordChat->user_id = $data['user_id'];
        $recordChat->save();

       foreach ($this->clients[$channel] as $client) {
           $client->send($data['message']);
       }
    }


}