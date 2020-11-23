<?php


class HookRepository
{
    /**
     * The repository items.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $items;

    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->items = collect();
    }

    /**
     * Dynamically call methods.
     *
     * @param  string  $method
     * @param  array  $arguments
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        return $this->items->{$method}(...$arguments);
    }

    /**
     * Register a new hook callback.
     *
     * @param  string|array  $hook
     * @param  callable  $callback
     * @param  int  $priority
     * @return void
     */
    public function register($hook, callable $callback, int $priority = 10): void
    {
        $this->items->push(compact('hook', 'callback', 'priority'));
    }

    /**
     * Apply the callbacks on the given hook and value.
     *
     * @param  string  $hook
     * @param  array  $arguments
     * @return mixed
     */
    public function apply(string $hook, ...$arguments)
    {
        return $this->items->filter(function ($filter) use ($hook) {
            return !!array_filter((array) $filter['hook'], function ($item) use ($hook) {
                return Str::is($item, $hook);
            });
        })->sortBy('priority')->reduce(function ($value, $filter) use ($arguments) {
            return call_user_func_array($filter['callback'], [$value] + $arguments);
        }, $arguments[0] ?? null);
    }
}
