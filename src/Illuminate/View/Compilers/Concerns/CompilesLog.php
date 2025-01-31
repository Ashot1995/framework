<?php

namespace Illuminate\View\Compilers\Concerns;

trait CompilesLog
{
    /**
     * Compile the extends statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileLog($expression)
    {
        $expression = $this->stripParentheses($expression);
        $parts = array_map('trim', explode(',', $expression));
        $message = isset($parts[0]) ? trim($parts[0], "'\"") : '';

        $method = isset($parts[1]) ? trim($parts[1], "'\"") : 'info';
        $resolvedClass = app()->make('log');

        if (! method_exists($resolvedClass, $method)) {
            $method = 'info';
        }

        return "<?php Log::{$method}('{$message}'); ?>";
    }
}
