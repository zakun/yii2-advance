<?php


namespace console\controllers;

use yii\console\Controller;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
class ConsumeController extends Controller
{
    public $exchange = 'router';
    public $queue = 'msgs';
    public $consumeTag = 'consumer';


    public function actionIndex()
    {
        $connection = new AMQPStreamConnection('localhost', '5672', 'guest', 'guest', '/');
        $channel = $connection->channel();

        $channel->queue_declare($this->queue, false, true, false, false);

        $channel->exchange_declare($this->exchange, AMQPExchangeType::DIRECT, false, true, false);

        $channel->queue_bind($this->queue, $this->exchange);

        $channel->basic_consume($this->queue, $this->consumeTag, false, false, false, false, [$this, 'process_message']);


        while ($channel ->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();

    }

    function process_message($message)
    {
        echo "\n--------\n";
        echo $message->body;
        echo "\n--------\n";

        $message->ack();

        // Send a message with the string "quit" to cancel the consumer.
        if ($message->body === 'quit') {
            $message->getChannel()->basic_cancel($message->getConsumerTag());
        }
    }
}