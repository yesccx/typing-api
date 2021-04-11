<?php

declare (strict_types = 1);

use Hyperf\Utils\ApplicationContext;
use Psr\EventDispatcher\EventDispatcherInterface;

if (!function_exists('event')) {
    /**
     * 触发事件
     *
     * @param Object $event 事件对象
     * @return void
     */
    function event($event)
    {
        di(EventDispatcherInterface::class)->dispatch($event);
    }
}

if (!function_exists('di')) {
    /**
     * di容器
     *
     * @param null|string $id
     * @return mixed|\Psr\Container\ContainerInterface
     */
    function di($id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }

        return $container;
    }
}
