# Event Dispatcher

Basic PSR 14 friendly event dispatcher

## How to create event

```php
namespace App\Event;

class Event{
    private string $message;

    public function getMessage(): string
    {
        return $this->message;
    }
}
```

## How to create listener

```php
namespace App\Listener;

use Sruuua\EventDispatcher\Interfaces\ListenerInterface;

class Listener implements ListenerInterface{
    public function listen(): string
    {
        return Event::class;
    }

    public function __invoke(object $event)
    {
        echo $event->getMessage();
    }
}
```
